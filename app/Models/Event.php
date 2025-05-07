<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;



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

    protected function tags(): Attribute
    {
        return Attribute::castUsing(AsArrayObject::class);
    }

    protected function startDate(): Attribute
    {
        return Attribute::cast('datetime');
    }

    protected function endDate(): Attribute
    {
        return Attribute::cast('datetime');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
