<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductVariant;
use App\Models\User;
use App\Services\UserService;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{

     protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login()
    {
        return view('client.auth.login');
    }
    public function register()
    {
        return view('client.auth.register');
    }

    public function postLogin(Request $req) {
        try {
         $credentials = $req->validate([


                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
             Log::info('Login attempt: ', $credentials);


            // Kiểm tra trạng thái người dùng
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->status == 0) {
            Log::warning('Đăng nhập không thành công: Tài khoản buộc dừng hoạt động', ['email' => $credentials['email']]);
             return redirect()->route('auth.loginClient')
                ->with('error', 'Tài khoản của bạn đã bị khóa.')->withInput();
        }

        if (Sentinel::authenticate($credentials)) {
            return redirect('/client/dashboard')->with('success', 'Đăng nhập thành công!');
        } else {
            Log::error('Đăng nhập không thành công: Thông tin đăng nhập email không hợp lệ ' . $credentials['email']);
            return redirect()->back()->withErrors([
                'error' => 'Email hoặc mật khẩu không đúng.'
            ])->withInput();
        }
        }catch (Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Email hoặc password sai: ' . $e->getMessage()
            ])->withInput();
        }
    }
    public function syncSessionCart($user)
{
    $sessionCart = session()->get('cart', []);
    if (!empty($sessionCart)) {
        $cart = Cart::firstOrCreate(['id_user' => $user->id]);
        foreach ($sessionCart as $variantId => $item) {
            $cartDetail = CartDetail::where('id_cart', $cart->id)
                                   ->where('id_variant', $variantId)
                                   ->first();
            $variant = ProductVariant::find($variantId);
            if ($variant && $variant->stock >= $item['quantity']) {
                if ($cartDetail) {
                    $cartDetail->quantity += $item['quantity'];
                    $cartDetail->save();
                } else {
                    CartDetail::create([
                        'id_cart' => $cart->id,
                        'id_variant' => $variantId,
                        'quantity' => $item['quantity'],
                    ]);
                }
            }
        }
        // Xóa session sau khi đồng bộ
        session()->forget('cart');
    }
}
    public function postRegister(Request $req)
{
    try {
        // Xác thực dữ liệu đầu vào
        $data = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        // Đăng ký và kích hoạt người dùng qua Sentinel
        $user = Sentinel::registerAndActivate([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Cập nhật trạng thái
        $user->status = 1; // Hoặc 0 nếu muốn khóa mặc định
        $user->save();

        Log::info('Đăng ký người dùng thành công', [
            'email' => $data['email'],
            'status' => $user->status
        ]);

        return redirect('/auth/dashboard')->with([
            'message' => 'Đăng ký thành công! Vui lòng đăng nhập.'
        ]);
    } catch (Exception $e) {
        Log::error('Đăng ký thất bại: ', ['error' => $e->getMessage()]);
        return redirect()->back()->withErrors([
            'error' => 'Đăng ký thất bại: ' . $e->getMessage()
        ])->withInput();
    }
}
    public function logoutClient(){
        Sentinel::logout();
        return redirect()->route('client.homeClient');
    }

     public function accountDetail()
    {
        $user = Sentinel::getUser(); // Lấy user đang đăng nhập
        return view('client.accounts.accountDetail', compact('user'));
    }
public function updateAccountDetail(Request $req)
{
    Log::info('Bắt đầu updateAccountDetail', ['user_id' => optional(Sentinel::getUser())->id]);

    $user = Sentinel::getUser();

    if (!$user) {
        Log::warning('Người dùng chưa đăng nhập hoặc không tồn tại');
        return redirect()->back()->withErrors(['user' => 'Không tìm thấy người dùng đang đăng nhập.'])->withInput();
    }

    Log::info('Đã lấy được user', ['user' => $user->email]);

    // Xác thực dữ liệu
    $validated = $req->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
        'newPassword' => 'nullable|string|min:6|confirmed',
    ]
    , [
        'first_name.required' => 'Họ không được để trống.',
        'first_name.string' => 'Họ phải là chuỗi ký tự.',
        'first_name.max' => 'Họ không được vượt quá 255 ký tự.',
        'last_name.required' => 'Tên không được để trống.',
        'last_name.string' => 'Tên phải là chuỗi ký tự.',
        'last_name.max' => 'Tên không được vượt quá 255 ký tự.',
        'email.required' => 'Email không được để trống.',
        'email.email' => 'Email không đúng định dạng.',
        'email.unique' => 'Email đã được sử dụng.',
        'password.string' => 'Mật khẩu hiện tại phải là chuỗi ký tự.',
        'password.min' => 'Mật khẩu hiện tại phải có ít nhất 6 ký tự.',
        'newPassword.string' => 'Mật khẩu mới phải là chuỗi ký tự.',
        'newPassword.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
        'newPassword.confirmed' => 'Mật khẩu mới và xác nhận mật khẩu không khớp.',
    ]
);

    Log::info('Dữ liệu request đã được validate thành công', ['validated' => $validated]);

    try {
        // Kiểm tra mật khẩu nếu có
        if ($req->filled('password') && $req->filled('newPassword')) {
            if (!Hash::check($req->input('password'), $user->password)) {
                Log::warning('Mật khẩu cũ không đúng', ['user_id' => $user->id]);
                return redirect()->back()->withErrors(['password' => 'Mật khẩu hiện tại không đúng.'])->withInput();
            }
            $user->password = bcrypt($req->input('newPassword'));
        }

        // Cập nhật thông tin người dùng
        $user->first_name = $req->input('first_name');
        $user->last_name = $req->input('last_name');
        $user->email = $req->input('email');
        $user->save();

        Log::info('Thông tin người dùng đã được cập nhật thành công', ['user_id' => $user->id]);

        return redirect()->route('client.accountDetail')->with('success', 'Thông tin tài khoản đã được cập nhật thành công!');

    } catch (Exception $e) {

        Log::error('Lỗi khi cập nhật thông tin người dùng', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return redirect()->back()->withErrors(['system' => 'Có lỗi xảy ra. Vui lòng thử lại sau.'])->withInput();
    }
}

}
