<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Champs pouvant être assignés en masse
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    // Cast des attributs
    protected $casts = [
        'price' => 'decimal:2',
    ];
}
