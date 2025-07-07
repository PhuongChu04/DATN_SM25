<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị tất cả sản phẩm
    public function viewAll()
    {
        $products = Product::all();
        return view('client.viewAll', compact('products'));
    }

    // Trang chi tiết sản phẩm (tùy chỉnh sau nếu cần)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('client.productDetail', compact('product'));
    }
}
