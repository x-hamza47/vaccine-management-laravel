<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('is_approved', false);

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

    public function approve(User $user)
    {
        $user->update(['is_approved' => true]);
        return redirect()
            ->back()
            ->with('success', 'User approved successfully.');
    }
    public function reject(User $user)
    {
        $user->delete();
        return redirect()
            ->route('user.approval.index')
            ->with('success', 'User rejected and deleted successfully.');
    }

    public function bulkApprove(Request $request)
    {
        $request->validate(
            [
                'user_ids' => 'required|array',
                'user_ids.*' => 'exists:users,id'
            ],
            [
                'user_ids.required' => 'Please select at least one user.',
                'user_ids.*.exists' => 'One or more selected users do not exist.',
            ]
        );

        User::whereIn('id', $request->user_ids)->update(['is_approved' => true]);

        return redirect()->route('user.approval.index')->with('success', 'Selected users approved successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ], [
            'user_ids.required' => 'Please select at least one user to delete.',
        ]);

        User::whereIn('id', $request->user_ids)->delete();

        return redirect()->back()->with('success', 'Selected users deleted successfully.');
    }

}
