<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // or add 'mail' if you want email
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'message' => "Your order #{$this->order->id} is now {$this->order->status}.",
            'order_id' => $this->order->id,
            'status' => $this->order->status
        ]);
    }
}
