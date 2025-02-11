<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class likes_matches extends Model
{
    // Define the table name (optional if it follows Laravel's naming convention)
    protected $table = 'likes_matches';

    // Specify the fillable fields for mass assignment
    protected $fillable = ['liker_id', 'liked_id', 'match'];

    // If your table doesn't use timestamps (created_at, updated_at), disable them:
    public $timestamps = false;
}