<?php

namespace App\Services;

use App\Models\ParentCategory;

class ParentCategoryService
{
    //
    protected $parentCategory;

    public function __construct(ParentCategory $parentCategory){
        $this->parentCategory = $parentCategory;
    }
    public function getAllParentCategory()
    {
        $parentCategory = ParentCategory::all();
        return $parentCategory;
    }

    public function createSize($request)
    {
        $parentCategory = ParentCategory::create($request->all());
        return $parentCategory;
    }

    public function updateSize($request, $id)
    {
        $parentCategory = ParentCategory::find($id);
        $parentCategory->update($request->all());
        return $parentCategory;
    }

    public function deleteSize($id)
    {
        $parentCategory = ParentCategory::find($id);
        $parentCategory->delete();
        return $parentCategory;
    }

    public function getSizeById($id)
    {
        $parentCategory = ParentCategory::find($id);
        return $parentCategory;
    }

    public function getSizeByName($name)
    {
        $parentCategory = ParentCategory::where('name', $name)->first();
        return $parentCategory;
    }
}
