<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlaced extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Confirmation - Order #' . $this->order->id)
            ->greeting('Thank you for your order!')
            ->line('Your order has been received and we are preparing it for shipment.')
            ->line('**Order Details:**')
            ->line('Order ID: #' . $this->order->id)
            ->line('Total: $' . number_format($this->order->total, 2))
            ->line('Status: ' . ucfirst($this->order->status))
            ->line('')
            ->line('**Delivery Address:**')
            ->line($this->order->customer_name)
            ->line($this->order->delivery_address)
            ->line($this->order->city . ', ' . $this->order->postal_code)
            ->line('Phone: ' . $this->order->phone)
            ->line('')
            ->line('**Order Items:**')
            ->line($this->getOrderItemsList())
            ->action('View Order', route('orders.show', $this->order->id))
            ->line('We will send you an email notification when your order is shipped.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your order #' . $this->order->id . ' has been received.',
            'order_id' => $this->order->id,
            'status' => $this->order->status
        ];
    }

    private function getOrderItemsList()
    {
        $items = $this->order->orderItems->map(function ($item) {
            return '• ' . $item->product->name . ' x' . $item->quantity . ' @ $' . number_format($item->price, 2);
        })->implode("\n");

        return $items;
    }
}
