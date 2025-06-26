<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\VaccinationSchedule;

class VaccinationScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = VaccinationSchedule::with(['child.parent', 'vaccine', 'hospital'])
        ->where(
                function ($q) {
                    $q->whereDate('date', '>=', now())
                        ->where('status', 'pending');
        });

        if($request->filled('hospital_id')){
            $query->where('hospital_id',$request->hospital_id);
        }
        if($request->filled('vaccine_id')){
            $query->where('vaccine_id',$request->vaccine_id);
        }
        if($request->filled('date')){
            $query->where('date',$request->date);
        }
        if($request->filled('search')){
            $search = $request->search;
            $query->whereHas('child', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhereHas('parent', function($q2) use($search) {
                    $q2->where('name', 'like', "%{$search}%");
                });
            });
        }

        $data = $query->latest()->paginate(15)->appends($request->all());;
        $hospitals = Hospital::all();
        $vaccines = Vaccine::all();
        return view('dashboard.admin.vaccination.list', compact('data', 'hospitals', 'vaccines'));
    }

    public function updateStatus(Request $request,  $id){
        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $schedule = VaccinationSchedule::findOrFail($id);
        $schedule->update([
            'status' => $request->status,
        ]);

        return response()->json(['status' => true, 'message' => 'Status updated successfully.']);
    }

    public function bookings(Request $request){
        $query = VaccinationSchedule::with([
            'child:id,name,user_id',
            'child.parent:id,name',
            'vaccine:id,name',
            'hospital:id,hospital_name']);

        if ($request->filled('hospital_id')) {
            $query->where('hospital_id', $request->hospital_id);
        }
        if ($request->filled('vaccine_id')) {
            $query->where('vaccine_id', $request->vaccine_id);
        }
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('child', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('parent', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status',$request->input('status'));
        }

        $data = $query->latest()->paginate(15)->appends($request->all());
        $hospitals = Hospital::all();
        $vaccines = Vaccine::all();
        return view('dashboard.admin.bookings.list', compact('data', 'hospitals', 'vaccines'));
    }
}
