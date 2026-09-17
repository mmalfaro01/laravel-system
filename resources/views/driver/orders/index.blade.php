@extends('layouts.driver')

@section('title', 'Assigned Orders')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Assigned Orders</h2>
            <p class="text-muted mb-0">Only orders assigned to your account are shown here.</p>
        </div>
    </div>

    <ul class="nav nav-tabs mb-3">
        @foreach (['all', 'pending', 'processing', 'shipped', 'completed', 'cancelled'] as $statusOption)
            <li class="nav-item">
                <a class="nav-link {{ request('status') == $statusOption || ($statusOption == 'all' && request('status') == null) ? 'active' : '' }}"
                   href="{{ route('driver.orders', ['status' => $statusOption == 'all' ? null : $statusOption]) }}">
                    {{ ucfirst($statusOption) }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Placed</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer_name ?? $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->delivery_address ?? 'N/A' }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->created_at->diffForHumans() }}</td>
                                <td class="text-end">
                                    <a href="{{ route('driver.orders.show', $order->id) }}" class="btn btn-sm btn-warning text-dark fw-bold">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No assigned orders found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
