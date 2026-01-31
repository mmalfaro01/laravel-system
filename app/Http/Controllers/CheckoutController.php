<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

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
        $rules = [
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
            $rules['cod_address'] = 'required|string|max:255';
            $rules['cod_name'] = 'required|string|max:255';
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
            
            $order = Order::create([
                'user_id'         => Auth::id(),
                'total'           => $total,
                'status'          => 'pending',
                'shipping_option' => $request->shipping_option ?? 'now',
                'delivery_date'   => $request->shipping_option === 'schedule' ? $request->delivery_date : null,
            ]);
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

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
