<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(Request $request){
        $query = Hospital::with('user:id,email')->whereHas('user', function($query) {
            $query->where('is_approved', true);
        });
        
        if($request->filled('search')){
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('hospital_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if($request->filled('sort_by') && $request->sort_by != ''){
            if($request->input('sort_by') == 'name'){
                $query->orderby('hospital_name','asc');
            }elseif($request->input('sort_by') == 'date'){
                $query->orderBy('created_at', 'desc');
            }
        }else {
            $query->latest('created_at');
        }
        $hospitals = $query->paginate(10)->appends($request->all());
        return view('dashboard.admin.hospital.list', compact('hospitals'));
    }

    public function edit(Int $id){
        $hospital = Hospital::findOrFail($id);
        return view('dashboard.admin.hospital.edit', compact('hospital'));
    }

    public function update(Request $request, Int $id){
        $hospital = Hospital::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'location' => 'required|string',
        ]);

        $hospital->update([
            'hospital_name' => $request->name,
            'address' => $request->address,
            'location' => $request->location,
        ]);

        return redirect()->route('hospital.index')->with('success', 'Hospital updated successfully.');
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
   
}
