<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
    public function showLogin()
    {
        return view('dashboard.auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:10'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('show.dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function store(Request $request)
    {
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
        if ($request->role == 'parent') {
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
        if ($request->role == 'hospital') {
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

    public function dashboard()
    {
        $user = Auth::user();
        $today = Carbon::today();

        if ($user->role == 'admin') {
            $totalChildren = Children::count();
            $hospitals = Hospital::get(['id', 'hospital_name']);
            $totalVaccines = Vaccine::count();
            $totalAvailableVaccines = Vaccine::where('available', true)->count();
            $userRequests = User::where('is_approved', false)->latest()->take(5)->get();
            $totalUsers = User::where('is_approved', true)->count();
            $totalUnvailableVaccines = Vaccine::where('available', false)->count();
            $completedToday = VaccinationSchedule::where('status', 'completed')
                ->whereDate('created_at', $today)
                ->count();
            $pendingRequests = VaccineRequest::where('status', 'pending')
                ->with([
                    'child:id,name,gender,user_id',
                    'child.parent:id,name',
                    'vaccine:id,name',
                    'hospital:id,hospital_name'
                ])->take(5)
                ->get();

            return view('dashboard.dashboard', compact(
                'totalChildren',
                'hospitals',
                'totalVaccines',
                'userRequests',
                'completedToday',
                'totalUsers',
                'pendingRequests',
                'totalAvailableVaccines',
                'totalUnvailableVaccines'
            ));
        }

        if ($user->role == 'parent') {
            $childIds = Children::where('user_id', $user->id)->pluck('id');

            $childs = Children::whereIn('id', $childIds)->get();

            $myRequests = VaccineRequest::with(['child', 'vaccine', 'hospital'])
                ->whereIn('child_id', $childIds)
                ->latest()
                ->take(5)
                ->get();

            $totalRequests = VaccineRequest::whereIn('child_id', $childIds)->count();

            $Appointments = VaccinationSchedule::whereIn('child_id', $childIds)
                ->where(function ($query) use ($today) {
                    $query->where('status', 'pending')
                        ->where('date', '>=', $today);
                })
                ->oldest('date')->take(5)->get();

            $pendingAppointments = VaccinationSchedule::whereIn('child_id', $childIds)
                ->where('status', 'pending')->count();

            return view('dashboard.dashboard', compact(
                'childs',
                'myRequests',
                'totalRequests',
                'Appointments',
                'pendingAppointments'
            ));
        }


        if ($user->role === 'hospital') {
            $hospitalId = $user->hospital->id;

            $appointments = VaccinationSchedule::with(['child:id,name', 'vaccine:id,name'])
                ->where('hospital_id', $hospitalId)
                ->where(function ($query) use ($today) {
                    $query->where('status', 'pending')
                        ->where('date', '>=', $today);
                })
                ->oldest('date')
                ->take(5)
                ->get();

            $completedToday = VaccinationSchedule::where('hospital_id', $hospitalId)
                ->where('status', 'completed')
                ->whereDate('date', $today)
                ->count();
            $totalAppointments = VaccinationSchedule::where('hospital_id', $hospitalId)->count();
            $pendingAppointments = VaccinationSchedule::where('hospital_id', $hospitalId)
                ->where('status', 'pending')
                ->count();
            $completedAppointments = VaccinationSchedule::where('hospital_id', $hospitalId)
                ->where('status', 'completed')
                ->count();



            return view('dashboard.dashboard', compact(
                'appointments',
                'totalAppointments',
                'pendingAppointments',
                'completedAppointments',
                'completedToday'
            ));
        }
        return view('dashboard.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return view('dashboard.auth.login');
    }
}
