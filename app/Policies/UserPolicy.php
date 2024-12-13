<?php

namespace App\Policies;

use App\Models\User;

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
    public function create(User $user)
    {
        return $user->role === 'Admin' || $user->role === 'TV' ; // Only admins can create users
    }

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
