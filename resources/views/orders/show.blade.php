@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Page Title --}}
    <div class="row mb-4">
        <div class="col-12 text-center text-md-start">
            <h2 class="fw-bold text-success">🧾 Order #{{ $order->id }}</h2>
            <p class="text-muted">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>

    {{-- Order Summary --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold text-success">📋 Order Details</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p>
                        <strong>Payment Method:</strong>
                        {{ strtoupper($order->payment_method) }}
                    </p>
                    <p>
                        <strong>Shipping Option:</strong>
                        {{ $order->shipping_option === 'schedule' ? 'Scheduled Delivery' : 'Deliver Now' }}
                    </p>
                    @if($order->shipping_option === 'schedule' && $order->delivery_date)
                        <p>
                            <strong>Scheduled Delivery Date:</strong>
                            {{ \Carbon\Carbon::parse($order->delivery_date)->format('F j, Y') }}
                        </p>
                        <p class="text-primary">
                            Estimated delivery on <strong>{{ \Carbon\Carbon::parse($order->delivery_date)->format('l') }}</strong>.
                        </p>
                    @else
                        <p class="text-primary">
                            Expect delivery within <strong>1–2 business days</strong>.
                        </p>
                    @endif
                    <p>
                        <strong>Delivery Contact:</strong>
                        <span class="text-dark">
                            {{ $order->delivery_contact ?? '+63 912 345 6789' }}
                        </span>
                    </p>
                    <p class="mb-0">
                        <strong>Total Amount:</strong>
                        <span class="text-dark">₱{{ number_format($order->total, 2) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Items Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold text-success">🛍️ Ordered Items</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Product not found' }}</td>
                                <td>₱{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No items found in this order.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                                <td class="text-end fw-bold text-success">₱{{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
