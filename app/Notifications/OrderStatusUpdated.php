<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;
    public $previousStatus;

    public function __construct(Order $order, $previousStatus = null)
    {
        $this->order = $order;
        $this->previousStatus = $previousStatus;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $status = $this->order->status;
        $subject = 'Order #' . $this->order->id . ' Status Update';
        $message = new MailMessage();

        if ($status === 'shipped') {
            $subject = 'Order #' . $this->order->id . ' - Your Order Is On The Way!';
            $message
                ->subject($subject)
                ->greeting('Great News!')
                ->line('Your order #' . $this->order->id . ' has been shipped and is on its way to you!')
                ->line('')
                ->line('**Delivery Address:**')
                ->line($this->order->customer_name)
                ->line($this->order->delivery_address)
                ->line($this->order->city . ', ' . $this->order->postal_code)
                ->line('')
                ->line('Expected Delivery Date: ' . ($this->order->delivery_date ? date('F j, Y', strtotime($this->order->delivery_date)) : 'Soon'))
                ->line('You will receive tracking information shortly.')
                ->action('Track Your Order', route('orders.show', $this->order->id))
                ->line('Thank you for shopping with us!');
        } elseif ($status === 'completed') {
            $subject = 'Order #' . $this->order->id . ' - Order Completed';
            $message
                ->subject($subject)
                ->greeting('Thank You!')
                ->line('Your order #' . $this->order->id . ' has been completed and delivered.')
                ->line('')
                ->line('We hope you enjoyed your meal! Your satisfaction is our priority.')
                ->line('')
                ->line('**Order Summary:**')
                ->line('Order ID: #' . $this->order->id)
                ->line('Total Spent: $' . number_format($this->order->total, 2))
                ->line('')
                ->line('If you have any feedback or concerns, please don\'t hesitate to contact us.')
                ->action('View Order', route('orders.show', $this->order->id))
                ->line('Thanks for being a valued customer!');
        } elseif ($status === 'processing') {
            $subject = 'Order #' . $this->order->id . ' - Processing';
            $message
                ->subject($subject)
                ->greeting('Order Confirmed!')
                ->line('Your order #' . $this->order->id . ' is now being processed.')
                ->line('We will notify you as soon as it ships.')
                ->action('View Order', route('orders.show', $this->order->id));
        } elseif ($status === 'cancelled') {
            $subject = 'Order #' . $this->order->id . ' - Cancelled';
            $message
                ->subject($subject)
                ->greeting('Order Cancelled')
                ->line('Your order #' . $this->order->id . ' has been cancelled.')
                ->line('')
                ->line('If you did not request this cancellation, please contact us immediately.')
                ->action('Contact Support', route('contact'))
                ->line('Thank you.');
        } else {
            $message
                ->subject($subject)
                ->greeting('Order Update')
                ->line('Your order #' . $this->order->id . ' status has been updated to: ' . ucfirst($status))
                ->action('View Order', route('orders.show', $this->order->id));
        }

        return $message;
    }

    public function toDatabase($notifiable)
    {
        $statusMessages = [
            'shipped' => 'Your order #' . $this->order->id . ' is on its way!',
            'completed' => 'Your order #' . $this->order->id . ' has been delivered. Thank you!',
            'processing' => 'Your order #' . $this->order->id . ' is being processed.',
            'cancelled' => 'Your order #' . $this->order->id . ' has been cancelled.',
        ];

        return [
            'message' => $statusMessages[$this->order->status] ?? 'Your order #' . $this->order->id . ' status: ' . $this->order->status,
            'order_id' => $this->order->id,
            'status' => $this->order->status
        ];
    }
}
