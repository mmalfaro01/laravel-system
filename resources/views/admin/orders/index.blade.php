@extends('layouts.admin')
@section('title', 'Manage Orders')

@section('content')
<div class="container">
    <h2 class="mb-4">Order Management</h2>

    <ul class="nav nav-tabs mb-3">
        @foreach (['all', 'pending', 'processing', 'shipped', 'completed', 'cancelled'] as $statusOption)
            <li class="nav-item">
                <a class="nav-link {{ request('status') == $statusOption || ($statusOption == 'all' && request('status') == null) ? 'active' : '' }}"
                   href="{{ route('admin.orders', ['status' => $statusOption == 'all' ? null : $statusOption]) }}">
                    {{ ucfirst($statusOption) }}
                </a>
            </li>
        @endforeach
    </ul>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th><th>Customer</th><th>Driver</th><th>Total</th><th>Status</th><th>Placed</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ $order->driver->name ?? 'Unassigned' }}</td>
                    <td>₱{{ number_format($order->total, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">UPDATE</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
        @if (method_exists($orders, 'firstItem'))
            <div class="text-muted">
                Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} results
            </div>
            <div>
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-muted">
                Showing {{ $orders->count() ? 1 : 0 }} to {{ $orders->count() }} of {{ $orders->count() }} results
            </div>
            <div></div>
        @endif
    </div>
</div>
@endsection
