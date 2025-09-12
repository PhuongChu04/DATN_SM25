<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    protected $voucherService;
    public function __construct(VoucherService $voucherService){
        $this->voucherService = $voucherService;
    }
    //
    public function list(){
        $vouchers = $this->voucherService->getAllVoucher();
        return view('admin.coupons.couponsList', compact('vouchers'));
    }
    public function create(){
        return view('admin.coupons.couponsAdd');
    }
 
   
    public function store(Request $request){
        
        $data = [
            'name' => $request->coupons_name,
            'code' => $request->coupons_code,
            'description' => $request->description,
            'discount_amount' => $request->discount_amount,
            'type' => $request->type,
            'quantity' => $request->coupons_quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'max_discount' => $request->max_discount,
            'min_order_amount' => $request->min_order_amount,
            'usage_limit_per_user' => $request->usage_limit_per_user,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];
        

     
        $this->voucherService->createVoucher($data);
        return redirect()->route('admin.voucher.listVoucher')->with('success', 'Voucher created successfully');
    }
    public function edit(string $id)
    {
        //
        $voucher = $this->voucherService->getVoucherById($id);
        return view('admin.coupons.couponsEdit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        // $request->validate([
        //     'coupons_name' => 'required|string|max:255',
        //     'coupons_code' => 'required|string|max:255|unique:vouchers,code,' . $id,
        //     'description' => 'nullable|string',
        //     'discount_amount' => 'required|numeric|min:0',
        //     'type' => 'required|in:0,1,2',
        //     'coupons_quantity' => 'required|integer|min:0',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|after_or_equal:start_date',
        //     'status' => 'required|in:0,1,2',      
        //     'max_discount' => 'required|numeric|min:0',
        //     'min_order_amount' => 'required|numeric|min:0',
        //     'usage_limit_per_user' => 'required|integer|min:0',
        //     'is_active' => 'required|in:0,1',
        // ]);
        $data = [
            'name' => $request->coupons_name,
            'code' => $request->coupons_code,
            'description' => $request->note,
            'discount_amount' => $request->discount_amount,
            'type' => $request->type,
            'quantity' => $request->coupons_quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'max_discount' => $request->max_discount,
            'min_order_amount' => $request->min_order_amount,
            'usage_limit_per_user' => $request->usage_limit_per_user,
            'is_active' => $request->input('is_active', 0),

        ];
        // dd($data);
        
    
         $this->voucherService->updateVoucher($data, $id);
        
    
        return redirect()->route('admin.voucher.listVoucher')->with('success', 'Cập nhật voucher thành công!');
    }

    public function detail(string $id){
        $voucher = $this->voucherService->getVoucherById($id);
        return view('admin.coupons.detailCoupon', compact('voucher'));
    }
    public function destroy(string $id)
    {
        // $voucher = $this->voucherService->deleteVoucher($id);
       $voucher= $this->voucherService->softDeleteWithStatus($id);

        if($voucher){
            return redirect()->route('admin.voucher.listVoucher')->with('success', 'Voucher Xóa Thành Công');
        }else{
            return redirect()->route('admin.color.listVoucher')->with('error', 'Voucher Xóa Không Thành Công');
        }
    }

    public function trash()
    {
        $trashedVouchers = $this->voucherService->getTrashedList();

        return view('admin.coupons.trashVoucher', compact('trashedVouchers'));
    }
    public function restore($id)
{
    $this->voucherService->restore($id);
    return redirect()->route('admin.voucher.listVoucher');
}

public function forceDelete($id)
{
    $this->voucherService->forceDelete($id);
    return redirect()->route('admin.voucher.listVoucher');
}



public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);

    if (empty($ids)) {
        return back()->with('error', 'Không có mục nào được chọn');
    }

    $this->voucherService->bulkDelete($ids);

    return back()->with('success', 'Đã xóa mềm các mục đã chọn');
}

public function bulkRestore(Request $request)
{

    // dd($request->all());
    $this->voucherService->bulkRestoreVoucher($request->ids ?? []);
    return redirect()->route('admin.voucher.listVoucher');
}
}
