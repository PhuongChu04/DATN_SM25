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
use App\Models\Review;
use Illuminate\Support\Facades\DB;

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
    public function detailProduct($productId)
{
    // Lấy thông tin sản phẩm
    $product = Product::find($productId);

    // Lấy các đánh giá của sản phẩm
    $reviews = DB::table('reviews')
                ->where('product_id', $productId)
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->select('reviews.rating', 'reviews.comment', 'reviews.admin_reply',
                         DB::raw("CONCAT(users.first_name, ' ', users.last_name) as user_name"))
                ->get();

    // Lấy các biến thể của sản phẩm (nếu có)
    $variants = $product->variants;
    $minPrice = $variants->min('price');
    $maxPrice = $variants->max('price');
    $priceRange = number_format($minPrice, 0, ',', '.') . '₫ - ' . number_format($maxPrice, 0, ',', '.') . '₫';

    // Lấy các sản phẩm tương tự (gợi ý)
    $similarProducts = Product::where(function ($query) use ($product) {
        $query->where('id_category', $product->id_category)
            ->orWhere('id_brand', $product->id_brand);
    })
    ->where('id', '!=', $product->id)
    ->with('firstVariant', 'colors')
    ->inRandomOrder()
    ->take(10)
    ->get();

    // Trả về view với tất cả dữ liệu cần thiết
    return view('client.products.detailProduct', compact('product', 'reviews', 'priceRange', 'similarProducts'));
}






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function searchClient(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::with(['brand', 'category'])
            ->when(!empty($searchTerm), function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('brand', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            })->paginate(10);
        $search = $searchTerm;
        if ($request->ajax()) {
            return view('client.components.product-list', compact('products'))->render();
        }
        return view('client.shop', compact('products', 'search'));
    }




}
