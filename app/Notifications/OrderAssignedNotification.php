<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Assigned - #' . $this->order->id)
            ->greeting('New Delivery Assignment')
            ->line('A new order has been assigned to you.')
            ->line('Order ID: #' . $this->order->id)
            ->line('Customer: ' . ($this->order->customer_name ?? 'N/A'))
            ->line('Address: ' . ($this->order->delivery_address ?? 'N/A'))
            ->line('City: ' . ($this->order->city ?? 'N/A'))
            ->line('Phone: ' . ($this->order->delivery_contact ?? $this->order->phone ?? 'N/A'))
            ->line('Status: ' . ucfirst($this->order->status))
            ->action('Open Driver Orders', route('driver.orders.show', $this->order->id))
            ->line('Please review and start the delivery workflow.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Order #' . $this->order->id . ' was assigned to you.',
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'type' => 'order_assigned',
        ];
    }
}
