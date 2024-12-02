<?php

use App\Models\Customer;
use App\Models\User;
use App\Policies\CustomerPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Customer::class => CustomerPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
        Gate::define('create-user', function ($user) {
            return $user->role === 'Admin' || $user->role === 'TV' ; // Only admins can create users
        });
    }
}
