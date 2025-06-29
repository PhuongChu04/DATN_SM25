<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Services\SizeService;
class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $sizeService;
    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }
    public function list()
    {

        //
        $sizes = $this->sizeService->getAllSizes();
        // return $sizes;
        return view('admin.size.listSize', compact('sizes'));
        // return view('admin.test');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.size.addSize');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $size = $this->sizeService->createSize($request);
        if($size){
            return redirect()->route('admin.size.listSize')->with('success', 'Size created successfully');
        }else{
            return redirect()->route('admin.size.listSize')->with('error', 'Size creation failed');
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
        $size = $this->sizeService->getSizeById($id);
        return view('admin.size.editSize', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        $size = $this->sizeService->updateSize($request, $id);
        $size->save();
        if($size){
            return redirect()->route('admin.size.listSize')->with('success', 'Color updated successfully');
        }else{
            return redirect()->route('admin.size.listSize')->with('error', 'Color update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $size = $this->sizeService->deleteSize($id);
        if($size){
            return redirect()->route('admin.size.listSize')->with('success', 'Color deleted successfully');
        }else{
            return redirect()->route('admin.size.listSize')->with('error', 'Color deletion failed');
        }
    }
    public function trash()
    {
        $trashedSizes = $this->sizeService->getTrashedList();

        return view('admin.size.trashSize', compact('trashedSizes'));
    }
    public function restore($id)
{
    $this->sizeService->restore($id);
    return redirect()->route('admin.size.listSize');
}

public function forceDelete($id)
{
    $this->sizeService->forceDelete($id);
    return redirect()->route('admin.size.listSize');
}



public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);

    if (empty($ids)) {
        return redirect()->route('admin.size.listSize');
    }

    $this->sizeService->bulkDelete($ids);

    return redirect()->route('admin.size.listSize');
}

public function bulkRestoreSize(Request $request)
{

    $this->sizeService->bulkRestoreSize($request->ids ?? []);
    return redirect()->route('admin.size.listSize');
}
}
