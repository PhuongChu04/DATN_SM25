<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductVariant;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Xử lý việc thêm sản phẩm vào giỏ hàng
     */
    public function add(Request $request)
    {
        Log::info('Bắt đầu thêm giỏ hàng:', $request->all());


        try {
            // Validate dữ liệu
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'id_color' => 'required|exists:colors,id',
                'id_size' => 'required|exists:sizes,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $productId = $request->input('product_id');
            $colorId = $request->input('id_color');
            $sizeId = $request->input('id_size');
            $quantity = $request->input('quantity');
            Log::info('Dữ liệu đầu vào:', [
                'product_id' => $productId,
                'id_color' => $colorId,
                'id_size' => $sizeId,
                'quantity' => $quantity
            ]);

            // Tìm variant
            $variant = ProductVariant::where('id_product', $productId)
                                    ->where('id_color', $colorId)
                                    ->where('id_size', $sizeId)
                                    ->with('product', 'color', 'size')
                                    ->first();

            if (!$variant) {
                Log::error('Không tìm thấy biến thể:', [
                    'id_product' => $productId,
                    'id_color' => $colorId,
                    'id_size' => $sizeId
                ]);
                return redirect()->back()->with('error', 'Không tìm thấy biến thể sản phẩm phù hợp.');
            }

            Log::info('Tìm thấy variant:', $variant->toArray());

            // Kiểm tra tồn kho
            if ($variant->quantity === null || $variant->quantity < $quantity) {
                Log::error('Lỗi tồn kho:', [
                    'variant_id' => $variant->id,
                    'stock' => $variant->quantity,
                    'quantity' => $quantity
                ]);
                return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá tồn kho.');
            }

            $user = Sentinel::check();
            Log::info('Trạng thái người dùng:', ['user' => $user ? $user->id : 'Chưa đăng nhập']);

            if ($user) {
                // Người dùng đã đăng nhập: lưu vào database
                $cart = Cart::firstOrCreate(['id_user' => $user->id]);
                Log::info('Giỏ hàng DB:', $cart->toArray());
                $cartDetail = CartDetail::where('id_cart', $cart->id)
                                       ->where('id_variant', $variant->id)
                                       ->first();

                if ($cartDetail) {
                    $newQuantity = $cartDetail->quantity + $quantity;
                    if ($variant->quantity < $newQuantity) {
                        Log::error('Lỗi tồn kho khi cập nhật:', [
                            'variant_id' => $variant->id,
                            'stock' => $variant->quantity,
                            'quantity' => $newQuantity
                        ]);
                        return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá tồn kho.');
                    }
                    $cartDetail->quantity = $newQuantity;
                    $cartDetail->save();
                    Log::info('Cập nhật cart detail:', $cartDetail->toArray());
                } else {
                    $cartDetail = CartDetail::create([
                        'id_cart' => $cart->id,
                        'id_variant' => $variant->id,
                        'quantity' => $quantity,
                    ]);
                    Log::info('Tạo mới cart detail:', $cartDetail->toArray());
                }
            } else {
                // Người dùng chưa đăng nhập: lưu vào session
                $cart = session()->get('cart', []);
                $variantId = $variant->id;
                if (isset($cart[$variantId])) {
                    $newQuantity = $cart[$variantId]['quantity'] + $quantity;
                    if ($variant->quantity < $newQuantity) {
                        Log::error('Lỗi tồn kho trong session:', [
                            'variant_id' => $variantId,
                            'stock' => $variant->quantity,
                            'quantity' => $newQuantity
                        ]);
                        return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá tồn kho.');
                    }
                    $cart[$variantId]['quantity'] = $newQuantity;
                } else {
                    $cart[$variantId] = [
                        'id_variant' => $variantId,
                        'quantity' => $quantity,
                        'name' => $variant->product->name,
                        'price' => $variant->price,
                        'image' => $variant->product->image_primary,
                        'id_color' => $variant->color ? $variant->color->name : 'N/A',
                        'id_size' => $variant->size ? $variant->size->name : 'N/A',
                    ];
                }
                session()->put('cart', $cart);
                Log::info('Giỏ hàng session:', $cart);
            }

            Log::info('Thêm giỏ hàng thành công:', [
                'variant_id' => $variant->id,
                'quantity' => $quantity
            ]);
            return redirect()->route('client.homeClient')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm giỏ hàng:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm vào giỏ hàng. Vui lòng thử lại.');
        }

    }

    /**
     * Hiển thị trang giỏ hàng
     */
    public function index()
    {
        $user = Sentinel::check();
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }
    
        $cart = Cart::with('details.variant.product')->where('id_user', $user->id)->first();
        $cartItems = $cart ? $cart->details : collect([]);
        $relatedProducts = Product::inRandomOrder()->limit(4)->get();
    
        // 👉 Load các voucher còn hiệu lực
        $now = now();
        $vouchers = Voucher::where('is_active', 1)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->get();
    
        return view('client.cart.index', compact('cartItems', 'relatedProducts', 'vouchers'));
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function remove($id)
    {
        $user = Sentinel::check();
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để tiếp tục.');
        }

        $cart = Cart::where('id_user', $user->id)->first();
        if ($cart) {
            $cartDetail = CartDetail::where('id_cart', $cart->id)->where('id', $id)->first();
            if ($cartDetail) {
                $cartDetail->delete();
            }
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    /**
     * Cập nhật số lượng sản phẩm
     */
    public function update(Request $request)
    {
        $user = Sentinel::check();
        if (!$user) {
            return redirect()->route('auth.loginClient')->with('message', 'Vui lòng đăng nhập để tiếp tục.');
        }

        $cart = Cart::where('id_user', $user->id)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng không tồn tại.');
        }

        $quantities = $request->input('quantities', []);

        foreach ($quantities as $id => $qty) {
            $cartDetail = CartDetail::where('id_cart', $cart->id)->where('id', $id)->first();
            if ($cartDetail) {
                $qty = max(1, (int)$qty);
                if ($cartDetail->variant->quantity < $qty) {
                    return redirect()->back()->with('error', "Số lượng yêu cầu cho {$cartDetail->variant->product->name} vượt quá tồn kho.");
                }
                $cartDetail->quantity = $qty;
                $cartDetail->save();
            }
        }

        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật.');
    }

public function applyVoucher(Request $request)
{
    $request->validate([
        'voucher_code' => 'required|string'
    ]);

    $user = Sentinel::check();
    if (!$user) {
        return response()->json(['error' => 'Vui lòng đăng nhập để sử dụng voucher.'], 401);
    }

    // Lấy giỏ hàng user
    $cart = Cart::with('details.variant.product')->where('id_user', $user->id)->first();
    if (!$cart || $cart->details->isEmpty()) {
        return response()->json(['error' => 'Giỏ hàng trống.'], 400);
    }

    $total = 0;
    foreach ($cart->details as $item) {
        $total += $item->variant->price * $item->quantity;
    }

    // Tìm voucher
    $voucher = Voucher::where('code', $request->voucher_code)
        ->where('is_active', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();

    if (!$voucher) {
        return response()->json(['error' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'], 400);
    }

    // Check điều kiện tối thiểu
    if ($voucher->min_order_value && $total < $voucher->min_order_value) {
        return response()->json(['error' => 'Đơn hàng chưa đạt giá trị tối thiểu để áp dụng voucher.'], 400);
    }

    // Tính giảm giá
    $discount = 0;
    if ($voucher->discount_type === 'percent') {
        $discount = ($total * $voucher->discount_value) / 100;
        if ($voucher->max_discount && $discount > $voucher->max_discount) {
            $discount = $voucher->max_discount;
        }
    } elseif ($voucher->discount_type === 'fixed') {
        $discount = $voucher->discount_value;
    }

    $finalPrice = max(0, $total - $discount);

    // Lưu voucher vào session để checkout dùng lại
    session()->put('applied_voucher', [
        'code' => $voucher->code,
        'discount' => $discount,
        'final_price' => $finalPrice,
    ]);

    return response()->json([
        'success' => true,
        'voucher_code' => $voucher->code,
        'discount' => $discount,
        'final_price' => $finalPrice,
        'total' => $total,
    ]);
}
}

