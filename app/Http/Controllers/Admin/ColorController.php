<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ColorService;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $colorService;
    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }
    public function list()
    {
        //
        $colors = $this->colorService->getAllColors();
        
        return view('admin.color.listColor', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.color.addColor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,code',
        ]);

        $color = $this->colorService->createColor($request);

        if($color){
            return redirect()->route('admin.color.listColor')->with('success', 'Color created successfully');
        }else{
            return redirect()->route('admin.color.listColor')->with('error', 'Color creation failed');
        }

        
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
        $color = $this->colorService->getColorById($id);
        return view('admin.color.editColor', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|regex:/^#[0-9A-Fa-f]{6}$/|unique:colors,code',
        ]);

        $color = $this->colorService->updateColor($request, $id);
        $color->save();
        if($color){
            return redirect()->route('admin.color.listColor')->with('success', 'Color updated successfully');
        }else{
            return redirect()->route('admin.color.listColor')->with('error', 'Color update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // $color = $this->colorService->getColorById($id);
        // if ($color->products()->exists()) {
        //     return redirect()->back()->with('error', 'Không thể xoá vì màu đang được sử dụng.');
        // }

        $color = $this->colorService->deleteColor($id);
        if($color){
            return redirect()->route('admin.color.listColor')->with('success', 'Color deleted successfully');
        }else{
            return redirect()->route('admin.color.listColor')->with('error', 'Color deletion failed');
        }
    }

    public function trash()
    {
        $trashedColors = $this->colorService->getTrashedList();

        return view('admin.color.trashColor', compact('trashedColors'));
    }
    public function restore($id)
{
    $this->colorService->restore($id);
    return redirect()->route('admin.color.listColor');
}

public function forceDelete($id)
{
    $this->colorService->forceDelete($id);
    return redirect()->route('admin.color.listColor');
}

public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);

    if (empty($ids)) {
        return back()->with('error', 'Không có mục nào được chọn');
    }

    $this->colorService->bulkDelete($ids);

    return back()->with('success', 'Đã xóa mềm các mục đã chọn');
}

public function bulkRestore(Request $request)
{

    $this->colorService->bulkRestoreColor($request->ids ?? []);
    return redirect()->route('admin.color.listColor');
}

    
}
