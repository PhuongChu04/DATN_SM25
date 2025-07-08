<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Nhớ import model Product

class CartController extends Controller
{
    /**
     * Xử lý việc thêm sản phẩm vào giỏ hàng và chuyển hướng
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $product = Product::findOrFail($productId);
        
        // Lấy giỏ hàng từ session, nếu chưa có thì tạo mảng rỗng
        $cart = session()->get('cart', []);

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            // Nếu có rồi thì cộng thêm số lượng
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Nếu chưa có thì thêm mới
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->firstVariant->price ?? 0, // Lấy giá từ variant
                "image" => $product->image_primary
            ];
        }
        
        // Lưu lại giỏ hàng vào session
        session()->put('cart', $cart);

        // **QUAN TRỌNG**: Chuyển hướng người dùng đến trang giỏ hàng
        return redirect()->route('client.cart.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Hiển thị trang giỏ hàng
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Lấy một vài sản phẩm ngẫu nhiên làm "Sản phẩm liên quan"
        $relatedProducts = Product::inRandomOrder()->limit(4)->get();
        
        return view('client.cart.index', compact('cart', 'relatedProducts'));
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully');
    }

    /**
     * Cập nhật số lượng sản phẩm
     */
       /**
     * Cập nhật số lượng của nhiều sản phẩm trong giỏ hàng
     */
    public function update(Request $request)
    {
        if($request->quantities) {
            $cart = session()->get('cart');
            foreach($request->quantities as $id => $quantity) {
                if(isset($cart[$id])) {
                    // Đảm bảo số lượng là một số nguyên dương
                    $cart[$id]['quantity'] = max(1, (int)$quantity);
                }
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }
        return redirect()->back()->with('error', 'No quantities to update.');
    }
}