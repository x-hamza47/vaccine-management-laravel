<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function __invoke()
    {
        $vaccines = Vaccine::latest()->get();
        return view('dashboard.vaccine.list',compact('vaccines'));
    }

    public function update(Request $request, $id){
            $request->validate([
                'status' => 'required|in:1,0',
            ]);
    
            $vaccine = Vaccine::findOrFail($id);
            $vaccine->update([
                'available' => $request->status,
            ]);
    
            return response()->json(['status' => true, 'message' => 'Status updated successfully.']);

    }
}

