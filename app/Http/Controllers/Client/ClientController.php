<?php

namespace App\Http\Controllers\Client;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
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
        $categories = $this->categoryService->getAllCategories();
        //  dd($categories);
        $products = Product::with('variants')
    ->whereHas('variants')
    ->latest()
    ->take(10)
    ->get();


        $categoriesWithProducts = Category::with(['products' => function ($query) {
            $query->with(['firstVariant', 'colors'])
                ->latest()
                ->take(8);
        }])
            ->whereHas('products')
            ->get();
        return view('client.home',compact('categories', 'products' ,'categoriesWithProducts'));
    }

    // Trả về view trang chủ với danh mục và sản phẩm
   

    public function account()
    {
        $user = Sentinel::getUser(); // Lấy thông tin người dùng đã đăng nhập
        return view('client.accounts.account', compact('user'));
    }
}
