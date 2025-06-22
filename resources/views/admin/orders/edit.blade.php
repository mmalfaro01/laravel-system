@extends('layouts.admin')

@section('title', 'Manage Order')

@section('content')
<div class="container">
    <h2 class="mb-4">Manage Order #{{ $order->id }}</h2>

    {{-- Order Summary --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <p><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            
            {{-- Calculate Total from Order Items --}}
           @php
    $total = $order->orderItems ? $order->orderItems->sum(fn($item) => $item->price * $item->quantity) : 0;
@endphp

            <p><strong>Total Amount:</strong> ₱{{ number_format($total, 2) }}</p>
        </div>
    </div>

    {{-- Status Update Form --}}
    <div class="card">
        <div class="card-header bg-success text-white">
            <strong>Update Order Status</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="status" class="form-label">Select Status:</label>
                    <select name="status" id="status" class="form-select" required>
                        @foreach (['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Status</button>
                <a href="{{ route('admin.orders') }}" class="btn btn-secondary ms-2">Back to Orders</a>
            </form>
        </div>
    </div>
</div>
@endsection
