<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index(){
        $users = User::where('is_approved',false)->latest()->get();
        return view('dashboard.user_approvals.list', compact('users'));
    }

    public function approve(User $user){
        $user->update(['is_approved' => true]);
        return redirect()
        ->route('user.approval.index')
        ->with('success', 'User approved successfully.');
    }

    public function reject(User $user){
        $user->delete();
        return redirect()
        ->route('user.approval.index')
        ->with('success', 'User rejected and deleted successfully.');
    }
}
