<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'id_category',
        'description',
        'id_brand',
        'image_primary',
        'status',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'id_product');
    }
}
