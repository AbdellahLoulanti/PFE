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

    public function getCoverImageUrlAttribute()
    {
        // Si la colonne cover_image contient un nom de fichier et que ce fichier existe dans storage/app/public
        if ($this->cover_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->cover_image)) {
            return asset('storage/'.$this->cover_image);
        }

        // Sinon on retourne une image de remplacement (à créer dans public/images)
        return asset('images/fallback-event-image.jpg');
    }

    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }
}
