<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Voucher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'vouchers';
    protected $fillable = [
        'name', 
        'code', 
        'description',
        'type',                // % hay fixed
        'discount_amount',     // giá trị giảm
        'max_discount_value',  // giảm tối đa (nếu %)
        'quantity',            // tổng số lượng
        'usage_per_user',      // số lần 1 user dùng
        'min_order_value',     // giá trị đơn tối thiểu
        'applied_products',    // json list id sản phẩm
        'applied_categories',  // json list id danh mục
        'excluded_products',   // json list id sản phẩm loại trừ
        'excluded_categories', // json list id danh mục loại trừ
        'start_date',
        'end_date',
        'status',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'applied_products' => 'array',
        'applied_categories' => 'array',
        'excluded_products' => 'array',
        'excluded_categories' => 'array',
    ];
   

    public function getTimeRemainingAttribute()
    {
        $now = Carbon::now();
        $end = Carbon::parse($this->end_date);
    
        if ($now->gt($end)) {
            return 'Đã hết hạn';
        }
    
        return $now->diffForHumans($end, [
            'parts' => 3,  // hiện tối đa 3 mốc (vd: 1 tháng 2 ngày 3 giờ)
            'short' => true, // viết ngắn gọn
            'syntax' => Carbon::DIFF_ABSOLUTE
        ]);
    }
        
}
