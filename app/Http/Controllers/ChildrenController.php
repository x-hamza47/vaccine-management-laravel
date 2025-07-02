<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\VaccineRequest;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChildrenController extends Controller
{
    // ! for showing childs list
    public function index(Request $request)
    {
        $query = Children::with(['parent', 'vaccinationSchedules:id,child_id,status'])
            ->whereHas('parent', function($query){
                $query->where('is_approved', true);
            })
            ->visibleTo(Auth::user())
            ->latest('created_at');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('parent', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        $childs = $query->paginate(10)->appends($request->all());

        return view('dashboard.children.list', compact('childs'));
    }
    // ! for edit page
    public function edit(int $id)
    {
        $query = Children::with('vaccinationSchedules:id,child_id,status')
            ->whereHas('parent', function ($query) {
                $query->where('is_approved', true);
            })->visibleTo(Auth::user());
        $child =  $query->findOrFail($id);
        return view('dashboard.children.edit', compact('child'));
    }

    // !for update child record
    public function update(Request $request, Int $id)
    {
        $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        $child = Children::visibleTo(Auth::user())->findOrFail($id);

        $child->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
        ]);

        return redirect()->route('child.index')->with('success', 'Child updated successfully.');
    }

    public function create()
    {
        return view('dashboard.children.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ],[
            'dob.required' => 'The date of birth field is required.',
        ]);

        Children::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('child.index')->with('success', 'Child added successfully.');
    }


    // ! for delete child record
    public function destroy(Int $id)
    {
        $child = Children::visibleTo(Auth::user())->findOrFail($id);
        $child->delete();
        return redirect()->route('child.index')->with('success', 'Child Deleted successfully.');
    }

    // !Requests

    public function pending()
    {
        $vacc_req = VaccineRequest::where('status', 'pending')
            ->with([
                'child:id,name,gender,user_id',
                'child.parent:id,name',
                'vaccine:id,name',
                'hospital:id,hospital_name'
            ])->paginate(10);
            

        $hospitals = Hospital::all();

        return view('dashboard.admin.pending.list', compact('vacc_req', 'hospitals'));
    }

    // !Approval

    public function approve(Request $request, $id)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'date' => 'required|after_or_equal:today',
        ]);

        $vacc_req = VaccineRequest::findOrFail($id);

        // return $vacc_req;
        VaccinationSchedule::create([
            'child_id' => $vacc_req->child_id,
            'vaccine_id' => $vacc_req->vaccine_id,
            'hospital_id' => $request->hospital_id,
            'date' => $request->date,
            'status' => 'pending',
        ]);

        $vacc_req->status = 'approved';
        $vacc_req->save();

        return redirect()->route('child.pending.requests')->with('success', 'Vaccine request approved and schedule created.');
    }

    public function reject($id)
    {
        $vacc_req = VaccineRequest::findOrFail($id);
        $vacc_req->status = 'rejected';
        $vacc_req->save();

        return redirect()->route('child.pending.requests')->with('success', 'Vaccine request rejected.');
    }
}
