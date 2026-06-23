<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyGospel extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'passage',
        'content',
        'reflection',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
