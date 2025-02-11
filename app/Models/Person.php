<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // Define the table name explicitly (optional, Laravel assumes "people" from "Person")
    protected $table = 'people';

    // Specify the fillable fields for mass assignment
    protected $fillable = ['name', 'password', 'avaliable_likes', 'matches', 'description', 'user_image'];

    // If your table does not use timestamps (created_at, updated_at), disable them:
    public $timestamps = false;
}