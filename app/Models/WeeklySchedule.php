<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'host',
        'start_time',
        'end_time',
        'days_of_week',
        'description',
        'image_url',
    ];

    protected $casts = [
        'days_of_week' => 'array',
    ];
}
