<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class UserManagementController extends Controller
{
    use AuthorizesRequests;

    // Show the form
    public function create()
    {
        // Ensure only authorized users can access this
        $this->authorize('create', User::class); // Optional if using Policies

        return view('users.create'); // Return a Blade view for the form
    }

    // Show the list of users
    public function index(Request $request)
    {
        // Check permissions
        $this->authorize('create', User::class); // Optional if using Policies

        // Validate inputs
        $validated = $request->validate([
            'search_input' => 'nullable|string|max:255',
            'sort' => 'nullable|string|in:name,email,role',
        ]);

        // Build query using scopes
        $users = User::query()
            ->search($validated['search_input'] ?? null)
            ->sort($validated['sort'] ?? null)
            ->paginate(10)
            ->withQueryString();
        return view('users.index', compact('users')); // Return view with users
    }

    // Update user details
    public function update(Request $request, User $user)
    {
        $this->authorize('create', User::class); // Optional if using Policies


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Unique except for current user
            'role' => 'required|string', // Validate role using the Role enum
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'], // Use the role from the enum
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Handle form submission
    public function store(Request $request)
    {
        $this->authorize('create', User::class); // Optional if using Policies


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

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User was successfully deleted!');
    }
}
