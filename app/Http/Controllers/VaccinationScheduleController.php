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
        return view('dashboard.vaccination.list', compact('data'));
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
}
