<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $startOfThisWeek = Carbon::now()->startOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        // This week's earnings from completed orders
        $thisWeek = Order::with('orderItems')
            ->where('status', 'completed')
            ->where('created_at', '>=', $startOfThisWeek)
            ->get()
            ->flatMap->orderItems
            ->sum(fn($item) => $item->price * $item->quantity);

        // Last week's earnings from completed orders
        $lastWeek = Order::with('orderItems')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->get()
            ->flatMap->orderItems
            ->sum(fn($item) => $item->price * $item->quantity);

        $growth = $lastWeek > 0 ? (($thisWeek - $lastWeek) / $lastWeek) * 100 : 0;

        // Monthly earnings for chart
        $monthlyEarnings = OrderItem::whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->selectRaw('MONTH(created_at) as month, SUM(price * quantity) as total')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get()
            ->pluck('total', 'month');

        return view('admin.dashboard', [
            'earnings' => $thisWeek,
            'growth' => round($growth, 2),
            'monthlyEarnings' => $monthlyEarnings
        ]);
    }

    public function users()
    {
        $users = User::where('is_admin', 0)->latest()->get();
        $admins = User::where('is_admin', 1)->latest()->get();
        return view('admin.users.index', compact('users', 'admins'));
    }

    public function createAdmin()
    {
        return view('admin.users.create');
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
        ]);

        return redirect()->route('admin.users')->with('success', 'Admin added successfully.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function categories()   { return view('admin.categories'); }
    public function attributes()   { return view('admin.attributes'); }
    public function reports()      { return view('admin.reports'); }
    public function settings()     { return view('admin.settings'); }
    public function faq()          { return view('admin.faq'); }

    public function manageOrders(Request $request)
    {
        $status = $request->query('status');
        $orders = Order::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->latest()->paginate(10);

        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function editOrder(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders')->with('success', 'Order updated.');
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
