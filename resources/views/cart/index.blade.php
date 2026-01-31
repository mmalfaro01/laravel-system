@extends('layouts.app')

@section('content')
<style>
    .cart-header {
        background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
        color: white;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        margin-bottom: 2rem;
    }

    .cart-table {
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .cart-table thead {
        background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
        color: white;
    }

    .product-image-cart {
        border: 3px solid var(--tropical-orange);
        border-radius: 10px;
    }
</style>

<div class="container py-5">

    <div class="cart-header text-center">
        <i class='bx bxs-cart display-1 mb-3'></i>
        <h1 class="display-4 fw-bold mb-2">Your Burger Cart</h1>
        <p class="fs-5 mb-0">Review your delicious selections before checkout! 🍔</p>
    </div>

    @if(count($cartItems) > 0)
    <div class="cart-table">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col" class="py-3"><i class='bx bxs-burger me-2'></i>Burger</th>
                    <th scope="col" class="py-3"><i class='bx bx-money me-2'></i>Price</th>
                    <th scope="col" class="py-3"><i class='bx bx-hash me-2'></i>Quantity</th>
                    <th scope="col" class="py-3"><i class='bx bx-calculator me-2'></i>Total</th>
                    <th scope="col" class="py-3"><i class='bx bx-trash me-2'></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ $item['image'] ? asset('images/products/' . $item['image']) : 'https://via.placeholder.com/80x80?text=Burger' }}"
                                 alt="{{ $item['name'] }}"
                                 class="product-image-cart me-3"
                                 width="80" height="80"
                                 style="object-fit: cover;">
                            <div>
                                <span class="fw-bold" style="color: var(--tropical-brown);">{{ $item['name'] }}</span>
                                <br>
                                <small class="text-muted"><i class='bx bxs-hot'></i> Fresh & Hot</small>
                            </div>
                        </div>
                    </td>

                    <td class="fw-bold" style="color: var(--tropical-red);">
                        ₱{{ number_format($item['price'], 2) }}
                    </td>

                    <td>
                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="form-control form-control-sm me-2" style="width: 70px; border: 2px solid var(--tropical-orange);">
                            <button type="submit" class="btn btn-sm btn-warning text-dark fw-semibold">
                                <i class='bx bx-refresh'></i> Update
                            </button>
                        </form>
                    </td>

                    <td class="fw-bold fs-5" style="color: var(--tropical-orange);">
                        ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </td>

                    <td>
                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger fw-semibold">
                                <i class='bx bx-x'></i> Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4" style="background: linear-gradient(135deg, #FFF8DC, #FFE4B5);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="fw-bold mb-2" style="color: var(--tropical-brown);">
                        <i class='bx bxs-discount'></i> Order Summary
                    </h4>
                    <p class="text-muted mb-0">
                        @if($total >= 500)
                            <span class="badge bg-success px-3 py-2">
                                <i class='bx bxs-truck'></i> FREE DELIVERY APPLIED!
                            </span>
                        @else
                            <small>Add ₱{{ number_format(500 - $total, 2) }} more for FREE delivery!</small>
                        @endif
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <p class="mb-1 text-muted">Subtotal:</p>
                    <h3 class="fw-bold mb-0" style="color: var(--tropical-red);">
                        ₱{{ number_format($total, 2) }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="d-flex justify-content-between mt-5">
        <a href="{{ route('products.index') }}" class="btn btn-outline-warning btn-lg px-5 fw-semibold">
            <i class='bx bx-arrow-back me-2'></i> Continue Ordering
        </a>
        <a href="{{ route('checkout.index') }}" class="btn btn-lg px-5 fw-bold text-white shadow-lg" 
           style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none;">
            Checkout Now <i class='bx bx-right-arrow-alt ms-2'></i>
        </a>
    </div>

    @else
    <div class="alert border-0 shadow-lg text-center p-5" 
         style="background: linear-gradient(135deg, #FFF8DC, #FFE4B5); border-left: 5px solid var(--tropical-orange) !important;">
        <i class='bx bx-cart-alt display-1 mb-4' style="color: var(--tropical-orange);"></i>
        <h3 class="fw-bold mb-3" style="color: var(--tropical-brown);">Your cart is empty!</h3>
        <p class="lead mb-4">Time to fill it up with delicious tropical burgers! 🍔</p>
        <a href="{{ route('products.index') }}" class="btn btn-lg fw-bold text-white px-5" 
           style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none;">
            <i class='bx bx-food-menu me-2'></i> Browse Our Menu
        </a>
    </div>
    @endif

</div>
@endsection
