<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        $products = Product::latest('id')
            ->with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
            ->paginate(10);
        $categories = $this->categoryService->getAllCategories();

        // dd($products);
        return view('client.products.home', compact('products', 'categories'));
    }

    //==================Hiển thị shop - danh sách sản phẩm==================
    public function listProducts()
    {

        $products = Product::with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
            ->paginate(20);
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
            ->with('firstVariant','colors')
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('client.products.detailProduct', compact('product', 'similarProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
