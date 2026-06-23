<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'image_url',
        'is_important',
        'published_at',
    ];

    protected $casts = [
        'is_important' => 'boolean',
        'published_at' => 'datetime',
    ];
}
