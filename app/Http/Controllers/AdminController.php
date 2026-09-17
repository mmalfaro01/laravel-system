<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderAssignedNotification;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private function productQuantitySales(string $period)
    {
        $baseQuery = OrderItem::query()
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            });

        $dateQuery = match ($period) {
            'day' => (clone $baseQuery)->whereDate('order_items.created_at', Carbon::today()),
            'week' => (clone $baseQuery)->whereBetween('order_items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]),
            default => (clone $baseQuery)->whereBetween('order_items.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]),
        };

        return $dateQuery
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.name as product_name, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();
    }

    public function dashboard()
    {
        $startOfThisWeek = Carbon::now()->startOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $thisWeek = Order::with('orderItems')
            ->where('status', 'completed')
            ->where('created_at', '>=', $startOfThisWeek)
            ->get()
            ->flatMap->orderItems
            ->sum(fn ($item) => $item->price * $item->quantity);

        $lastWeek = Order::with('orderItems')
            ->where('status', 'completed')
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->get()
            ->flatMap->orderItems
            ->sum(fn ($item) => $item->price * $item->quantity);

        $growth = $lastWeek > 0 ? (($thisWeek - $lastWeek) / $lastWeek) * 100 : 0;

        $productSales = [
            'day' => $this->productQuantitySales('day'),
            'week' => $this->productQuantitySales('week'),
            'month' => $this->productQuantitySales('month'),
        ];

        $productSalesChartData = [
            'day' => [
                'labels' => $productSales['day']->pluck('product_name')->values()->all(),
                'values' => $productSales['day']->pluck('total_quantity')->values()->all(),
            ],
            'week' => [
                'labels' => $productSales['week']->pluck('product_name')->values()->all(),
                'values' => $productSales['week']->pluck('total_quantity')->values()->all(),
            ],
            'month' => [
                'labels' => $productSales['month']->pluck('product_name')->values()->all(),
                'values' => $productSales['month']->pluck('total_quantity')->values()->all(),
            ],
        ];

        return view('admin.dashboard', [
            'earnings' => $thisWeek,
            'growth' => round($growth, 2),
            'productSales' => $productSales,
            'productSalesChartData' => json_encode($productSalesChartData),
        ]);
    }

    public function users()
    {
        $users = User::where(function ($query) {
            $query->whereNull('role')->orWhere('role', 'customer');
        })->latest()->get();

        $admins = User::where('is_admin', 1)->latest()->get();
        $staff = User::where('role', 'staff')->latest()->get();
        $drivers = User::where('role', 'driver')->latest()->get();

        return view('admin.users.index', compact('users', 'admins', 'staff', 'drivers'));
    }

    public function createAdmin()
    {
        return view('admin.users.create');
    }

    public function createDriver()
    {
        return view('admin.drivers.create');
    }

    public function createStaff()
    {
        return view('admin.staff.create');
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,driver,staff',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['role'] === 'admin',
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users')->with('success', ucfirst($validated['role']) . ' account added successfully.');
    }

    public function storeStaff(Request $request)
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
            'is_admin' => false,
            'role' => 'staff',
        ]);

        return redirect()->route('admin.users')->with('success', 'Staff account added successfully.');
    }

    public function storeDriver(Request $request)
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
            'is_admin' => false,
            'role' => 'driver',
        ]);

        return redirect()->route('admin.users')->with('success', 'Driver account added successfully.');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => 'required|in:customer,admin,driver',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->is_admin = $validated['role'] === 'admin';

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Account updated successfully.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting users who have placed orders or are assigned to orders as drivers
        if ($user->orders()->exists() || $user->assignedOrders()->exists()) {
            return redirect()->route('admin.users')
                ->with('error', 'Cannot delete user: there are orders linked to this account. Reassign or remove related orders first.');
        }

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
        $orders = Order::with(['user', 'driver'])->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->latest()->paginate(10);

        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function editOrder(Order $order)
    {
        $order->load(['user', 'driver', 'orderItems.product']);
        $drivers = User::where('role', 'driver')->orderBy('name')->get();

        return view('admin.orders.edit', compact('order', 'drivers'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'driver_id' => 'nullable|exists:users,id',
        ]);

        $previousDriverId = $order->driver_id;
        $previousStatus = $order->status;

        if ($request->filled('driver_id')) {
            $driver = User::where('id', $request->driver_id)
                ->where('role', 'driver')
                ->firstOrFail();
            $order->driver_id = $driver->id;
        } else {
            $order->driver_id = null;
        }

        $order->status = $request->status;
        $order->save();

        if ($order->status !== $previousStatus && $order->user) {
            $order->user->notify(new OrderStatusUpdated($order, $previousStatus));
        }

        if ($order->driver_id && $order->driver_id !== $previousDriverId) {
            $assignedDriver = User::find($order->driver_id);
            if ($assignedDriver && ! empty($assignedDriver->email)) {
                Notification::route('mail', $assignedDriver->email)
                    ->notify(new OrderAssignedNotification($order));
            }
        }

        return redirect()->route('admin.orders.edit', $order->id)->with('success', 'Order updated successfully.');
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Admin messages inbox
    public function messages(Request $request)
    {
        $messages = Message::latest()->paginate(20);
        $selectedMessage = $messages->first();

        return view('admin.messages.index', compact('messages', 'selectedMessage'));
    }

    // Show single message
    public function showMessage(Message $message)
    {
        $messages = Message::latest()->take(20)->get();

        return view('admin.messages.show', compact('message', 'messages'));
    }

    // Delete a message
    public function destroyMessage(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Message deleted successfully.');
    }
}
