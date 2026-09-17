@extends('layouts.staff')

@section('title', 'Staff Orders')

@section('content')
<div class="container">
    <h2 class="mb-4">Orders</h2>

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
                        <a href="{{ route('staff.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">Update</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted">Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} results</div>
        <div>{{ $orders->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection
