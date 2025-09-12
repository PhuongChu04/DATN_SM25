<?php

namespace App\Services;


use App\Models\Voucher;

class VoucherService
{
    //
    protected $voucher;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function getAllVoucher()
    {
        $voucher = Voucher::all();
        return $voucher;
    }

    public function createVoucher(array $data)
    {
        
       
        return Voucher::create($data);
    }

    public function updateVoucher($data, $id)
    {
        $voucher = Voucher::findOrFail($id);
        return $voucher->update($data);
    }

    public function deleteVoucher($id)
    {
        $voucher = Voucher::find($id);
        $voucher->delete();
        return $voucher;
    }

    public function softDeleteWithStatus($id)
{
    $voucher = Voucher::findOrFail($id);
    $voucher->status = 'inactive';
    $voucher->save();
    return $voucher->delete();
}

    public function getVoucherById($id)
    {
        $voucher = Voucher::find($id);
        return $voucher;
    }

    public function getVoucherByName($name)
    {
        $voucher = Voucher::where('name', $name)->first();
        return $voucher;
    }
    public function type($type){
        if($type == 0){
            return 'Free Shipping';
        }elseif($type == 1){
            return 'Percentage';
        }elseif($type == 2){
            return 'Fixed Amount';
        }else{
            return 'Unknown';
        }
    }
    public function find($id)
    {
        return Voucher::findOrFail($id);
    }
    public function getStatus($status){
        if($status == 0){
            return 'Active';
        }elseif($status == 1){
            return 'Inactive';
        }elseif($status == 2){
            return 'Future Plan';
        }else{
            return 'Unknown';
        }
    }
    public function countCoupons(){
        return Voucher::count();
    }
    public function getCouponsByStatus($status){
        return Voucher::where('status', $status)->get();
    }
    public function getCouponsByType($type){
        return Voucher::where('type', $type)->get();
    }
    public function getCouponsByDate($start_date, $end_date){
        return Voucher::whereBetween('start_date', [$start_date, $end_date])->get();
    }

    public function getTrashedList(){
        $list = Voucher::onlyTrashed()->get();
        return $list;
    }
    public function restore($id)
{
    $voucher = Voucher::withTrashed()->findOrFail($id);
    return $voucher->restore();
}

public function forceDelete($id)
{
    $voucher = Voucher::withTrashed()->findOrFail($id);
    return $voucher->forceDelete();
}

public function bulkDelete(array $ids)
{
    return Voucher::whereIn('id', $ids)->delete(); // soft delete
}

public function bulkRestoreVoucher(array $ids)
{
    return Voucher::onlyTrashed()->whereIn('id', $ids)->restore();
}
public function getByCode(string $code)
{
    return Voucher::where('code', $code)->first();
}

public function applyVoucher($userId, $orderTotal, $voucherCode)
    {
        $voucher = $this->getByCode($voucherCode);

        if (!$voucher) {
            return ['success' => false, 'message' => 'Mã giảm giá không tồn tại'];
        }

        // kiểm tra ngày hiệu lực
        $now = now();
        if ($voucher->start_date > $now || $voucher->end_date < $now) {
            return ['success' => false, 'message' => 'Mã giảm giá đã hết hạn hoặc chưa bắt đầu'];
        }

        // kiểm tra số lượng
        if ($voucher->quantity <= 0) {
            return ['success' => false, 'message' => 'Mã giảm giá đã hết lượt sử dụng'];
        }

        // kiểm tra giá trị tối thiểu
        if ($orderTotal < $voucher->min_order_value) {
            return ['success' => false, 'message' => 'Đơn hàng chưa đạt giá trị tối thiểu'];
        }

        // TODO: kiểm tra số lần user đã dùng (cần bảng trung gian voucher_user hoặc order_voucher)

        // tính toán giảm giá
        $discount = 0;
        if ($voucher->type == 1) { // %
            $discount = $orderTotal * ($voucher->discount_amount / 100);
            if ($voucher->max_discount_value && $discount > $voucher->max_discount_value) {
                $discount = $voucher->max_discount_value;
            }
        } elseif ($voucher->type == 2) { // fixed
            $discount = $voucher->discount_amount;
        } elseif ($voucher->type == 0) { // free ship
            // ví dụ free ship thì để discount = phí ship sau này tính
            $discount = 0;
        }

        return [
            'success' => true,
            'message' => 'Áp dụng mã thành công',
            'discount' => $discount,
            'final_total' => max(0, $orderTotal - $discount),
            'voucher' => $voucher,
        ];
    }



}
