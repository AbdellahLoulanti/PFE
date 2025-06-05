<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job_offers';

    protected $fillable = [
        'post',
        'description',
        'location',
        'type',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
