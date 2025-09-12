<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Services\VoucherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    protected $voucherService;

    public function __construct(VoucherService $voucherService){
        $this->voucherService = $voucherService;
    }

    public function list(){
        $vouchers = $this->voucherService->getAllVoucher();
        return view('admin.coupons.couponsList', compact('vouchers'));
    }

    public function create(){
        $products = Product::all();
        $categories = Category::all();
        return view('admin.coupons.couponsAdd', compact('products', 'categories'));
    }

    // ================= STORE =================
    public function store(Request $request){
        $now = now();

        // Tự tính status
        if ($request->start_date <= $now && $request->end_date >= $now) {
            $status = 0; // đang diễn ra
        } elseif ($request->end_date < $now) {
            $status = 1; // hết hạn
        } else {
            $status = 2; // chưa bắt đầu
        }

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'discount_amount' => $request->discount_amount,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status,
            'max_discount_value' => $request->max_discount_value,
            'min_order_value' => $request->min_order_value,
            'usage_per_user' => $request->usage_per_user,
            'is_active' => $request->has('is_active') ? 1 : 0,

            'applied_products'   => json_encode($request->applied_products ?? []),
            'applied_categories' => json_encode($request->applied_categories ?? []),
            'excluded_products'  => json_encode($request->excluded_products ?? []),
            'excluded_categories'=> json_encode($request->excluded_categories ?? []),

            'created_by' => auth()->id(),
        ];

        $this->voucherService->createVoucher($data);
        return redirect()->route('admin.voucher.listVoucher')->with('success', 'Voucher created successfully');
    }

    public function edit(string $id){
        $voucher = $this->voucherService->getVoucherById($id);
        $products = Product::all();
        $categories = Category::all();
        return view('admin.coupons.couponsEdit', compact('voucher', 'products', 'categories'));
    }

    // ================= UPDATE =================
    public function update(Request $request, string $id){
        $now = now();

        if ($request->start_date <= $now && $request->end_date >= $now) {
            $status = 0; // đang diễn ra
        } elseif ($request->end_date < $now) {
            $status = 1; // hết hạn
        } else {
            $status = 2; // chưa bắt đầu
        }

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'discount_amount' => $request->discount_amount,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $status,
            'max_discount_value' => $request->max_discount_value,
            'min_order_value' => $request->min_order_value,
            'usage_per_user' => $request->usage_per_user,
            'is_active' => $request->has('is_active') ? 1 : 0,

            'applied_products'   => json_encode($request->applied_products ?? []),
            'applied_categories' => json_encode($request->applied_categories ?? []),
            'excluded_products'  => json_encode($request->excluded_products ?? []),
            'excluded_categories'=> json_encode($request->excluded_categories ?? []),

            'updated_by' => auth()->id(),
        ];

        $this->voucherService->updateVoucher($data, $id);
        return redirect()->route('admin.voucher.listVoucher')->with('success', 'Cập nhật voucher thành công!');
    }

    public function detail(string $id){
        $voucher = $this->voucherService->getVoucherById($id);
        return view('admin.coupons.detailCoupon', compact('voucher'));
    }

    public function destroy(string $id){
        $voucher= $this->voucherService->softDeleteWithStatus($id);

        if($voucher){
            return redirect()->route('admin.voucher.listVoucher')->with('success', 'Voucher Xóa Thành Công');
        }else{
            return redirect()->route('admin.color.listVoucher')->with('error', 'Voucher Xóa Không Thành Công');
        }
    }

    public function trash(){
        $trashedVouchers = $this->voucherService->getTrashedList();
        return view('admin.coupons.trashVoucher', compact('trashedVouchers'));
    }

    public function restore($id){
        $this->voucherService->restore($id);
        return redirect()->route('admin.voucher.listVoucher');
    }

    public function forceDelete($id){
        $this->voucherService->forceDelete($id);
        return redirect()->route('admin.voucher.listVoucher');
    }

    public function bulkDelete(Request $request){
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Không có mục nào được chọn');
        }
        $this->voucherService->bulkDelete($ids);
        return back()->with('success', 'Đã xóa mềm các mục đã chọn');
    }

    public function bulkRestore(Request $request){
        $this->voucherService->bulkRestoreVoucher($request->ids ?? []);
        return redirect()->route('admin.voucher.listVoucher');
    }
}
