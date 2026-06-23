<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinStatus extends Model
{
    use HasFactory;

    protected $table = 'cabin_statuses';

    protected $fillable = [
        'mode',
        'current_program',
        'current_host',
        'is_streaming',
        'banner_message',
    ];

    protected $casts = [
        'is_streaming' => 'boolean',
    ];
}
