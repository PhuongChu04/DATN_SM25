<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;

        // Xử lý upload file
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('brands', 'public');
            $brand->image = $path; // lưu path vào DB
        }

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Thêm thương hiệu thành công');
    }
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);


        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $imagePath = $brand->image;
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('brands', 'public');
        }
        $brand->update([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Cập nhật thương hiệu thành công.');
    }


    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Xóa thương hiệu thành công');
    }
}
