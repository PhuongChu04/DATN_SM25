<?php

namespace App\Services;

use App\Models\Color;

class ColorService
{
    //
    protected $color;
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function getAllColors()
    {
        $colors = Color::all();
        return $colors;
    }

    public function createColor($request)
    {
        $color = Color::create($request->all());
        return $color;
    }

    public function updateColor($request, $id)
    {
        $color = Color::find($id);
        $color->update($request->all());
        return $color;
    }

    public function deleteColor($id)
    {
        $color = Color::find($id);
        $color->delete();
        return $color;
    }

    public function getColorById($id)
    {
        $color = Color::find($id);
        return $color;
    }

    public function getColorByCode($code)
    {
        $color = Color::where('code', $code)->first();
        return $color;
    }

    public function getColorByName($name)
    {
        $color = Color::where('name', $name)->first();
        return $color;
    }

    
    
    
}
