<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vaccine;
use App\Models\Children;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\VaccineRequest;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLogin(){
        return view('dashboard.auth.login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:10'
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->route('show.dashboard');
        }

        return back()->withErrors(['email'=> 'The provided credentials do not match our records.']);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|max:14',
            'role' => 'required|in:parent,hospital'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        // Info: Parent
        if($request->role == 'parent'){
            $request->validate([
                'child_name' => 'required|string',
                'dob' => 'required|date',
                'gender' => 'required|in:male,female,other',
            ]);

            $user->children()->create([
                'name' => $request->child_name,
                'dob' => $request->dob,
                'gender' => $request->gender,
            ]);
        }
        
        // Info: Hospital
        if($request->role == 'hospital'){
            $request->validate([
                'hospital_name' => 'required|string',
                'address' => 'required|string',
                'location' => 'required|string',
            ]);

            $user->hospital()->create([
                'hospital_name' => $request->hospital_name,
                'address' => $request->address,
                'location' => $request->location,
            ]);
        }

        return redirect()->route('login');
    }

    public function dashboard(){
        $user = Auth::user();

        if ($user->role == 'admin') {
            $totalChildren = Children::count();
            $totalHospitals = Hospital::count();
            $totalVaccines = Vaccine::count();
            $totalAvailableVaccines = Vaccine::where('available',true)->count();
            $totalUnvailableVaccines = Vaccine::where('available',false)->count();
            $pendingRequests = VaccineRequest::where('status', 'pending')
                ->with([
                    'child:id,name,gender,user_id',
                    'child.parent:id,name',
                    'vaccine:id,name',
                    'hospital:id,hospital_name'
                ])
                ->get();

      
     

            // ✅ Return view with required variables
            return view('dashboard.dashboard', compact(
                'totalChildren',
                'totalHospitals',
                'totalVaccines',
                'pendingRequests',
                'totalAvailableVaccines',
                'totalUnvailableVaccines'
            ));
        }
        return view('dashboard.dashboard');
    }

    public function logout(){
        Auth::logout();
        return view('dashboard.auth.login');
    }
}
