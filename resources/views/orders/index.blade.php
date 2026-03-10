@extends('layouts.app')

@section('title', 'My Orders - Tropical Burger')

@section('content')
<style>
    .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); border-radius: 1.25rem; overflow: hidden; }
    .page-panel-header { padding: 1rem 1.25rem; border-bottom: 1px solid var(--burger-border); }
    .page-panel-header h1 { font-size: 1.35rem; font-weight: 800; margin: 0; color: var(--burger-white); }
    .page-panel-header p { margin: 0.25rem 0 0; color: var(--burger-muted); font-size: 0.9rem; }

    /* TikTok Shop–style pill tabs */
    .orders-tabs-wrap { background: var(--burger-black); padding: 0.75rem 1rem 1rem; border-bottom: 1px solid var(--burger-border); }
    .orders-tabs { display: flex; gap: 0.5rem; overflow-x: auto; overflow-y: hidden; scrollbar-width: none; -ms-overflow-style: none; padding: 0.25rem 0; align-items: center; }
    .orders-tabs::-webkit-scrollbar { display: none; }
    .orders-tab {
        flex: 0 0 auto; padding: 0.5rem 1rem; font-weight: 600; font-size: 0.875rem; text-decoration: none; white-space: nowrap;
        border-radius: 999px; border: 1px solid var(--burger-border); background: var(--burger-dark); color: var(--burger-muted);
        transition: background 0.2s, color 0.2s, border-color 0.2s;
    }
    .orders-tab:hover { color: var(--burger-white); border-color: var(--burger-muted); background: #252422; }
    .orders-tab.active { background: var(--burger-orange); border-color: var(--burger-orange); color: #1a1208; }

    .table-responsive { background: var(--burger-dark) !important; }
    .orders-table { color: var(--burger-white); background: var(--burger-dark) !important; }
    .orders-table thead { background: var(--burger-black); color: var(--burger-gold); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
    .orders-table thead th { border-color: var(--burger-border); padding: 0.65rem 0.75rem; font-weight: 700; background: var(--burger-black) !important; }
    .orders-table tbody { background: var(--burger-dark) !important; }
    .orders-table tbody td { border-color: var(--burger-border); padding: 0.75rem; vertical-align: middle; background: var(--burger-dark) !important; color: var(--burger-white); }
    .orders-table tbody tr:hover { background: #252422 !important; }
    .order-total { color: var(--burger-gold); font-weight: 700; }
    .empty-orders { text-align: center; padding: 2.5rem 1.5rem; color: var(--burger-muted); }
    .empty-orders a { color: var(--burger-orange); }
    .orders-pagination { padding: 0.75rem 1.25rem; border-top: 1px solid var(--burger-border); background: var(--burger-dark); }
    .orders-pagination .pagination { margin: 0; }
    .orders-pagination .page-link { background: var(--burger-black); border-color: var(--burger-border); color: var(--burger-gold); }
    .orders-pagination .page-item.active .page-link { background: var(--burger-orange); border-color: var(--burger-orange); color: #1a1208; }
</style>

<div class="container py-3">
    <div class="page-panel">
        <div class="page-panel-header">
            <h1>My Orders</h1>
            <p>Review your orders and status.</p>
        </div>

        @php
            $tabs = [
                null => 'All',
                'pending' => 'Pending',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ];
        @endphp
        <div class="orders-tabs-wrap">
            <nav class="orders-tabs" role="tablist">
                @foreach($tabs as $tabStatus => $label)
                    <a href="{{ route('orders.index', $tabStatus ? ['status' => $tabStatus] : []) }}" class="orders-tab {{ ($status ?? null) === $tabStatus ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>

        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-borderless orders-table mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="order-total">₱{{ number_format($order->total, 2) }}</td>
                            <td>
                                @php
                                    $badgeClass = match($order->status) {
                                        'completed' => 'bg-success',
                                        'shipped' => 'bg-info',
                                        'processing' => 'bg-warning text-dark',
                                        'cancelled' => 'bg-danger',
                                        default => 'bg-warning text-dark',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-light border-secondary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="orders-pagination">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="empty-orders">
                <p class="mb-2">No orders {{ isset($status) ? 'in this tab' : 'yet' }}.</p>
                <a href="{{ route('products.index') }}">Start shopping →</a>
            </div>
        @endif
    </div>
</div>
@endsection
