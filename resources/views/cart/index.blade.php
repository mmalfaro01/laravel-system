@extends('layouts.app')

@section('title', 'Cart - Tropical Burger')

@section('content')
<style>
    .page-panel {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 1.25rem;
        overflow: hidden;
    }
    .page-panel-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--burger-border);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .page-panel-header h1 { font-size: 1.35rem; font-weight: 800; margin: 0; color: var(--burger-white); }
    .page-panel-body { padding: 1rem 1.25rem; }
    .table-responsive { background: var(--burger-dark); }
    .cart-table { color: var(--burger-white); background: var(--burger-dark) !important; }
    .cart-table thead { background: var(--burger-black); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
    .cart-table thead th { border-color: var(--burger-border); padding: 0.65rem 0.75rem; font-weight: 700; background: var(--burger-black) !important; color: var(--burger-white) !important; }
    .cart-table tbody { background: var(--burger-dark) !important; }
    .cart-table tbody td { border-color: var(--burger-border); padding: 0.75rem; vertical-align: middle; background: var(--burger-dark) !important; color: var(--burger-white); }
    .cart-table tbody tr:hover { background: #252422; }
    .cart-table .col-item { min-width: 220px; width: 35%; }
    .cart-img { width: 52px; height: 52px; object-fit: cover; border-radius: 0.65rem; border: 1px solid var(--burger-border); flex-shrink: 0; }
    .cart-item-name { font-weight: 700; color: var(--burger-white); min-width: 0; white-space: normal; word-break: break-word; }
    .cart-price { color: var(--burger-gold); font-weight: 700; }
    .cart-qty-input { width: 4rem; text-align: center; background: var(--burger-black) !important; border: 1px solid var(--burger-border); border-color: var(--burger-border) !important; color: var(--burger-white) !important; font-size: 0.9rem; padding: 0.35rem; border-radius: 0.5rem; }
    .cart-summary { background: var(--burger-black); padding: 1rem 1.25rem; border-top: 1px solid var(--burger-border); color: var(--burger-muted); }
    .cart-summary .text-secondary { color: var(--burger-muted) !important; }
    .cart-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: space-between; margin-top: 1.25rem; }
    .empty-cart-panel { text-align: center; padding: 2.5rem 1.5rem; }
    .empty-cart-panel .icon { font-size: 3rem; color: var(--burger-orange); margin-bottom: 1rem; }
    .empty-cart-panel h3 { font-size: 1.25rem; font-weight: 800; color: var(--burger-white); margin-bottom: 0.5rem; }
    .empty-cart-panel p { color: var(--burger-muted); margin-bottom: 1.25rem; }
</style>

<div class="container py-3">
    <div class="page-panel">
        <div class="page-panel-header">
            <i class='bx bxs-cart' style="font-size: 1.5rem; color: var(--burger-orange);"></i>
            <h1>Your Cart</h1>
        </div>

        @if(count($cartItems) > 0)
        <div class="table-responsive">
            <table class="table table-borderless cart-table mb-0">
                <thead>
                    <tr>
                        <th class="col-item">Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr>
                        <td class="col-item">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item['image'] ? asset('images/products/' . $item['image']) : 'https://via.placeholder.com/52x52?text=Burger' }}"
                                     alt="{{ $item['name'] }}" class="cart-img">
                                <span class="cart-item-name">{{ $item['name'] }}</span>
                            </div>
                        </td>
                        <td class="cart-price">₱{{ number_format($item['price'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-inline-flex align-items-center gap-1">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm cart-qty-input">
                                <button type="submit" class="btn btn-sm btn-outline-light border-secondary">Update</button>
                            </form>
                        </td>
                        <td class="cart-price">₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="text-end">
                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="cart-summary d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                @if($total >= 500)
                    <span class="badge bg-success">Free delivery applied</span>
                @else
                    <small class="text-secondary">Add ₱{{ number_format(500 - $total, 2) }} more for free delivery</small>
                @endif
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary">Subtotal:</span>
                <span class="cart-price fs-5">₱{{ number_format($total, 2) }}</span>
            </div>
        </div>
        <div class="page-panel-body border-top" style="border-color: var(--burger-border) !important;">
            <div class="cart-actions">
                <a href="{{ route('products.index') }}" class="btn btn-outline-light">← Continue ordering</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout →</a>
            </div>
        </div>
        @else
        <div class="page-panel-body empty-cart-panel">
            <i class='bx bx-cart-alt icon'></i>
            <h3>Your cart is empty</h3>
            <p>Add burgers from the menu to get started.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Browse menu</a>
        </div>
        @endif
    </div>
</div>
@endsection
