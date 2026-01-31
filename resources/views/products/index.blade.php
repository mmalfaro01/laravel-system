@extends('layouts.app')

@section('content')
<style>
    .product-card {
        position: relative;
        overflow: hidden;
    }
    
    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,107,53,0.1), rgba(231,76,60,0.1));
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 0;
        pointer-events: none;
    }
    
    .product-card:hover::before {
        opacity: 1;
    }
    
    .card-footer {
        position: relative;
        z-index: 10;
    }

    .badge-spicy {
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
</style>

<div class="container py-4">

    <div class="text-center mb-5">
        <i class='bx bxs-burger display-1 mb-3' style="color: var(--tropical-orange);"></i>
        <h1 class="fw-bold display-4" style="color: var(--tropical-brown);">Our Burger Menu</h1>
        <p class="lead" style="color: var(--tropical-orange);">🌴 Dive into a world of tropical flavors! 🍔</p>
    </div>

    {{-- Search Bar --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="🔍 Search for your favorite burger..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4">Search</button>
            </form>
        </div>
    </div>

    {{-- Product List --}}
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow-lg w-100 product-card border-0">
                <div class="position-absolute top-0 end-0 m-3" style="z-index: 2; pointer-events: none;">
                    <span class="badge px-3 py-2" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));">
                        <i class='bx bxs-hot'></i> HOT
                    </span>
                </div>

                <img src="{{ $product->image ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/400x300?text=Delicious+Burger' }}"
                     alt="{{ $product->name }}"
                     class="card-img-top"
                     style="height: 280px; object-fit: cover; border-bottom: 4px solid var(--tropical-orange);">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold" style="color: var(--tropical-brown);">
                        <i class='bx bxs-burger me-2' style="color: var(--tropical-orange);"></i>
                        {{ $product->name }}
                    </h5>
                    <p class="card-text text-muted small mb-3">
                        {{ Str::limit($product->description, 100) }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="h4 fw-bold mb-0" style="color: var(--tropical-red);">
                            ₱{{ number_format($product->price, 2) }}
                        </p>
                        <div class="text-warning">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star-half'></i>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 d-flex justify-content-between p-3">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-warning w-50 me-2 fw-semibold">
                        <i class='bx bx-show-alt'></i> Details
                    </a>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="w-50">
                        @csrf
                        <button type="submit" class="btn w-100 text-white fw-bold" 
                                style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none;">
                            <i class='bx bx-cart-add'></i> Add
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center border-0 shadow-lg" 
                 style="background: linear-gradient(135deg, #FFE4B5, #FFF8DC);">
                <i class='bx bx-sad display-4' style="color: var(--tropical-orange);"></i>
                <h4 class="mt-3">No burgers found!</h4>
                <p>Check back soon for more delicious options.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
