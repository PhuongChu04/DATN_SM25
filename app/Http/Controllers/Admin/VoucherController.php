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
            'description' => $request->note,
            'discount_amount' => $request->discount_amount,
            'type' => $request->type,
            'quantity' => $request->coupons_quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
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
        //
        $request->validate([
            'coupons_name' => 'required|string|max:255',
            'coupons_code' => 'required|string|max:255|unique:vouchers,code,' . $id,
            'description' => 'nullable|string',
            'discount_amount' => 'required|numeric|min:0',
            'type' => 'required|in:0,1,2',
            'coupons_quantity' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:0,1,2',
        ]);
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
        ];
    
         $this->voucherService->updateVoucher($data, $id);
        
    
        return redirect()->route('admin.voucher.listVoucher')->with('success', 'Cập nhật voucher thành công!');
    }
}
