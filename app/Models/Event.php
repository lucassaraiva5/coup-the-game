<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'images'
    ];

    protected $casts = [
        'date' => 'date',
        'images' => 'array'
    ];
} 