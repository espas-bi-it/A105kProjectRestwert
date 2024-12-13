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

    public function scopeSort($query, $sort)
    {
        if (in_array($sort, ['name', 'email', 'role'])) {
            $query->orderBy($sort, 'ASC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }
    }
}
