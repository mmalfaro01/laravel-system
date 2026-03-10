<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->orders()->latest();
        $status = $request->get('status');
        if ($status && in_array($status, ['pending', 'processing', 'shipped', 'completed', 'cancelled'], true)) {
            $query->where('status', $status);
        }
        $orders = $query->paginate(10)->withQueryString();
        return view('orders.index', compact('orders', 'status'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }

    /**
     * Update the status of an order (admin use or testing)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('status', 'Order status updated successfully.');
    }
}
