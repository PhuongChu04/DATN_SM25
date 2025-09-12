<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VoucherService;

class VoucherController extends Controller
{
    //
    protected $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    // API áp mã giảm giá
    public function apply(Request $request)
    {
        $voucherCode = $request->voucher_code;
        $orderTotal = $request->order_total;

        $result = $this->voucherService->applyVoucher(auth()->id(), $orderTotal, $voucherCode);

        return response()->json($result);
    }
}
