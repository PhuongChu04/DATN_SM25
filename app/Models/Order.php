<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
       use HasFactory;
    protected $fillable = ['order_code', 'customer_id', 'total_price', 'payment_status', 'order_status'];

   public function user()
{
    return $this->belongsTo(User::class);
}
    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class,'id_order');
}
public function statusLogs()
{
    return $this->hasMany(OrderStatusLog::class)->orderBy('created_at');
}
}
