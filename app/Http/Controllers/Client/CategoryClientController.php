<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryClientController extends Controller
{
    public function listCategoryClient(Request $request)
    {
        // Lấy list cate cho sidebar
        $categories = Category::orderBy('name')->get();

        // Cate đang chọn (nếu có)
        $categoryId = $request->integer('c');
        $categoryName = null;

        if ($categoryId) {
            $categoryName = Category::find($categoryId)?->name;
        }

        // Lấy sản phẩm mới nhất (mặc định latest() theo created_at)
        $products = Product::with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
            ->when($categoryId, fn($q) => $q->where('id_category', $categoryId))
            ->latest()                // = orderBy('created_at', 'desc')
            ->paginate(12)            // tuỳ bạn đổi 10/12/24…
            ->withQueryString();      // giữ lại ?c=... khi chuyển trang

        return view('client.category.listCategories', compact('categories', 'products', 'categoryId', 'categoryName'));
    }
}
