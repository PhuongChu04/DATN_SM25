<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'vouchers';
    protected $fillable = [
        'name', 
        'code', 
        'description',
        'discount_amount', 
        'type', 
        'quantity', 
        'start_date', 
        'end_date', 
        'status', 
        'max_discount', 
        'min_order_amount', 
        'usage_limit_per_user',
        'is_active', 
    ] ;
}
