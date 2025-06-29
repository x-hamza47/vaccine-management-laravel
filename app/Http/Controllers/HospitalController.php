<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Models\VaccinationSchedule;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    public function index(Request $request){
        $query = Hospital::with('user:id,email');
        
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
    public function appointments(Request $request){
        
        $hospitalId = Auth::user()->hospital->id;

        $query = VaccinationSchedule::with([
            'child:id,name', 
            'vaccine:id,name'])
            ->where('hospital_id', $hospitalId)->where('status','pending');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->whereHas('child', function ($childQuery) use ($search) {
                    $childQuery->where('name', 'like', "%{$search}%");
                })->orWhereHas('vaccine', function ($vaccineQuery) use ($search) {
                    $vaccineQuery->where('name', 'like', "%{$search}%");
                });
            });  
        }

        if ($request->filled('sort_by') && in_array($request->sort_by, ['asc', 'desc'])) {
            $query->orderBy('date', $request->sort_by);
        } else {
            $query->latest('date'); 
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $appointments = $query->latest('date')->paginate(10)->appends($request->all());


        return view('dashboard.hospital.list', compact('appointments'));
        // return $hospitalId;
    }

    public function updateStatus(Request $request, $id)
    {

        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $schedule = VaccinationSchedule::findOrFail($id);

        $hospitalId = Auth::user()->hospital->id;
        if($schedule->hospital_id !== $hospitalId){
            return response()->json(['status' => true, 'message' => 'Hospital id not matched.']);
        }
        $schedule->update([
            'status' => $request->status,
        ]);

        return response()->json(['status' => true, 'message' => 'Status updated successfully.']);
    }

    public function history(Request $request){
        $hospitalId =  Auth::user()->hospital->id;

        $query = VaccinationSchedule::with([
            'child:id,name',
            'vaccine:id,name'])
            ->where('hospital_id', $hospitalId)
            ->where('status', 'completed');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->whereHas('child', function ($childQuery) use ($search) {
                    $childQuery->where('name', 'like', "%{$search}%");
                })->orWhereHas('vaccine', function ($vaccineQuery) use ($search) {
                    $vaccineQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('sort_by') && in_array($request->sort_by, ['asc', 'desc'])) {
            $query->orderBy('date', $request->sort_by);
        } else {
            $query->latest('date');
        }


        $appointments = $query->latest('date')->paginate(10)->appends($request->all());
            // ->latest('date')
            // ->get();

        return view('dashboard.hospital.history', compact('appointments'));
    }
}
