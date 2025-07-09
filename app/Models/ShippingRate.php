<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;
    protected $fillable = ['shipping_id', 'min_km', 'max_km', 'fee'];

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
}
