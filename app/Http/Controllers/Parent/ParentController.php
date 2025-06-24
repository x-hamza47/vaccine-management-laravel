<?php

namespace App\Http\Controllers\Parent;

use App\Models\Children;
use Illuminate\Http\Request;
use App\Models\VaccinationSchedule;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Vaccine;
use App\Models\VaccineRequest;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    public function index(){
        $childs =  Children::with(['parent', 'vaccinationSchedules:id,child_id,status'])
        ->where('user_id', Auth::user()->id)
            ->latest('created_at')
            ->get();
        return view('dashboard.parent.children.list',compact('childs'));
    }

    public function edit($id){
        $child =  Children::with(['parent', 'vaccinationSchedules:id,child_id,status'])
        ->where('user_id', Auth::user()->id)
        ->findOrFail($id);
        return view('dashboard.parent.children.edit',compact('child'));
    }

    public function create(){
        return view('dashboard.parent.children.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        Children::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('parent.child.index')->with('success', 'Child added successfully.');
    }

    public function update(Request $request, Int $id)
    {
        $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
        ]);

        $child = Children::where('user_id', Auth::id())->findOrFail($id);

        $child->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
        ]);
        
        return redirect()->route('parent.child.index')->with('success', 'Child updated successfully.');
    }

    public function schedule(){
        $childs = Auth::user()->children->pluck('id');
        $data = VaccinationSchedule::with(['child.parent', 'vaccine', 'hospital'])
            ->whereDate('date', '>=', now())
            ->where('status', 'pending')
            ->whereIn('child_id', $childs)
            ->latest()
            ->get();
        return view('dashboard.parent.schedule',compact('data'));
    }
    // ! Appointments

    public function showAppointments(){
        $childs = Auth::user()->children;
        $vaccines = Vaccine::where('available', true)->get();
        $hospitals = Hospital::all();
        return view('dashboard.parent.appointments',compact('childs','vaccines','hospitals'));
    }

    public function storeAppointments(Request $request){
        $request->validate([
            'child_id' => 'required|exists:childrens,id',
            'vaccine' => 'required|exists:vaccines,id',
            'hospital' => 'required|exists:hospitals,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $child = Children::where('id',$request->child_id)
        ->where('user_id',Auth::id())
        ->firstOrFail();

        VaccineRequest::create([
            'child_id' => $request->child_id,
            'vaccine_id' => $request->vaccine,
            'hospital_id' => $request->hospital,
            'preferred_date' => $request->date,
            'status' => 'pending',
        ]);
        return redirect()->route('parent.schedule.index')->with('success', 'Appointment Requested successfully.');
    }

    public function history(){
        $childs = Auth::user()->children->pluck('id');

        $data = VaccinationSchedule::with(['child', 'vaccine', 'hospital'])
        ->whereIn('child_id', $childs)
        ->where(function($query){
            $query->where('status','completed')
            ->orWhereDate('date','<', now());
        })
        ->latest('date')
        ->get();

        return view('dashboard.parent.history', compact('data'));
    }

    public function requests(){
        $childs = Auth::user()->children->pluck('id');

        $requests = VaccineRequest::with([
            'vaccine:id,name',
            'hospital:id,hospital_name',
            'child:id,name',
        ])
            ->whereIn('child_id', $childs)
            ->latest()
            ->get();

        return view('dashboard.parent.request', compact('requests'));
    }
}
