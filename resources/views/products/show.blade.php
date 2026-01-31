@extends('layouts.app')

@section('content')
<style>
    .product-showcase {
        background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%);
        border-radius: 2rem;
        padding: 3rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }
    
    .product-image-container {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        border: 5px solid var(--tropical-orange);
    }
    
    .rating-stars i {
        font-size: 1.5rem;
    }

    .ingredient-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: white;
        border-radius: 20px;
        margin: 0.3rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 2px solid var(--tropical-orange);
    }
</style>

<div class="container py-5">
    <div class="product-showcase">
        <div class="row g-5 align-items-center">

            {{-- Product Image --}}
            <div class="col-md-6">
                <div class="product-image-container">
                    <img src="{{ $product->image ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/500x400?text=Delicious+Burger' }}"
                         class="img-fluid"
                         style="width: 100%; object-fit: cover;"
                         alt="{{ $product->name }}">
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <span class="badge px-3 py-2 fs-6" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));">
                        <i class='bx bxs-hot'></i> BESTSELLER
                    </span>
                </div>

                <h1 class="display-4 fw-bold mb-3" style="color: var(--tropical-brown);">
                    <i class='bx bxs-burger me-2' style="color: var(--tropical-orange);"></i>
                    {{ $product->name }}
                </h1>

                <div class="rating-stars mb-3 text-warning">
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star'></i>
                    <i class='bx bxs-star-half'></i>
                    <span class="text-muted ms-2">(4.5/5.0 - 127 reviews)</span>
                </div>

                <p class="h2 fw-bold mb-4" style="color: var(--tropical-red);">
                    ₱{{ number_format($product->price, 2) }}
                </p>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: var(--tropical-brown);">
                        <i class='bx bx-info-circle'></i> Description
                    </h5>
                    <p class="fs-6 text-muted">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: var(--tropical-brown);">
                        <i class='bx bx-bowl-hot'></i> Key Ingredients
                    </h5>
                    <div>
                        <span class="ingredient-badge">🥩 Premium Beef</span>
                        <span class="ingredient-badge">🧀 Cheddar Cheese</span>
                        <span class="ingredient-badge">🥬 Fresh Lettuce</span>
                        <span class="ingredient-badge">🍅 Ripe Tomatoes</span>
                        <span class="ingredient-badge">🌶️ Tropical Sauce</span>
                    </div>
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="btn btn-lg px-5 py-3 fw-bold text-white shadow-lg" 
                            style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none;">
                        <i class='bx bx-cart-add fs-4 me-2'></i> Add to Cart
                    </button>
                </form>

                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="text-decoration-none fw-semibold" style="color: var(--tropical-orange);">
                        <i class='bx bx-arrow-back'></i> Back to Menu
                    </a>
                </div>

                <div class="mt-4 p-3 rounded" style="background: white; border-left: 4px solid var(--tropical-green);">
                    <p class="mb-2 fw-bold text-success">
                        <i class='bx bxs-truck'></i> Free Delivery on orders over ₱500
                    </p>
                    <p class="mb-0 text-muted small">
                        <i class='bx bx-time'></i> Estimated delivery: 25-35 minutes
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
