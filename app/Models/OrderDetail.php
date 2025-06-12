<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
     use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
        'color',
        'size',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    // Quan hệ: chi tiết đơn hàng thuộc về một đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Quan hệ: chi tiết đơn hàng có thể liên kết với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
