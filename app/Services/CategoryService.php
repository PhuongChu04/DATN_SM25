<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    //
    protected $category;

    public function __construct(Category $category){
        $this->category = $category;
    }
    public function getAllSizes()
    {
        $category = Category::all();
        return $category;
    }

    public function createSize($request)
    {
        $category = Category::create($request->all());
        return $category;
    }

    public function updateSize($request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return $category;
    }

    public function deleteSize($id)
    {
        $category = Category::find($id);
        $category->delete();
        return $category;
    }

    public function getSizeById($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function getSizeByName($name)
    {
        $category = Category::where('name', $name)->first();
        return $category;
    }
}
