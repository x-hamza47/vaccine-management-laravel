<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Hospital;
use App\Models\Vaccine;
use App\Models\VaccineRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $childs = collect();

        if (Auth::check()) {
            $childs = Children::where('user_id', Auth::id())
                ->latest('created_at')
                ->get();
        }
        $hospitals = Hospital::all();
        $vaccines = Vaccine::where('available', true)->get();
        return view('index', compact('hospitals', 'vaccines', 'childs'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/dashboard/login')->with('error', 'Please login to make an appointment.');
        }

        if (Auth::user()->role !== 'parent') {
            return redirect('/admin')->with('error', 'Appointments are booked by parent accounts.');
        }

        $request->validate([
            'child_id' => 'required|exists:childrens,id',
            'vaccine'  => 'required|exists:vaccines,id',
            'hospital' => 'required|exists:hospitals,id',
            'date'     => 'required|date|after_or_equal:today',
        ]);

        // Child must belong to this parent
        $child = Children::where('id', $request->child_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        VaccineRequest::create([
            'child_id'       => $child->id,
            'vaccine_id'     => $request->vaccine,
            'hospital_id'    => $request->hospital,
            'preferred_date' => $request->date,
            'status'         => 'pending',
        ]);

        \Filament\Notifications\Notification::make()
            ->title('Appointment requested successfully.')
            ->success()
            ->send();

        return redirect('/dashboard');
    }
}
