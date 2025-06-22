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
                <th>#</th><th>Customer</th><th>Total</th><th>Status</th><th>Placed</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>₱{{ number_format($order->total, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">UPDATE</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
