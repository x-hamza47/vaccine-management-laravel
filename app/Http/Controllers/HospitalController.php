<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function index(){
        $hospitals = Hospital::with('user:id,email')->latest()->get();
        return view('dashboard.admin.hospital.list', compact('hospitals'));
    }

    public function edit(Int $id){
        $hospital = Hospital::findOrFail($id);
        return view('dashboard.admin.hospital.edit', compact('hospital'));
    }

    public function create(){
        return view('dashboard.admin.hospital.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|max:14|confirmed',
            'hospital_name' => 'required|string',
            'address' => 'required|string',
            'location' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'hospital',
        ]);

        $user->hospital()->create([
            'hospital_name' => $request->hospital_name,
            'address' => $request->address,
            'location' => $request->location,
        ]);

        return redirect()->route('hospital.index')->with('success', 'Hospital added successfully.');
    }
    
    public function destroy(Int $id){
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return redirect()->route('hospital.index')->with('success', 'Hospital Deleted successfully.');
    }

    // !Hospital Dashboard
    public function appointments(){
        
        $hospitalId = Auth::user()->hospital->id;

        $appointments = VaccinationSchedule::with([
            'child:id,name', 
            'vaccine:id,name'])
            ->where('hospital_id', $hospitalId)
            ->latest('date')
            ->get();

            return view('dashboard.hospital.list', compact('appointments'));
        // return $hospitalId;


    }
}
