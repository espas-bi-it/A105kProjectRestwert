<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

// Currently not used. Can be modified later for extra security
class CustomerPolicy
{
    /**
    * Determine whether the user can delete the model.
    */
    public function delete(User $user, Customer $customer): bool
    {
        return $user->role === 'Admin';
    }
}
