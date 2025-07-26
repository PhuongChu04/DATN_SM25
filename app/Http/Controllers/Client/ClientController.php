<?php

namespace App\Http\Controllers\Client;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class ClientController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $productVariantService;
    public function __construct(ProductService $productService, ProductVariantService $productVariantService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }


   public function homeClient()
{
    $categories = $this->categoryService->getAllCategories(); // Lấy tất cả danh mục sản phẩm

    // Lấy 10 sản phẩm mới nhất có biến thể
    $products = Product::with('variants') // Eager load variants
        ->whereHas('variants') // Lọc các sản phẩm có biến thể
        ->latest()
        ->take(10)
        ->get();

    // Tính toán dải giá cho tất cả các biến thể của sản phẩm
    foreach ($products as $product) {
        $variants = $product->variants; // Lấy tất cả các biến thể của sản phẩm
        $minPrice = $variants->min('price'); // Lấy giá thấp nhất
        $maxPrice = $variants->max('price'); // Lấy giá cao nhất

        // Gán dải giá vào thuộc tính dải giá của sản phẩm
        $product->priceRange = number_format($minPrice, 0, ',', '.') . ' - ' . number_format($maxPrice, 0, ',', '.');
    }

    // Trả về view trang chủ với danh mục và sản phẩm
    return view('client.home', compact('categories', 'products'));
}


    public function account()
    {
        $user = Sentinel::getUser(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.accounts.account', compact('user'));
    }
}
