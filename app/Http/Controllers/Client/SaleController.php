<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Hiển thị trang top 5 sản phẩm bán chạy.
     */
    public function index()
    {
        $topProducts = Product::withSum('orderDetails', 'quantity')
            ->orderByDesc('order_details_sum_quantity')
            ->limit(5)
            ->get();
        return view('client.sale.index', compact('topProducts'));
    }
}
