@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Notifications disabled (table doesn't exist) --}}

    {{-- Page Title --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold text-primary">My Orders</h2>
            <p class="text-muted">Review your past purchases and order status.</p>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="row">
        <div class="col-12">
            @if($orders->count() > 0)
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Order #</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>₱{{ number_format($order->total, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
            @else
            <div class="alert alert-info text-center py-4">
                <h5 class="mb-2">No orders yet</h5>
                <p class="mb-0">You haven’t placed any orders yet. <a href="{{ route('products.index') }}" class="text-decoration-none fw-semibold">Start shopping now!</a></p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
