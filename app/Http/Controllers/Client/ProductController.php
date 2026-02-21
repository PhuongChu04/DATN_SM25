<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use App\Models\ProductVariant;

class ProductController extends Controller
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

    //==================Hiển thị trang chủ==================
    // public function index()
    // {
    //     $products = Product::latest('id')
    //         ->with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
    //         ->paginate(10);

    //     $categories = $this->categoryService->getAllCategories();

    //     $categoriesWithProducts = Category::with(['products' => function ($query) {
    //         $query->with(['firstVariant', 'colors'])
    //             ->latest()
    //             ->take(8);
    //     }])
    //         ->whereHas('products')
    //         ->get();

    //     return view('client.home', compact('products', 'categories', 'categoriesWithProducts'));
    // }

    //==================Hiển thị shop - danh sách sản phẩm==================
    public function listProducts()
    {

        $products = Product::with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
            ->paginate(10);
        // dd($products);
        return view('client.products.shop', compact('products'));
    }

    //==================Hiển thị product detail==================
    public function detailProduct($id)
    {

        $product = Product::with(['brand', 'category', 'colors', 'sizes', 'firstVariant', 'albums'])
            ->findOrFail($id);

        $similarProducts = Product::where(function ($query) use ($product) {
            $query->where('id_category', $product->id_category)
                ->orWhere('id_brand', $product->id_brand);
        })
            ->where('id', '!=', $product->id)
            ->with('firstVariant', 'colors')
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('client.products.detailProduct', compact('product', 'similarProducts'));
    }

    //==================Hiển thị sp sale==================
    public function saleProducts()
    {

        $products = Product::query()
            ->join('product_variants as pv', 'pv.id_product', '=', 'products.id')
            ->whereNotNull('pv.sale_price')
            ->whereColumn('pv.sale_price', '<', 'pv.price')
            ->select('products.*', 'pv.id as variant_id', 'pv.sale_price', 'pv.price as variant_price')
            ->with(['brand', 'category', 'colors', 'sizes', 'firstVariant', 'albums'])
            ->paginate(16);

        return view('client.sale.list', compact('products'));
    }

    //==================Hiển thị sp mới==================
    public function newProducts()
    {

        $products = Product::query()
            ->with(['brand', 'category', 'colors', 'sizes', 'firstVariant', 'albums'])
            ->orderByDesc('id')
            ->paginate(16);

        return view('client.products.newProducts', compact('products'));
    }













    // // Hiển thị tất cả sản phẩm
    // public function viewAll()
    // {
    //     $products = Product::all();
    //     return view('client.viewAll', compact('products'));
    // }

    // // Trang chi tiết sản phẩm (tùy chỉnh sau nếu cần)
    // public function show($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('client.productDetail', compact('product'));
    // }
}
