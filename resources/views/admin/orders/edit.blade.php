@extends('layouts.admin')

@section('title', 'Manage Order')

@section('content')
<style>
    .order-shell {
        background: linear-gradient(180deg, rgba(243,154,18,0.08), transparent 30%);
        border: 1px solid var(--burger-border);
        border-radius: 1.5rem;
        overflow: hidden;
    }
    .order-hero {
        padding: 1.5rem;
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-bottom: 1px solid var(--burger-border);
    }
    .order-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.4rem 0.75rem;
        border-radius: 999px;
        background: rgba(243,154,18,0.12);
        color: var(--burger-gold);
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid rgba(243,154,18,0.25);
    }
    .panel-card {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 1.25rem;
        height: 100%;
    }
    .panel-card .card-body {
        padding: 1.25rem;
    }
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0.75rem;
    }
    .summary-item {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 1rem;
        padding: 0.9rem;
    }
    .summary-item span {
        display: block;
    }
    .summary-label {
        color: var(--burger-muted);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.35rem;
        font-weight: 700;
    }
    .summary-value {
        color: var(--burger-white);
        font-weight: 700;
    }
    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.45rem 0.75rem;
        border-radius: 999px;
        background: rgba(243,154,18,0.12);
        color: var(--burger-gold);
        border: 1px solid rgba(243,154,18,0.25);
        font-weight: 700;
        font-size: 0.85rem;
    }
    .step-list {
        display: grid;
        gap: 0.75rem;
    }
    .step-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.85rem 0.9rem;
        border-radius: 1rem;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
    }
    .step-dot {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(243,154,18,0.15);
        color: var(--burger-gold);
    }
    .action-row {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .action-row .btn {
        border-radius: 999px;
        padding: 0.75rem 1.15rem;
        font-weight: 700;
    }
</style>

@php
    $total = $order->orderItems ? $order->orderItems->sum(fn($item) => $item->price * $item->quantity) : 0;
    $status = $order->status;
    $paymentMethod = $order->payment_method ? strtoupper($order->payment_method) : 'N/A';
    $shippingLabel = $order->shipping_option === 'schedule' ? 'Schedule for later' : 'Deliver now';
    $deliveryDate = $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('F d, Y') : '—';
    $statusIcon = match ($status) {
        'pending' => 'bx-time',
        'processing' => 'bx-loader-circle',
        'shipped' => 'bx-truck',
        'completed' => 'bx-check-circle',
        'cancelled' => 'bx-x-circle',
        default => 'bx-info-circle',
    };
@endphp

<div class="container-fluid py-2">
    <div class="order-shell">
        <div class="order-hero">
            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
                <div>
                    <span class="order-badge"><i class='bx bx-receipt'></i> Order Workspace</span>
                    <h2 class="mt-3 mb-2 fw-bold">Manage Order #{{ $order->id }}</h2>
                    <p class="text-muted mb-0">Review the order snapshot and update the status from the control panel.</p>
                </div>
                <span class="status-chip"><i class='bx {{ $statusIcon }}'></i> {{ ucfirst($status) }}</span>
            </div>
        </div>

        <div class="row g-0">
            <div class="col-lg-7 p-3 p-lg-4">
                <div class="panel-card">
                    <div class="card-body">
                        <h5 class="text-white fw-bold mb-3">Order Summary</h5>

                        <div class="summary-grid mb-3">
                            <div class="summary-item">
                                <span class="summary-label">Customer</span>
                                <span class="summary-value">{{ $order->user->name ?? 'Guest' }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Order Date</span>
                                <span class="summary-value">{{ $order->created_at->format('F d, Y h:i A') }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Status</span>
                                <span class="summary-value">{{ ucfirst($status) }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Total Amount</span>
                                <span class="summary-value">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <div class="step-list">
                            <div class="step-item">
                                <div class="step-dot"><i class='bx bx-user'></i></div>
                                <div>
                                    <div class="fw-semibold text-white">Customer details loaded</div>
                                    <small class="text-muted">No new fields added, just a cleaner summary layout.</small>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"><i class='bx bx-package'></i></div>
                                <div>
                                    <div class="fw-semibold text-white">Order totals calculated</div>
                                    <small class="text-muted">Total is derived from the current order items.</small>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"><i class='bx bx-stats'></i></div>
                                <div>
                                    <div class="fw-semibold text-white">Status workflow ready</div>
                                    <small class="text-muted">Move the order through pending, processing, shipped, completed, or cancelled.</small>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-white fw-bold mt-4 mb-3">Checkout Details</h5>
                        <div class="summary-grid mb-3">
                            <div class="summary-item">
                                <span class="summary-label">Customer Name</span>
                                <span class="summary-value">{{ $order->customer_name ?? $order->user->name ?? 'Guest' }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Phone</span>
                                <span class="summary-value">{{ $order->phone ?? '—' }}</span>
                            </div>
                            <div class="summary-item" style="grid-column: span 2;">
                                <span class="summary-label">Delivery Address</span>
                                <span class="summary-value">{{ $order->delivery_address ?? '—' }}</span>
                                <small class="text-muted">{{ $order->city ?? '—' }} {{ $order->postal_code ? '• ' . $order->postal_code : '' }}</small>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Payment Method</span>
                                <span class="summary-value">{{ $paymentMethod }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Delivery Mode</span>
                                <span class="summary-value">{{ $shippingLabel }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Scheduled Date</span>
                                <span class="summary-value">{{ $deliveryDate }}</span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Contact</span>
                                <span class="summary-value">{{ $order->delivery_contact ?? $order->phone ?? '—' }}</span>
                            </div>
                            <div class="summary-item" style="grid-column: span 2;">
                                <span class="summary-label">Assigned Driver</span>
                                <span class="summary-value">{{ $order->driver->name ?? 'Unassigned' }}</span>
                            </div>
                        </div>

                        <h5 class="text-white fw-bold mt-4 mb-3">Order Items</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless detail-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->orderItems as $item)
                                        <tr>
                                            <td>{{ $item->product->name ?? '—' }}</td>
                                            <td>₱{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">No items available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 p-3 p-lg-4 ps-lg-0">
                <div class="panel-card mb-3">
                    <div class="card-body">
                        <h5 class="text-white fw-bold mb-3">Status Control</h5>

                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="driver_id" class="form-label text-white fw-semibold">Assign Driver</label>
                                <select name="driver_id" id="driver_id" class="form-select form-select-lg mb-3">
                                    <option value="">Unassigned</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}" {{ (string) $order->driver_id === (string) $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }} - {{ $driver->email }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="status" class="form-label text-white fw-semibold">Select Status</label>
                                <select name="status" id="status" class="form-select form-select-lg" required>
                                    @foreach (['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $statusOption)
                                        <option value="{{ $statusOption }}" {{ $order->status === $statusOption ? 'selected' : '' }}>
                                            {{ ucfirst($statusOption) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mt-4">
                                <div class="text-muted small">
                                    Use the control below to update the order state.
                                </div>
                                <div class="action-row">
                                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-light">Back to Orders</a>
                                    <button type="submit" class="btn btn-warning text-dark">
                                        <i class='bx bx-save'></i> Update Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel-card">
                    <div class="card-body">
                        <h6 class="text-white fw-bold mb-2">Status Notes</h6>
                        <div class="step-list">
                            <div class="step-item">
                                <div class="step-dot"><i class='bx bx-time-five'></i></div>
                                <div>
                                    <div class="fw-semibold text-white">Pending</div>
                                    <small class="text-muted">Order is waiting to be prepared.</small>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"><i class='bx bx-cog'></i></div>
                                <div>
                                    <div class="fw-semibold text-white">Processing</div>
                                    <small class="text-muted">Kitchen or team is working on it.</small>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-dot"><i class='bx bx-truck'></i></div>
                                <div>
                                    <div class="fw-semibold text-white">Shipped / Completed</div>
                                    <small class="text-muted">Customer notification is triggered automatically.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
