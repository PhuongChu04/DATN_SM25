<?php

namespace App\Services;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{

  public function postRegister(Request $data)
{
     // Đăng ký người dùng qua Sentinel
        $user = Sentinel::registerAndActivate([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => $data['password'],
        ]);

        // Cập nhật trạng thái
        $user->status = 1;
        $user->save();

        

        return $user;
    }
    public function userDetail($id)
    {
        Log::info('Lấy chi tiết người dùng', ['user_id' => $id]);
        $user = Sentinel::findById($id);
        if (!$user) {
            Log::warning('Không tìm thấy người dùng', ['user_id' => $id]);
            return redirect()->route('user.list')->withErrors(['user' => 'Không tìm thấy người dùng.']);
        }
        return view('admin.auth.UserDetail', compact('user'));
    }

    public function updateAccountDetail(Request $req, $id)
    {
        Log::info('Bắt đầu updateAccountDetail', ['user_id' => $id]);

        $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findById($id);

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'Không tìm thấy người dùng.'])->withInput();
        }

        $validated = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'newPassword' => 'nullable|string|min:6|confirmed',
        ], [
            'first_name.required' => 'Họ không được để trống.',
            'last_name.required' => 'Tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'newPassword.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'newPassword.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ]);

        try {
            if ($req->filled('newPassword')) {
                $user->password = bcrypt($req->input('newPassword'));
            }

            $user->first_name = $req->input('first_name');
            $user->last_name = $req->input('last_name');
            $user->email = $req->input('email');
            $user->save();

            return redirect()->route('admin.auth.list')->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors(['system' => 'Có lỗi xảy ra.'])->withInput();
        }
    }
    public function deleteUser($id)
{
    try {
        $user = \Cartalyst\Sentinel\Laravel\Facades\Sentinel::findById($id);

        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'Không tìm thấy người dùng.']);
        }

        $user->delete();

        return redirect()->route('admin.auth.list')->with('success', 'Xóa người dùng thành công!');
    } catch (\Exception $e) {
        Log::error('Lỗi khi xóa người dùng', ['message' => $e->getMessage()]);
        return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra khi xóa người dùng.']);
    }
}
// public function toggleStatusUser($id, $status)
// {
//     try {
//         $user = Sentinel::findOrFail($id);
//         $user->status = (int) $status; // Chuyển đổi thành 0 hoặc 1
//         $user->save();

//         Log::info('Cập nhật trạng thái người dùng: ', ['id' => $id, 'status' => $user->status]);

//         return $user;
//     } catch (Exception $e) {
//         Log::error('Lỗi khi cập nhật trạng thái: ', ['id' => $id, 'message' => $e->getMessage()]);
//         throw $e;
//     }
// }

}
