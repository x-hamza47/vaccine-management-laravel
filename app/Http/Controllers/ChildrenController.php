<?php

namespace App\Http\Controllers;

use App\Models\Children;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index(){
       $childs =  Children::with(['user','vaccinationSchedules:id,child_id,status'])
       ->latest()
       ->get();
       return view('dashboard.children.list',compact('childs'));
    }

    public function edit(int $id){
        $child = Children::with('vaccinationSchedules:id,child_id,status')
        ->findOrFail($id);
        return view('dashboard.children.edit', compact('child'));
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
}
