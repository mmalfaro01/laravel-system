@extends('layouts.driver')

@section('title', 'Driver Dashboard')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Welcome, {{ $driver->name }}</h2>
            <p class="text-muted mb-0">Track your assigned orders and delivery progress.</p>
        </div>
        <a href="{{ route('driver.orders') }}" class="btn btn-warning text-dark fw-bold">View Assigned Orders</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 h-100">
                <div class="text-muted small">Total Assigned</div>
                <div class="fs-2 fw-bold">{{ $stats['total'] }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 h-100">
                <div class="text-muted small">Pending</div>
                <div class="fs-2 fw-bold">{{ $stats['pending'] }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 h-100">
                <div class="text-muted small">Processing</div>
                <div class="fs-2 fw-bold">{{ $stats['processing'] }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 h-100">
                <div class="text-muted small">Shipped</div>
                <div class="fs-2 fw-bold">{{ $stats['shipped'] }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Recent Assigned Orders</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Assigned</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->customer_name ?? $order->user->name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('driver.orders.show', $order->id) }}" class="btn btn-sm btn-outline-warning">Open</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No assigned orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
