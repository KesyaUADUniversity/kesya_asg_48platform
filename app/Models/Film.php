<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'year', 'rating', 'genre', 'description', 'image_url'
    ];

    
    protected $casts = [
        'genre' => 'array'
    ];
}