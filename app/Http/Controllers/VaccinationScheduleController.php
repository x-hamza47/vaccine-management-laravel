<?php

namespace App\Http\Controllers;

use App\Models\VaccinationSchedule;
use Illuminate\Http\Request;

class VaccinationScheduleController extends Controller
{
    public function index()
    {
        $data = VaccinationSchedule::with(['child.parent', 'vaccine', 'hospital'])
        ->whereDate('date', '>=', now())
        ->latest()
        ->get();
        return view('dashboard.admin.vaccination.list', compact('data'));
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

    public function bookings(){
        $data = VaccinationSchedule::with([
            'child:id,name,user_id',
            'child.parent:id,name',
            'vaccine:id,name',
            'hospital:id,hospital_name'])
            ->latest()
            ->get();
        return view('dashboard.admin.bookings.list', compact('data'));
    }
}
