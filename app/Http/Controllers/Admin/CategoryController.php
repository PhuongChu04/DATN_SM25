<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::query()->latest('id')->paginate(10);
        return view('admin.category.listCategories', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.addCategory');
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Tự động lưu vào storage/app/category và trả về path
            // dd($request->file('image'));
            $data['image'] = Storage::put('public/category', $request->file('image'));
        }

        Category::create($data);

        return redirect()->route('admin.listCategory.list')->with('success', 'Thêm thành công');
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
        // $category = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.category.updateCategory', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // Giả định bạn đang dùng Request và id
    {
        $category = Category::findOrFail($id); // Tìm category theo ID

        $data = $request->except('image'); // Lấy tất cả dữ liệu trừ 'image'

        $currentImage = $category->image; // Lưu đường dẫn ảnh CŨ trước khi xử lý ảnh mới

        $newImagePath = null; // Biến để lưu đường dẫn ảnh mới nếu có

        if ($request->hasFile('image')) { // Luôn dùng hasFile để kiểm tra file được upload
            $newImagePath = Storage::put('public/category', $request->file('image')); // Lưu ảnh mới
            $data["image"] = $newImagePath; // Cập nhật đường dẫn ảnh MỚI vào mảng $data
        }

        $is_update = $category->update($data); // Cập nhật category vào database

        // --- Logic xóa ảnh cũ chỉ khi update thành công và có ảnh mới ---
        if ($is_update && $newImagePath) { // Nếu update thành công VÀ có ảnh mới được tải lên
            if ($currentImage && Storage::exists($currentImage)) { // Nếu có ảnh cũ VÀ ảnh cũ tồn tại trên storage
                Storage::delete($currentImage); // Xóa ảnh cũ
            }
        }
        // ---------------------------------------------------------------

        if ($is_update) {
            return redirect()->route("admin.listCategory.list")->with("success", "Sửa thành công sản phẩm!");
        } else {
            return redirect()->route("admin.listCategory.list")->with("error", "Sửa không thành công!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $imagePath = $category->image;

        if ($imagePath && Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $category->delete();
        return redirect()->route('admin.listCategory.list');
    }
}
