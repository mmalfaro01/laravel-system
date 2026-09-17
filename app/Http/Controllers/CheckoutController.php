<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Notifications\OrderPlaced;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = $cart;

        $total = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $isLoggedIn = Auth::check();

        $rules = [
            'email' => $isLoggedIn ? 'nullable|email|max:255' : 'required|email|max:255',
            'customer_name'    => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'city'             => 'required|string|max:100',
            'postal_code'      => 'required|string|max:20',
            'payment_method'   => 'required|in:card,cod,gcash,paypal',
            'shipping_option'  => 'nullable|in:now,schedule',
        ];

        // Validate delivery date if scheduled
        if ($request->shipping_option === 'schedule') {
            $rules['delivery_date'] = 'required|date|after_or_equal:today';
        }

        // Payment-specific validations (for display/processing purposes only)
        $paymentMethod = $request->payment_method;
        if ($paymentMethod === 'cod') {
            $rules['cod_address'] = 'nullable|string|max:255';
            $rules['cod_name'] = 'nullable|string|max:255';
        } elseif ($paymentMethod === 'card') {
            $rules['name'] = 'required|string|max:255';
            $rules['card'] = 'required';
            $rules['expiry'] = 'required';
            $rules['cvv'] = 'required';
        } elseif ($paymentMethod === 'gcash') {
            $rules['gcash_name'] = 'required|string|max:255';
            $rules['gcash_number'] = 'required|string|max:20';
        } elseif ($paymentMethod === 'paypal') {
            $rules['paypal_email'] = 'required|email|max:255';
        }

        $request->validate($rules);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        try {
            $total = array_reduce($cart, fn($carry, $item) => $carry + ($item['price'] * $item['quantity']), 0);

            $orderData = [
                'user_id'           => Auth::id(),
                'customer_name'     => $request->customer_name,
                'delivery_address'  => $request->delivery_address,
                'phone'             => $request->phone,
                'city'              => $request->city,
                'postal_code'       => $request->postal_code,
                'total'             => $total,
                'status'            => 'pending',
                'shipping_option'   => $request->shipping_option ?? 'now',
                'delivery_date'     => $request->shipping_option === 'schedule' ? $request->delivery_date : null,
            ];

            if (Schema::hasColumn('orders', 'payment_method')) {
                $orderData['payment_method'] = $request->payment_method;
            }

            if (Schema::hasColumn('orders', 'delivery_contact')) {
                $orderData['delivery_contact'] = $request->phone;
            }
            
            $order = Order::create($orderData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Order creation failed: ' . $e->getMessage());
        }

        foreach ($cart as $productId => $item) {
            try {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Order item creation failed: ' . $e->getMessage());
            }
        }

        // Load relationships for email
        $order->load('orderItems.product');

        // Send order confirmation email
        /** @var \App\Models\User|null $customer */
        $customer = Auth::user();

        // Prefer authenticated user's email; fall back to provided checkout email
        $recipientEmail = $customer?->email ?: $request->input('email');

        if (! empty($recipientEmail)) {
            Notification::route('mail', $recipientEmail)
                ->notify(new OrderPlaced($order));
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully! A confirmation email has been sent.');
    }
}
