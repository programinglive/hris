<?php

namespace App\Http\Controllers\Installation;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSetupController extends Controller
{
    public function index()
    {
        return inertia('Installation/AdminSetup', [
            'currentStep' => 4,
            'totalSteps' => 4,
        ]);
    }

    public function store(Request $request)
    {
        // Validate admin user information
        $validated = $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        // Create admin user
        $user = User::create([
            'name' => $validated['admin_name'],
            'email' => $validated['admin_email'],
            'password' => Hash::make($validated['admin_password']),
            'is_active' => true,
        ]);

        // Redirect to completion page
        return redirect()->route('install.complete')->with('user', $user);
    }
}
