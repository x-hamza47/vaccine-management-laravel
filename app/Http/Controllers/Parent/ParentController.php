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
    public function showAppointments()
    {
        $childs = Auth::user()->children;
        $vaccines = Vaccine::where('available', true)->get();
        $hospitals = Hospital::all();
        return view('dashboard.parent.appointments', compact('childs', 'vaccines', 'hospitals'));
    }

    public function storeAppointments(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:childrens,id',
            'vaccine' => 'required|exists:vaccines,id',
            'hospital' => 'required|exists:hospitals,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $child = Children::where('id', $request->child_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        VaccineRequest::create([
            'child_id' => $request->child_id,
            'vaccine_id' => $request->vaccine,
            'hospital_id' => $request->hospital,
            'preferred_date' => $request->date,
            'status' => 'pending',
        ]);
        return redirect()->route('parent.requests')->with('success', 'Appointment Requested successfully.');
    }


    public function requests(Request $request)
    {
        $childs = Auth::user()->children->pluck('id');

        $query = VaccineRequest::with([
            'vaccine:id,name',
            'hospital:id,hospital_name',
            'child:id,name',
        ])
        ->whereIn('child_id', $childs);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->whereHas('vaccine', function ($v) use ($search) {
                    $v->where('name', 'like', "%{$search}%");
                })->orWhereHas('hospital', function ($h) use ($search) {
                    $h->where('hospital_name', 'like', "%{$search}%");
                })->orWhereHas('child', function ($c) use ($search) {
                    $c->where('name', 'like', "%{$search}%");
                });
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate(10)->appends($request->all());
        return view('dashboard.parent.request', compact('requests'));
    }
}
