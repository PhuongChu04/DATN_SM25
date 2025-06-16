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
        // $colors = Color::all();
        // $sizes = Size::all();
        return view('admin.product.create-product', compact('categories', 'brands'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'id_brand' => 'required',
            // 'variants.*.id-color' => 'required',
            // 'variants.*.id_size' => 'required',
            // 'variants.*.price' => 'required',
            // 'variants.*.quantity' => 'required',
            'id_category' => 'required',
            'image_primary' => 'required',
            'status' => 'required',
        ]);
        $path_image_primary = $request->file('image_primary')->store('images');
        $data['image_primary'] = $path_image_primary;


        Product::query()->create($data);
        return redirect()->route('product.listProduct');
    }
    public function detail(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.detail-product', compact('product', 'categories', 'brands'));
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit-product', compact('product', 'brands', 'categories'));
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
