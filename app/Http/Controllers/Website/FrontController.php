<?php

namespace App\Http\Controllers\Website;

use App\Models\Vaccine;
use App\Models\Children;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Parent\ParentController;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){
        $childs = collect(); 

        if (Auth::check()) {
            $childs = Children::where('user_id', Auth::id())
                ->latest('created_at')
                ->get();
        }
        $hospitals = Hospital::all();
        $vaccines = Vaccine::where('available',true)->get();
        return view('website.index',compact('hospitals','vaccines', 'childs'));
    }

    public function store(Request $request){
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to make an appointment.');
        }
        return app(ParentController::class)->storeAppointments($request);
    }
}
