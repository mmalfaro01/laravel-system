<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $status;
    public $orderId;

    public function __construct($orderId, $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
    }

    /**
     * Define delivery channels: database and optional email
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // ✅ now supports both
    }

    /**
     * Database notification payload
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => "Your Order #{$this->orderId} is now {$this->status}.",
            'order_id' => $this->orderId,
            'status' => $this->status,
            'url' => route('orders.show', $this->orderId), // ✅ useful for links
            'time' => now()->toDateTimeString(),           // ✅ optional timestamp
        ];
    }

    /**
     * Mail notification payload (optional)
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Update on Order #{$this->orderId}")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your order #{$this->orderId} status has been updated to: {$this->status}.")
            ->action('View Order', route('orders.show', $this->orderId))
            ->line('Thank you for shopping with us!');
    }
}
