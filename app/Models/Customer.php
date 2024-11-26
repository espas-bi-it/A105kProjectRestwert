<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // Define fillable attributes
    protected $fillable = [
        'title', 'company', 'name', 'surname', 'address', 'po_box', 'zip', 'city', 
        'email', 'phone', 'iban', 'bankname', 'alt_title', 'alt_name', 'alt_surname',
        'alt_address', 'alt_zip', 'alt_city', 'oral_suggestion', 'ricardo_suggestion', 
        'socialmedia_suggestion', 'flyer_suggestion', 'incorporated', 'updated_by',
    ];

    public function scopeSearch($query, $searchInput)
    {
        if ($searchInput) {
            $query->where(function ($query) use ($searchInput) {
                $query->where('name', 'LIKE', "%$searchInput%")
                      ->orWhere('surname', 'LIKE', "%$searchInput%")
                      ->orWhere('address', 'LIKE', "%$searchInput%")
                      ->orWhere('zip', 'LIKE', "%$searchInput%")
                      ->orWhere('city', 'LIKE', "%$searchInput%")
                      ->orWhere('email', 'LIKE', "%$searchInput%");
            });
        }
    }

    public function scopeSort($query, $sort)
    {
        if ($sort === 'incorporated') {
            $query->where('incorporated', '0');
        } elseif (in_array($sort, ['name', 'surname', 'email', 'city', 'created_at'])) {
            $query->orderBy($sort, 'ASC');
        } else {
            $query->orderBy('created_at', 'DESC');
        }
    }
}
