<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Hiển thị danh sách banner.
     */
    public function list()
    {
        $banners = Banner::orderBy('id','desc')->paginate(10);
        return view('admin.banner.list-banner', compact('banners'));
    }

    /**
     * Hiển thị form thêm mới banner.
     */
    public function create()
    {
        return view('admin.banner.create-banner');
    }

    /**
     * Lưu banner mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('image')) {
            $data['img'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('admin.banner.listBanner')->with('success', 'Thêm banner thành công!');
    }

    /**
     * Hiển thị chi tiết banner.
     */
    // public function show(string $id)
    // {
    //     $banner = Banner::findOrFail($id);
    //     return view('admin.banner.show', compact('banner'));
    // }

    /**
     * Hiển thị form sửa banner.
     */
    // public function edit(string $id)
    // {
    //     $banner = Banner::findOrFail($id);
    //     return view('admin.banner.edit', compact('banner'));
    // }

    /**
     * Cập nhật banner.
     */
    // public function update(Request $request, string $id)
    // {
    //     $banner = Banner::findOrFail($id);

    //     $request->validate([
    //         'title' => 'nullable|string|max:255',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //         'link'  => 'nullable|url',
    //         'status' => 'required|in:active,inactive',
    //         'sort_order' => 'nullable|integer',
    //     ]);

    //     $data = $request->only(['title', 'link', 'status', 'sort_order']);

    //     if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
    //         if ($banner->image && file_exists(public_path('storage/' . $banner->image))) {
    //             unlink(public_path('storage/' . $banner->image));
    //         }
    //         $data['image'] = $request->file('image')->store('banners', 'public');
    //     }

    //     $banner->update($data);

    //     return redirect()->route('admin.banner.index')->with('success', 'Cập nhật banner thành công!');
    // }

    /**
     * Xóa banner.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && file_exists(public_path('storage/' . $banner->image))) {
            unlink(public_path('storage/' . $banner->image));
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Xóa banner thành công!');
    }
}
