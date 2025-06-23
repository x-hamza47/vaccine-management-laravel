<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Hospital;
use App\Models\VaccinationSchedule;
use Illuminate\Http\Request;
use App\Models\VaccineRequest;

class ChildrenController extends Controller
{
    public function index(){
       $childs =  Children::with(['parent','vaccinationSchedules:id,child_id,status'])
       ->latest('created_at')
       ->get();
       return view('dashboard.admin.children.list',compact('childs'));
    }

    public function edit(int $id){
        $child = Children::with('vaccinationSchedules:id,child_id,status')
        ->findOrFail($id);
        return view('dashboard.admin.children.edit', compact('child'));
    }

    public function update(Request $request, Int $id){
        $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'status' => 'required|in:pending,completed',
        ]);

        $child = Children::find($id);

        $child->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
        ]);

        if($child->vaccinationSchedules){
            $child->vaccinationSchedules->update([
                'status' => $request->status,
            ]);
        }
        return redirect()->route('child.index')->with('success', 'Child updated successfully.');
    }
    
    public function destroy(Int $id){
        $child = Children::findOrFail($id);
        $child->delete();
        return redirect()->route('child.index')->with('success', 'Child Deleted successfully.');

    }

    // !Requests

    public function pending(){
        $vacc_req = VaccineRequest::where('status', 'pending')
            ->with([
                'child:id,name,gender,user_id',
                'child.parent:id,name',
                'vaccine:id,name'])
            ->get();
        $hospitals = Hospital::all();

        return view('dashboard.admin.children.pending.list', compact('vacc_req', 'hospitals'));
    }

    // !Approval

    public function approve(Request $request,$id){
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

    public function reject($id){
        $vacc_req = VaccineRequest::findOrFail($id);
        $vacc_req->status = 'rejected';
        $vacc_req->save();

        return redirect()->route('child.pending.requests')->with('success', 'Vaccine request rejected.');
    }   
}
