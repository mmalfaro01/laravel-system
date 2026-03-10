@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - Tropical Burger')

@section('content')
<style>
    .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); border-radius: 1.25rem; overflow: hidden; margin-bottom: 1rem; }
    .page-panel-header { padding: 1rem 1.25rem; border-bottom: 1px solid var(--burger-border); }
    .page-panel-header h1 { font-size: 1.35rem; font-weight: 800; margin: 0; color: var(--burger-white); }
    .page-panel-header p { margin: 0.25rem 0 0; color: var(--burger-muted); font-size: 0.9rem; }
    .page-panel-body { padding: 1rem 1.25rem; color: var(--burger-white); }
    .page-panel-body p { margin-bottom: 0.5rem; font-size: 0.95rem; }
    .page-panel-body .text-muted { color: var(--burger-muted) !important; }
    .detail-table { color: var(--burger-white); }
    .detail-table thead { color: var(--burger-gold); font-size: 0.8rem; text-transform: uppercase; }
    .detail-table th, .detail-table td { border-color: var(--burger-border); padding: 0.6rem 0.75rem; }
    .detail-table tfoot { font-weight: 700; color: var(--burger-gold); }
    .back-link { color: var(--burger-orange); font-size: 0.9rem; }
</style>

<div class="container py-3">
    <a href="{{ route('orders.index') }}" class="back-link text-decoration-none d-inline-block mb-3">← Back to orders</a>

    <div class="page-panel">
        <div class="page-panel-header">
            <h1>Order #{{ $order->id }}</h1>
            <p>Placed {{ $order->created_at->format('M j, Y \a\t g:i A') }}</p>
        </div>
        <div class="page-panel-body">
            <p><strong>Status:</strong> <span class="badge {{ $order->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Shipping:</strong> {{ $order->shipping_option === 'schedule' ? 'Scheduled' : 'Deliver now' }}</p>
            @if($order->shipping_option === 'schedule' && $order->delivery_date)
                <p><strong>Delivery date:</strong> {{ \Carbon\Carbon::parse($order->delivery_date)->format('M j, Y') }}</p>
            @endif
            <p><strong>Contact:</strong> {{ $order->delivery_contact ?? '—' }}</p>
            <p class="mb-0"><strong>Total:</strong> <span class="text-warning">₱{{ number_format($order->total, 2) }}</span></p>
        </div>
    </div>

    <div class="page-panel">
        <div class="page-panel-header">
            <h1>Items</h1>
        </div>
        <div class="p-0">
            <div class="table-responsive">
                <table class="table table-borderless detail-table mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name ?? '—' }}</td>
                            <td>₱{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-secondary py-3">No items.</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end">Grand total:</td>
                            <td class="text-end">₱{{ number_format($order->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
