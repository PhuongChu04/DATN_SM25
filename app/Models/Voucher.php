<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = [
        'name',
        'code',
        'description',
        'type',
        'quantity',
        'discount_amount',
        'start_date',
        'end_date',
        'status',
    ] ;
}
