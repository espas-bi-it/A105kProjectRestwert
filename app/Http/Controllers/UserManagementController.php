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

    /**
    * Display the form to create a new entry
    *
    * Only authorized roles may access this page. More info in UserPolicy.php
    *
    * @return   users.create page 
    */
    public function create()
    {
        $this->authorize('create', User::class); 

        return view('users.create'); 
    }

    /**
    * Display a list of Users
    *
    * Only authorized roles may process and submit on this page. More info in UserPolicy.php
    * Validate search input or sort 
    * Sort and Search functions are defined in User Model
    * Paginates 10 entries
    *
    * @return   users.index page sorted and/or filtered entries
    */
    public function index(Request $request)
    {
        $this->authorize('create', User::class);

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
        return view('users.index', compact('users')); 
    }

    /**
    * Update user details
    *
    * Only authorized roles may process and submit on this page. More info in UserPolicy.php
    * Validate entered infos
    *
    * @return   users.index page with success message
    */
    public function update(Request $request, User $user)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Unique except for current user
            'role' => 'required|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'], 
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
    * Handle the form submission
    *
    * Only authorized roles may process and submit on this page. More info in UserPolicy.php
    * Validate entered infos
    * Create a new user in the DB
    * Encrypt password with Bcrypt
    *
    * @return   users.create page with success message
    */
    public function store(Request $request)
    {
        $this->authorize('create', User::class); 

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
    * Delete User from DB
    *
    * @param    string
    * @return   users.index page with success message
    */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User was successfully deleted!');
    }
}
