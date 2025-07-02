<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function index(Request $request)
    {
        $query = Vaccine::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('available', $request->status);
        }


        $vaccines = $query->latest()->paginate(10)->appends($request->all());

        return view('dashboard.admin.vaccine.list', compact('vaccines'));
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

