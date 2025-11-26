<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'address',
        'payment_method',
        'delivery_method',
        'status',
        'total_amount',
        'delivery_cost',
        'promo_code'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'delivery_cost' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}