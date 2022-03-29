<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
    ];

    protected $attributes = [
        'resolved' => false,
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
