<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* Customer Model
*
* Defined fillables
* Search and Sort Functions for indexing in various pages
* @access   public
*/
class Customer extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'title', 'company', 'name', 'surname', 'address', 'po_box', 'zip', 'city', 
        'email', 'phone', 'iban', 'bankname', 'alt_title', 'alt_name', 'alt_surname',
        'alt_address', 'alt_zip', 'alt_city', 'oral_suggestion', 'ricardo_suggestion', 
        'socialmedia_suggestion', 'flyer_suggestion', 'incorporated', 'updated_by',
    ];

    /**
    * Search Function
    *
    * Only output list of customers based on search input, which are sent by components.sort-filter-settings
    *
    * @params   query
    * @params   string
    */
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

    /**
    * Sort Function
    *
    * Sorts list by defined sorting params, which are sent by components.sort-filter-settings
    *
    * @params   query
    * @params   string
    */
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
