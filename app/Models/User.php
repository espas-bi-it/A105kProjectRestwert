<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Check if the user is an admin
    public function hasAdminPermissions()
    {
        return $this->role === 'Admin';
    }

    // Check if the user is a TV or Admin
    public function hasAdvancedPermissions()
    {
        return $this->role === 'TV' || $this->role === 'Admin';
    }

    // Check if the user is a TV or Admin
    public function hasRestrictedPermissions()
    {
        return $this->role === 'TV';
    }

    // Check if the user is a Teilnehmer
    public function hasBasicPermissions()
    {
        return $this->role === 'Teilnehmer';
    }


    /**
    * Search Function
    *
    * Only output list of users based on search input, which are sent by components.sort-settings
    *
    * @params   query
    * @params   string
    */
    public function scopeSearch($query, $searchInput)
    {
        if ($searchInput) {
            $query->where(function ($query) use ($searchInput) {
                $query->where('name', 'LIKE', "%$searchInput%")
                      ->orWhere('email', 'LIKE', "%$searchInput%")
                      ->orWhere('role', 'LIKE', "%$searchInput%");
            });
        }
    }

    /**
    * Sort Function
    *
    * Sorts list by defined sorting params, which are sent by components.sort-settings
    *
    * @params   query
    * @params   string
    */
    public function scopeSort($query, $sort)
    {
        if (in_array($sort, ['name', 'email', 'role'])) {
            $query->orderBy($sort, 'ASC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }
    }
}
