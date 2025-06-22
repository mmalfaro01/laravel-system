@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="mb-4 text-center">
        <h1 class="display-5 fw-bold">🛒 Shopping Cart</h1>
        <p class="text-muted">Review your items before checking out.</p>
    </div>

    @if(count($cartItems) > 0)
    <div class="table-responsive shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ $item['image'] ? asset('images/products/' . $item['image']) : 'https://via.placeholder.com/60' }}"
                                 alt="{{ $item['name'] }}"
                                 class="rounded me-3"
                                 width="60" height="60"
                                 style="object-fit: cover;">
                            <span>{{ $item['name'] }}</span>
                        </div>
                    </td>

                    <td class="text-primary">
                        ₱{{ number_format($item['price'], 2) }}
                    </td>

                    <td>
                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="form-control form-control-sm w-50 me-2">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Update</button>
                        </form>
                    </td>

                    <td class="fw-semibold">
                        ₱{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </td>

                    <td>
                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                &times; Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td colspan="2" class="h5 text-success">
                        ₱{{ number_format($total, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Action Buttons --}}
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            ← Continue Shopping
        </a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary px-4">
            Proceed to Checkout →
        </a>
    </div>

    @else
    <div class="alert alert-info text-center">
        <h5 class="mb-2">Your cart is empty.</h5>
        <p>
            Ready to shop? <a href="{{ route('products.index') }}" class="text-decoration-underline">Browse our products</a> and add items to your cart.
        </p>
    </div>
    @endif

</div>
@endsection
