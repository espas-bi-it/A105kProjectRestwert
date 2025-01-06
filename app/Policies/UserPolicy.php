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

    public function hasAdminPermissions(User $user)
    {
        return Auth::user()->hasAdminPermissions(); // Check for admins rights
    }

    public function hasAdvancedPermissions(User $user)
    {
        return Auth::user()->hasAdvancedPermissions(); // Check for admins and TV permissions
    }

    public function hasRestrictedPermissions(User $user)
    {
        return Auth::user()->hasRestrictedPermissions(); // Check for TV permissions
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
