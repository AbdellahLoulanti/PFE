<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'visibility',
        'cover_image',
        'tags',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tags' => AsArrayObject::class,
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'created_at' => 'datetime:Y-m-d',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
