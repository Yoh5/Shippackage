<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'address',
        'email',
        'PhoneNumber',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
