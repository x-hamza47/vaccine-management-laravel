<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(){
        $hospitals = Hospital::with('user:id,email')->latest()->get();
        return view('dashboard.hospital.list', compact('hospitals'));
    }

    public function edit(Int $id){
        $hospital = Hospital::findOrFail($id);
        return view('dashboard.hospital.edit', compact('hospital'));
    }

    public function destroy(Int $id){
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return redirect()->route('hospital.index')->with('success', 'Hospital Deleted successfully.');
    }
}
