<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    // Define the table name explicitly (optional if the table name is not the plural of the model name)
    protected $table = 'wishlists';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'wishlist',
    ];
}
