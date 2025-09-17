<?php
namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderObserver implements ShouldQueue
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        // Lấy role admin từ Sentinel
        $adminRole = Sentinel::findRoleByName('admin');
        if ($adminRole) {
            $sentinelAdmins = $adminRole->users()->with('roles')->get();

            foreach ($sentinelAdmins as $sentinelAdmin) {
                // Nếu object này có method notify thì dùng luôn
                if (method_exists($sentinelAdmin, 'notify')) {
                    $sentinelAdmin->notify(new NewOrderNotification($order));
                    continue;
                }

                // Fallback: tìm User Eloquent tương ứng (theo email hoặc id nếu bạn giữ mapping)
                if (isset($sentinelAdmin->email)) {
                    $user = User::where('email', $sentinelAdmin->email)->first();
                    if ($user) {
                        $user->notify(new NewOrderNotification($order));
                    }
                }
            }
        } else {
            // Nếu không có role admin trong Sentinel, có thể fallback lấy trực tiếp user có role = 'admin' ở bảng users
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }
        }
    }
}
