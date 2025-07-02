<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VaccinationScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = VaccinationSchedule::with(['child.parent', 'vaccine', 'hospital'])
        ->where(
                function ($q) {
                    $q->whereDate('date', '>=', now())
                        ->where('status', 'pending');
        })->visibleTo(Auth::user());

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

        $data = $query->latest()->paginate(10)->appends($request->all());
        $hospitals = Hospital::all();
        $vaccines = Vaccine::all();
        return view('dashboard.schedules.list', compact('data', 'hospitals', 'vaccines'));
    }

    public function updateStatus(Request $request,  $id){
        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);
        
        $schedule = VaccinationSchedule::findOrFail($id);
        
        if(Gate::allows('hospital-view')){
            $hospitalId = Auth::user()->hospital->id ?? null;
            if($schedule->hospital_id !== $hospitalId){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized: Hospital ID does not match.',
                ], 403);
            }
        }
        if(Gate::allows('admin-view') || Gate::allows('hospital-view')){
            $schedule->update([
                'status' => $request->status,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully.',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'You are not authorized to update this schedule.',
        ], 403);
    }

    public function bookings(Request $request){
        $user = Auth::user();
        $query = VaccinationSchedule::with([
            'child:id,name,user_id',
            'child.parent:id,name',
            'vaccine:id,name',
            'hospital:id,hospital_name'])
            ->visibleTo($user)
            ->completedOrPast($user)
            ->applyFilters($request);

        $data = $query->latest('updated_at')->paginate(15)->appends($request->all());
        $hospitals = (Gate::allows('admin-view') || Gate::allows('parent-view')) ? Hospital::all() : null;
        $vaccines =  Vaccine::all() ;
        return view('dashboard.bookings.list', compact('data', 'hospitals', 'vaccines'));
    }
}
