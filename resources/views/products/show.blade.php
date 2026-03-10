@extends('layouts.app')

@section('title', $product->name . ' - Tropical Burger')

@section('content')
<style>
    .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); border-radius: 1.25rem; overflow: hidden; }
    .product-detail { display: grid; gap: 1.5rem; }
    @media (min-width: 768px) { .product-detail { grid-template-columns: 1fr 1fr; align-items: start; } }
    .product-detail img { width: 100%; height: 280px; object-fit: cover; border-radius: 1rem; border: 1px solid var(--burger-border); }
    .product-detail h1 { font-size: 1.5rem; font-weight: 800; color: var(--burger-white); margin: 0 0 0.5rem; }
    .product-detail .price { color: var(--burger-gold); font-weight: 800; font-size: 1.35rem; margin-bottom: 1rem; }
    .product-detail .description { color: var(--burger-muted); font-size: 0.95rem; line-height: 1.5; margin-bottom: 1rem; }
    .product-detail .meta { font-size: 0.9rem; color: var(--burger-muted); margin-bottom: 1.25rem; }
    .back-link { color: var(--burger-orange); font-size: 0.9rem; margin-bottom: 1rem; display: inline-block; }
    .ingredient-badge { display: inline-block; padding: 0.35rem 0.75rem; background: var(--burger-black); border: 1px solid var(--burger-border); border-radius: 999px; margin: 0.2rem; font-size: 0.8rem; color: var(--burger-muted); }
</style>

<div class="container py-3">
    <a href="{{ route('products.index') }}" class="back-link text-decoration-none">← Back to menu</a>

    <div class="page-panel p-3 p-md-4">
        <div class="product-detail">
            <div>
                <img src="{{ $product->image ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/500x280?text=Burger' }}"
                     alt="{{ $product->name }}">
            </div>
            <div>
                <span class="badge bg-warning text-dark mb-2">Bestseller</span>
                <h1>{{ $product->name }}</h1>
                <p class="price">₱{{ number_format($product->price, 2) }}</p>
                <p class="description">{{ $product->description }}</p>
                <div class="meta">
                    <span class="text-warning">★ ★ ★ ★ ★</span> 4.5 · Free delivery on orders ₱500+
                </div>
                <div class="mb-3">
                    <span class="ingredient-badge">Premium</span>
                    <span class="ingredient-badge">Fresh</span>
                </div>
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class='bx bx-cart-add me-2'></i>Add to cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
