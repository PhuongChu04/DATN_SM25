<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\ShippingRate;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{   
    protected $table = 'shippings';
    protected $fillable = ['provider_name', 'price'];
    public function index()
    {
        $shippings = Shipping::all();
        return view('admin.shippings.index', compact('shippings'));
    }

    public function create()
    {
        return view('admin.shippings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'provider_name' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        Shipping::create($request->only(['provider_name', 'price']));

        return redirect()->route('admin.shippings.index')
                        ->with('success', 'Thêm đơn vị thành công');
    }

    public function edit(Shipping $shipping)
    {
        return view('admin.shippings.edit', compact('shipping'));
    }

    public function update(Request $request, Shipping $shipping)
    {
        $request->validate([
            'provider_name' => 'required',
            'price' => 'required|numeric|min:0',
        ]);

        $shipping->update($request->only(['provider_name', 'price']));

        return redirect()->route('admin.shippings.index')
                        ->with('success', 'Cập nhật thành công');
    }

    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->back()->with('success', 'Xoá thành công');
    }
}
