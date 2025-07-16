<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;
use App\Models\Wishlist;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

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
            ->with('firstVariant', 'colors')
            ->inRandomOrder()
            ->take(10)
            ->get();

        return view('client.products.detailProduct', compact('product', 'similarProducts'));
    }

    //================== CÁC PHƯƠNG THỨC WISHLIST ==================
    public function toggleWishlist(Request $request, Product $product)
    {
        if (!$user = Sentinel::getUser()) {
            return response()->json(['error' => 'Unauthenticated', 'message' => 'Bạn cần đăng nhập để thực hiện chức năng này.'], 401);
        }

        $wishlistItem = Wishlist::where('id_user', $user->id)
            ->where('id_product', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'id_user' => $user->id,
                'id_product' => $product->id,
            ]);
            $status = 'added';
        }

        $count = Wishlist::where('id_user', $user->id)->count();


        return response()->json([
            'status' => $status,
            'count' => $count,
        ]);
    }

    public function wishlistProduct()
    {
        if (!$user = Sentinel::getUser()) {
            return redirect()->route('auth.loginClient')->with('error', 'Bạn cần đăng nhập để xem danh sách yêu thích.');
        }

        $wishlistItems = Wishlist::where('id_user', $user->id)
            ->with(['product.firstVariant', 'product.brand', 'product.colors'])
            ->latest()
            ->get();

        return view('client.products.wishlistProduct', compact('wishlistItems'));
    }













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
