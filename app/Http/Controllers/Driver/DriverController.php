<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function dashboard()
    {
        /** @var User $driver */
        $driver = Auth::guard('driver')->user();

        $assignedOrdersQuery = $driver->assignedOrders()->with(['user', 'orderItems.product'])->latest();

        $stats = [
            'total' => (clone $assignedOrdersQuery)->count(),
            'pending' => (clone $assignedOrdersQuery)->where('status', 'pending')->count(),
            'processing' => (clone $assignedOrdersQuery)->where('status', 'processing')->count(),
            'shipped' => (clone $assignedOrdersQuery)->where('status', 'shipped')->count(),
        ];

        $recentOrders = (clone $assignedOrdersQuery)->limit(5)->get();

        return view('driver.dashboard', compact('driver', 'stats', 'recentOrders'));
    }

    public function orders(Request $request)
    {
        /** @var User $driver */
        $driver = Auth::guard('driver')->user();
        $status = $request->query('status');

        $orders = $driver->assignedOrders()
            ->with(['user', 'orderItems.product'])
            ->when($status && in_array($status, ['pending', 'processing', 'shipped', 'completed', 'cancelled'], true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('driver.orders.index', compact('orders', 'status'));
    }

    public function show(Order $order)
    {
        $driver = Auth::guard('driver')->user();

        if ((int) $order->driver_id !== (int) $driver->id) {
            abort(403);
        }

        $order->load(['user', 'driver', 'orderItems.product']);

        return view('driver.orders.show', compact('order'));
    }

    public function profile()
    {
        /** @var User $driver */
        $driver = Auth::guard('driver')->user();

        return view('driver.profile', compact('driver'));
    }

    public function updateProfile(Request $request)
    {
        /** @var User $driver */
        $driver = Auth::guard('driver')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $driver->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $driver->name = $validated['name'];
        $driver->email = $validated['email'];

        if (! empty($validated['password'])) {
            $driver->password = Hash::make($validated['password']);
        }

        $driver->save();

        return back()->with('success', 'Driver profile updated successfully.');
    }
}
