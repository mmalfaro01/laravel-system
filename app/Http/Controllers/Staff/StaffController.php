<?php
namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderAssignedNotification;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function dashboard()
    {
        $totalOrders = Order::count();
        $assignedOrders = Order::whereNotNull('driver_id')->count();
        $messages = Message::count();

        return view('staff.dashboard', compact('totalOrders', 'assignedOrders', 'messages'));
    }

    public function orders(Request $request)
    {
        $orders = Order::with(['user', 'driver'])->latest()->paginate(10);
        return view('staff.orders.index', compact('orders'));
    }

    public function editOrder(Order $order)
    {
        $drivers = User::where('role', 'driver')->orderBy('name')->get();
        $order->load(['user', 'driver', 'orderItems.product']);
        return view('staff.orders.edit', compact('order', 'drivers'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'driver_id' => 'nullable|exists:users,id',
        ]);

        $previousDriverId = $order->driver_id;

        if ($request->filled('driver_id')) {
            $driver = User::where('id', $request->driver_id)
                ->where('role', 'driver')
                ->firstOrFail();

            $order->driver_id = $driver->id;
        } else {
            $order->driver_id = null;
        }

        $previousStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        if ($order->driver_id && $order->driver_id !== $previousDriverId) {
            $assignedDriver = User::find($order->driver_id);
            if ($assignedDriver && ! empty($assignedDriver->email)) {
                Notification::route('mail', $assignedDriver->email)
                    ->notify(new OrderAssignedNotification($order));
            }
        }

        return redirect()->route('staff.orders.edit', $order->id)->with('success', 'Order updated successfully.');
    }

    public function messages()
    {
        $messages = Message::latest()->paginate(20);
        return view('staff.messages.index', compact('messages'));
    }

    public function showMessage(Message $message)
    {
        return view('staff.messages.show', compact('message'));
    }

    public function reports()
    {
        // Basic product sales report: top 10 products this month
        $productSales = \App\Models\OrderItem::query()
            ->whereHas('order', function ($q) { $q->where('status', 'completed'); })
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.name as product_name, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return view('staff.reports.index', compact('productSales'));
    }
}
