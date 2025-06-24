<?php

namespace App\Http\Controllers\Parent;

use App\Models\Children;
use Illuminate\Http\Request;
use App\Models\VaccinationSchedule;
use App\Http\Controllers\Controller;
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
    public function showAppointments(){
        return view('dashboard.parent.appointments');
    }
    public function history(){
        return view('dashboard.parent.history');
    }
}
