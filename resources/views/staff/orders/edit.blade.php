@extends('layouts.staff')

@section('title', 'Manage Order')

@section('content')
<div class="container">
    <h3 class="mb-3">Manage Order #{{ $order->id }}</h3>

    <div class="row">
        <div class="col-md-8">
            <div class="card p-3">
                <h5>Order Items</h5>
                <table class="table">
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? '—' }}</td>
                                <td>₱{{ number_format($item->price,2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>₱{{ number_format($item->price * $item->quantity,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <form method="POST" action="{{ route('staff.orders.update', $order->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Assign Driver</label>
                        <select name="driver_id" class="form-select">
                            <option value="">Unassigned</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ (string)$order->driver_id === (string)$driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            @foreach(['pending','processing','shipped','completed','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Update Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
