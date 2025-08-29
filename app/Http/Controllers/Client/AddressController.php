<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AddressController extends Controller
{
    /**
     * Địa chỉ
     * Lấy người dùng đã đăng nhập
     */
    protected function getUser()
    {
        return Sentinel::check(); // Trả về người dùng đã đăng nhập
    }

    /**
     * Hiển thị danh sách địa chỉ của người dùng
     */
    public function index()
    {
        $user = $this->getUser();  // Lấy người dùng đã đăng nhập

        // Kiểm tra người dùng đã đăng nhập chưa
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để xem địa chỉ.');
        }

        // Truy vấn bảng addresses theo user_id của người dùng đã đăng nhập
        $addresses = Address::where('user_id', $user->id)->latest()->get(); // Truy vấn các địa chỉ của người dùng đã đăng nhập

        return view('client.addresses.index', compact('addresses'));
    }

    /**
     * Hiển thị form tạo mới địa chỉ
     */
    public function create()
    {
        return view('client.addresses.create');
    }

    /**
     * Lưu địa chỉ vào cơ sở dữ liệu
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'recipient_name' => 'required|string',
            'phone_number' => 'required|string',
            'province' => 'required|string',
            'ward' => 'required|string', // Bỏ district
            'detailed_address' => 'required|string',
            'address_type' => 'in:Home,Office,Other',
            'is_default' => 'nullable|boolean',
        ]);

        $user = $this->getUser();  // Lấy người dùng đã đăng nhập

        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để lưu địa chỉ.');
        }

        // Lấy user_id từ người dùng đã đăng nhập
        $data['user_id'] = $user->id;
        $data['is_default'] = $request->has('is_default');

        // Nếu là địa chỉ mặc định, cập nhật lại các địa chỉ khác
        if ($data['is_default']) {
            Address::where('user_id', $data['user_id'])->update(['is_default' => false]);
        }

        // Tạo địa chỉ mới
        Address::create($data);
        return redirect()->route('client.addresses.index');
    }

    /**
     * Hiển thị form chỉnh sửa địa chỉ
     */
    public function edit(Address $address)
    {
        return view('client.addresses.edit', compact('address'));
    }

    /**
     * Cập nhật địa chỉ của người dùng
     */
    public function update(Request $request, Address $address)
    {
        $data = $request->validate([
            'recipient_name' => 'required|string',
            'phone_number' => 'required|string',
            'province' => 'required|string',
            'ward' => 'required|string', // Bỏ district
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

    /**
     * Xóa địa chỉ khỏi cơ sở dữ liệu
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('client.addresses.index');
    }

    /**
     * Đặt địa chỉ làm mặc định
     */
    public function setDefault(Address $address)
    {
        $userId = $this->getUser()->id;

        Address::where('user_id', $userId)->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return redirect()->route('client.addresses.index');
    }

    /**
     * Chọn địa chỉ giao hàng và lưu vào session
     */
    public function selectAddress(Request $request)
    {
        $address = Address::findOrFail($request->address_id);

        session(['selected_address' => [
            'full_name' => $address->recipient_name,
            'phone' => $address->phone_number,
            'address' => $address->detailed_address . ', ' . $address->ward . ', ' . $address->province, // Bỏ district
        ]]);

        return redirect()->route('client.cart.index')->with('success', 'Đã chọn địa chỉ giao hàng!');
    }
    
}
