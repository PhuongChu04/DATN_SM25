<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::query()->latest()->paginate(10);
        return view('admin.product.list-product', compact('products'));
    }
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $colors = Color::all();
        // $sizes = Size::all();
        // return view('admin.product.create-product', compact('categories', 'brands', 'colors', 'sizes'));
        return view('admin.product.create-product', compact('categories', 'brands', 'colors'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'id_brand' => 'required',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            // 'sizes' => 'required|array',
            // 'sizes.*' => 'exists:sizes,id',
            'variants.*.price' => 'required',
            'variants.*.quantity' => 'required',
            'id_category' => 'required',
            'image_primary' => 'required',
            'status' => 'required',
        ]);
        $path_image_primary = $request->file('image_primary')->store('images');
        $data['image_primary'] = $path_image_primary;
        $product = Product::query()->create($data);
        if ($request->has('sizes') && $request->has('colors')) {
            foreach ($request->sizes as $sizeId) {
                foreach ($request->colors as $colorId) {
                    $product->variants()->create([
                        'id_size' => $sizeId,
                        'id_color' => $colorId,
                        'price' => $request->input('variants.0.price'),
                        'quantity' => $request->input('variants.0.quantity'),
                    ]);
                }
            }
        }


        return redirect()->route('product.listProduct');
    }
    public function detail(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        // $sizes = Size::all();
        $colors = Color::all();
        $selectedSizes = $product->variants->pluck('id_size')->unique()->toArray();
        $selectedColors = $product->variants->pluck('id_color')->unique()->toArray();
        return view('admin.product.detail-product', compact('product', 'categories', 'brands','colors','selectedSizes', 'selectedColors'));
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        // $sizes = Size::all();
        $colors = Color::all();

        // Lấy các id size và color có trong variants của product
        $selectedSizes = $product->variants->pluck('id_size')->unique()->toArray();
        $selectedColors = $product->variants->pluck('id_color')->unique()->toArray();

        return view('admin.product.edit-product', compact('product', 'brands', 'categories',  'colors', 'selectedSizes', 'selectedColors'));
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'id_category' => 'sometimes|integer',
            'description' => 'sometimes|string',
            'id_brand' => 'sometimes|integer',
            'image_primary' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'sometimes|string|max:255',

            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.quantity' => 'required|integer',
        ]);

        $data['image_primary'] = $product->image_primary;

        if ($request->hasFile('image_primary')) {

            if (file_exists('storage/' . $product->image_primary)) {
                unlink('storage/' . $product->image_primary);
            }


            $path_image_primary = $request->file('image_primary')->store('images');
            $data['image_primary'] = $path_image_primary;
        }


        $product->update($data);
        $product->variants()->delete();

        // Tạo variants mới theo size + color
        if ($request->has('sizes') && $request->has('colors')) {
            // Xóa variants cũ
            $product->variants()->delete();

            // Tạo variants mới
            foreach ($request->sizes as $sizeId) {
                foreach ($request->colors as $colorId) {
                    $product->variants()->create([
                        'id_size' => $sizeId,
                        'id_color' => $colorId,
                        'price' => $request->input('variants.0.price', 0),
                        'quantity' => $request->input('variants.0.quantity', 0),
                    ]);
                }
            }
        }
        return redirect()->route('admin.listProduct')->with('cap nhat thanh cong');
    }
    public function destroy(Product $product)
    {
        if ($product->image_primary != null) {
            if (file_exists('storage/' . $product->image_primary)) {
                unlink('storage/' . $product->image_primary);
            }
        }

        $product->delete();
        return redirect()->route('admin.listProduct');
    }
}
