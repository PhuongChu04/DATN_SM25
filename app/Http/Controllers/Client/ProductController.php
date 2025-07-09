<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\ProductVariantService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * 
     */

    protected $categoryService;
    protected $productService;
    protected $productVariantService;
    public function __construct(ProductService $productService, ProductVariantService $productVariantService, CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
    }
    public function index()
    {
        $products = Product::latest('id')
            ->with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
            ->paginate(10);
        $categories = $this->categoryService->getAllCategories();

        // dd($products);
        return view('client.home', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listProducts()
    {

        $products = Product::latest('id')
            ->with(['brand', 'category', 'colors', 'sizes', 'firstVariant'])
            ->paginate(20);
        // dd($products);
        return view('client.shop', compact('products'));
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
