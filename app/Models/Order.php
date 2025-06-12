<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id_user',
        'user_data',
        'address_data',
        'voucher_data',
        'status',
        'note',
        'subtotal',
        'shipping',
        'total',
        'payment_method',
    ];

    protected $casts = [
        'user_data' => 'array',
        'address_data' => 'array',
        'voucher_data' => 'array',
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    // Quan hệ: đơn hàng thuộc về người dùng
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Quan hệ: đơn hàng có nhiều chi tiết đơn hàng
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
