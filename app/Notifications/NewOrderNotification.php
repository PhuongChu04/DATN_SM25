<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;


class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Order $order;



    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->customer_name ?? '',
            'total' => $this->order->total ?? '',
            'message' => "Đơn hàng mới #{$this->order->id} từ " . ($this->order->customer_name ?: 'Khách hàng'),
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toDatabase($notifiable) + [
            'created_at' => now()->toDateTimeString(),
        ]);
    }

    public function toArray($notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
