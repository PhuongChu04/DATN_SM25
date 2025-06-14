<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
     use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'id_order',
        'id_variant',
        'variant_data',
        'quantity',
        'unit_price',
       'total',
    ];

    protected $casts = [
        'variant_data' => 'array',
    ];

    // Quan hệ: chi tiết đơn hàng thuộc về một đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    // Quan hệ: chi tiết đơn hàng có thể liên kết với sản phẩm
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant');
    }
}
