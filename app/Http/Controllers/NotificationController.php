<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusNotification;

class NotificationController extends Controller
{
    // Show all notifications (paginated)
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    // Mark all notifications as read
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    // Mark a specific notification as read
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }

    // Delete a specific notification (optional feature)
    public function delete($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();

        return back()->with('success', 'Notification deleted.');
    }

    // OPTIONAL: Simulate order status update (test purpose)
    public function sendOrderUpdateExample()
    {
        $user = Auth::user();
        $orderId = rand(1000, 9999); // example order id
        $message = "Your order #$orderId has been shipped!";

        $user->notify(new OrderStatusNotification($message));

        return back()->with('success', 'Test notification sent.');
    }

    // Optional: Return unread notification count (useful for API or navbar badge)
    public function unreadCount()
    {
        return response()->json(['count' => Auth::user()->unreadNotifications->count()]);
    }
}
