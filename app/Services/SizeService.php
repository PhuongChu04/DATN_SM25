<?php

namespace App\Services;

use App\Models\Size;

    class SizeService
{
    //
    protected $size;
    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    public function getAllSizes()
    {
        $sizes = Size::all();
        return $sizes;
    }

    public function createSize($request)
    {
        $size = Size::create($request->all());
        return $size;
    }

    public function updateSize($request, $id)
    {
        $size = Size::find($id);
        $size->update($request->all());
        return $size;
    }

    public function deleteSize($id)
    {
        $size = Size::find($id);
        $size->delete();
        return $size;
    }

    public function getSizeById($id)
    {
        $size = Size::find($id);
        return $size;
    }

    public function getSizeByName($name)
    {
        $size = Size::where('name', $name)->first();
        return $size;
    }
}
