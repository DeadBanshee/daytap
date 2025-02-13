<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;

    protected $table = 'user_messages'; // Explicitly define table name

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

}
