<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * User Policy
 *
 * Determine if user may request a certain function
 */
class UserPolicy
{
    /**
    * Determine whether the user can create a new User.
    */
    public function hasPermission(User $user)
    {
        return Auth::user()->hasAdvancedPermissions(); // Only admins can create and manage users
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
