<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;

class AddressController extends Controller
{
    protected function getUser()
    {
        return User::first(); // 🛠 user test mặc định
    }

    public function index()
    {
        $addresses = $this->getUser()->addresses()->latest()->get();
        return view('client.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('client.addresses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'recipient_name' => 'required|string',
            'phone_number' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'detailed_address' => 'required|string',
            'address_type' => 'in:Home,Office,Other',
            'is_default' => 'nullable|boolean',
        ]);

        $data['user_id'] = $this->getUser()->id;
        $data['is_default'] = $request->has('is_default');

        if ($data['is_default']) {
            Address::where('user_id', $data['user_id'])->update(['is_default' => false]);
        }

        Address::create($data);
        return redirect()->route('client.addresses.index');
    }

    public function edit(Address $address)
    {
        return view('client.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $data = $request->validate([
            'recipient_name' => 'required|string',
            'phone_number' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'detailed_address' => 'required|string',
            'address_type' => 'in:Home,Office,Other',
            'is_default' => 'nullable|boolean',
        ]);

        $data['is_default'] = $request->has('is_default');

        if ($data['is_default']) {
            Address::where('user_id', $this->getUser()->id)->update(['is_default' => false]);
        }

        $address->update($data);
        return redirect()->route('client.addresses.index');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('client.addresses.index');
    }

    public function setDefault(Address $address)
    {
        $userId = $this->getUser()->id;

        Address::where('user_id', $userId)->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return redirect()->route('client.addresses.index');
    }

    public function selectAddress(Request $request)
    {
        $address = Address::findOrFail($request->address_id);

        session(['selected_address' => [
            'full_name' => $address->recipient_name,
            'phone' => $address->phone_number,
            'address' => $address->detailed_address . ', ' . $address->ward . ', ' . $address->district . ', ' . $address->province,
        ]]);

        return redirect()->route('client.cart.index')->with('success', 'Đã chọn địa chỉ giao hàng!');
    }
}

