<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    // Show the form
    public function create()
    {
        // Ensure only authorized users can access this
        $this->authorize('create', User::class); // Optional if using Policies

        return view('users.create'); // Return a Blade view for the form
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Check permissions
        if (!Auth::user()->can('create-user')) { // Optional if not using Policies
            abort(403, 'Unauthorized');
        }

        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        // Create the user
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password
            'role' => $validated['role'], // Add role or other fields as necessary
        ]);

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }
}
