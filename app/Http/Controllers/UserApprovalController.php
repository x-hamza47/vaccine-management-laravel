<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index(Request $request){
        $query = User::where('is_approved',false);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }
        $users = $query->latest()->paginate(10)->appends($request->all());
        
        return view('dashboard.admin.user_approvals.list', compact('users'));
    }

    public function approve(User $user){
        $user->update(['is_approved' => true]);
        return redirect()
        ->back()
        ->with('success', 'User approved successfully.');
    }

    public function reject(User $user){
        $user->delete();
        return redirect()
        ->route('user.approval.index')
        ->with('success', 'User rejected and deleted successfully.');
    }
}
