<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\OrderStatusUpdated;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Check if status was changed
        if ($order->isDirty('status')) {
            $previousStatus = $order->getOriginal('status');
            
            // Send notification only if status actually changed
            if ($previousStatus !== $order->status && $order->user) {
                $order->user->notify(new OrderStatusUpdated($order, $previousStatus));
            }
        }
    }
}
