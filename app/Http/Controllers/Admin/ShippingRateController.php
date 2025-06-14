<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingRate;
use App\Models\Shipping;

class ShippingRateController extends Controller
{
    public function index()
    {
        $rates = ShippingRate::with('shipping')->get();
        return view('admin.shipping_rates.index', compact('rates'));
    }

    public function create()
    {
        $shippings = Shipping::all();
        return view('admin.shipping_rates.create', compact('shippings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_id' => 'required|exists:shippings,id',
            'min_km' => 'required|integer|min:0',
            'max_km' => 'required|integer|gte:min_km',
            'fee' => 'required|numeric|min:0',
        ], [
            'max_km.gte' => 'Khoảng cách tối đa phải lớn hơn hoặc bằng khoảng cách tối thiểu.',
        ]);

        ShippingRate::create($request->only(['shipping_id', 'min_km', 'max_km', 'fee']));

        return redirect()->route('admin.shipping-rates.index')
            ->with('success', 'Thêm bảng giá thành công');
    }


    public function edit(ShippingRate $shippingRate)
    {
        $shippings = Shipping::all();
        return view('admin.shipping_rates.edit', compact('shippingRate', 'shippings'));
    }

    public function update(Request $request, ShippingRate $shippingRate)
    {
        $request->validate([
            'shipping_id' => 'required|exists:shippings,id',
            'min_km' => 'required|integer|min:0',
            'max_km' => 'required|integer|gte:min_km',
            'fee' => 'required|numeric|min:0'
        ]);
        $shippingRate->update($request->all());
        return redirect()->route('admin.shipping-rates.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(ShippingRate $shippingRate)
    {
        $shippingRate->delete();
        return redirect()->back()->with('success', 'Xoá thành công');
    }
}
