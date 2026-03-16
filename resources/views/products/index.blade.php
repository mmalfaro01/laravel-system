@extends('layouts.app')

@section('title', 'Menu - Tropical Burger')

@section('content')
<style>
    .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); border-radius: 1.25rem; padding: 1.25rem; margin-bottom: 1rem; }
    .page-panel h1 { font-size: 1.35rem; font-weight: 800; color: var(--burger-white); margin: 0 0 0.25rem; }
    .page-panel .subtitle { color: var(--burger-muted); font-size: 0.9rem; margin: 0; }
    .search-form .form-control { background: var(--burger-black); border-color: var(--burger-border); color: var(--burger-white); border-radius: 999px; }
    .search-form .form-control:focus { border-color: var(--burger-orange); }
    .product-card { background: var(--burger-black); border: 1px solid var(--burger-border); border-radius: 1rem; overflow: hidden; height: 100%; transition: border-color 0.2s; }
    .product-card:hover { border-color: var(--burger-orange); }
    .product-card .card-img-top { height: 180px; object-fit: cover; border-bottom: 1px solid var(--burger-border); }
    .product-card .card-body { padding: 1rem; }
    .product-card .card-title { font-size: 1.05rem; font-weight: 800; color: var(--burger-white); margin-bottom: 0.35rem; }
    .product-card .card-text { font-size: 0.85rem; color: var(--burger-muted); margin-bottom: 0.75rem; }
    .product-card .price { color: var(--burger-gold); font-weight: 800; font-size: 1.1rem; }
    .product-card .card-footer { background: transparent; border-top: 1px solid var(--burger-border); padding: 0.75rem 1rem; display: flex; gap: 0.5rem; }
    .product-card .btn { border-radius: 999px; font-size: 0.85rem; padding: 0.4rem 0.85rem; }
    .empty-state { text-align: center; padding: 2.5rem; color: var(--burger-muted); }
    .menu-tabs { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-top: 0.4rem; }
    .menu-tab { padding: 0.3rem 0.9rem; border-radius: 999px; border: 1px solid var(--burger-border); font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.12em; color: var(--burger-muted); text-decoration: none; }
    .menu-tab.active, .menu-tab:hover { border-color: var(--burger-orange); color: var(--burger-white); background: var(--burger-dark); }
</style>

<div class="container py-3">
    <div class="page-panel d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-3">
        <div>
            <h1>Our Menu</h1>
            <p class="subtitle">Burgers, snacks, and drinks</p>
            <div class="menu-tabs">
                @php
                    $tabs = [
                        'all' => 'All',
                        'burgers' => 'Burgers',
                        'snacks' => 'Snacks',
                        'drinks' => 'Drinks',
                    ];
                @endphp
                @foreach($tabs as $slug => $label)
                    @php
                        $isActive = ($slug === 'all' && empty($activeCategorySlug)) || $activeCategorySlug === $slug;
                        $url = $slug === 'all'
                            ? route('products.index', array_filter(['search' => request('search')]))
                            : route('products.index', array_filter(['category' => $slug, 'search' => request('search')]));
                    @endphp
                    <a href="{{ $url }}" class="menu-tab {{ $isActive ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
        <form action="{{ route('products.index') }}" method="GET" class="search-form d-flex gap-2" style="max-width: 320px;">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">Search</button>
        </form>
    </div>

    <div class="row g-3">
        @forelse($products as $product)
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card product-card border-0">
                <img src="{{ $product->image ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/400x180?text=Burger' }}"
                     alt="{{ $product->name }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                    <p class="price mb-0">₱{{ number_format($product->price, 2) }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-light btn-sm flex-grow-1">Details</a>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="page-panel empty-state">
                <p class="mb-2">No products found.</p>
                <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">Clear search</a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
