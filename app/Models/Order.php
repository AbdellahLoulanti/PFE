<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'city', 'postal_code',
        'items', 'total', 'payment_method',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}