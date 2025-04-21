<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

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
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'tags' => 'array',
    ];

    /**
     * Relation avec l'utilisateur créateur de l'événement.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Génère un slug basé sur le titre.
     */
    public function slug(): string
    {
        return Str::slug($this->title);
    }
}
