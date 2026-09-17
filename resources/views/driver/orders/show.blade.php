@extends('layouts.driver')

@section('title', 'Order Details')

@section('content')
@php
    $total = $order->orderItems->sum(fn($item) => $item->price * $item->quantity);
@endphp
<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Order #{{ $order->id }}</h2>
            <p class="text-muted mb-0">Review the assigned order and delivery details.</p>
        </div>
        <a href="{{ route('driver.orders') }}" class="btn btn-outline-light">Back</a>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Customer Details</h5>
                    <p class="mb-1"><strong>Name:</strong> {{ $order->customer_name ?? $order->user->name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->delivery_contact ?? $order->phone ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Address:</strong> {{ $order->delivery_address ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>City:</strong> {{ $order->city ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                    <hr>

                    <h5 class="fw-bold mb-3">Order Items</h5>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>₱{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Grand Total</th>
                                    <th class="text-end">₱{{ number_format($total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Delivery Summary</h5>
                    <p class="mb-1"><strong>Payment:</strong> {{ strtoupper($order->payment_method ?? 'N/A') }}</p>
                    <p class="mb-1"><strong>Delivery Date:</strong> {{ $order->delivery_date ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Driver:</strong> {{ $order->driver->name ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Status Notes</h5>
                    <p class="text-muted mb-0">Use this page to verify the order before pickup and delivery.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
