<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
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
