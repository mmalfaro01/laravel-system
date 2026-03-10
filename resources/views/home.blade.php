@extends('layouts.app')

@section('title', 'Home - Tropical Burger')

@section('content')
<style>
    .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); border-radius: 1.25rem; padding: 1.25rem; margin-bottom: 1rem; }
    .page-panel h1 { font-size: 1.35rem; font-weight: 800; color: var(--burger-white); margin: 0 0 0.25rem; }
    .page-panel .subtitle { color: var(--burger-muted); font-size: 0.9rem; margin: 0; }
    .quick-card { background: var(--burger-black); border: 1px solid var(--burger-border); border-radius: 1rem; padding: 1.25rem; height: 100%; text-decoration: none; color: inherit; display: block; transition: border-color 0.2s; }
    .quick-card:hover { border-color: var(--burger-orange); color: var(--burger-white); }
    .quick-card .icon-wrap { width: 3rem; height: 3rem; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.75rem; }
    .quick-card h5 { font-size: 1.05rem; font-weight: 800; color: var(--burger-white); margin-bottom: 0.35rem; }
    .quick-card p { font-size: 0.85rem; color: var(--burger-muted); margin-bottom: 0.5rem; }
    .quick-badge { display: inline-block; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.6rem; border-radius: 999px; background: var(--burger-orange); color: #1a1208; }
    .offers-row { font-size: 0.9rem; color: var(--burger-muted); }
    .offers-row .col-md-4 { border-right: 1px solid var(--burger-border); }
    .offers-row .col-md-4:last-child { border-right: none; }
    @media (max-width: 767px) { .offers-row .col-md-4 { border-right: none; border-bottom: 1px solid var(--burger-border); padding-bottom: 0.5rem; } .offers-row .col-md-4:last-child { border-bottom: none; } }
</style>

<div class="container py-3">
    <div class="page-panel">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p class="subtitle">Choose an option below to continue.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <div class="row g-3">
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="quick-card">
                <div class="icon-wrap" style="background: var(--burger-orange); color: #1a1208;"><i class='bx bxs-food-menu'></i></div>
                <h5>Browse menu</h5>
                <p>Explore burgers and add to cart.</p>
                <span class="quick-badge">Menu</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('cart.index') }}" class="quick-card">
                <div class="icon-wrap" style="background: var(--burger-gold); color: #1a1208;"><i class='bx bxs-cart'></i></div>
                <h5>My cart</h5>
                <p>Review items and checkout.</p>
                <span class="quick-badge">Cart</span>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('orders.index') }}" class="quick-card">
                <div class="icon-wrap" style="background: var(--burger-orange); color: #1a1208;"><i class='bx bxs-package'></i></div>
                <h5>My orders</h5>
                <p>Track your orders.</p>
                <span class="quick-badge">Orders</span>
            </a>
        </div>
    </div>

    <div class="page-panel mt-3">
        <h5 class="mb-3" style="color: var(--burger-gold);">Offers</h5>
        <div class="row offers-row text-center">
            <div class="col-12 col-md-4"><strong class="text-white">20% off</strong> double burgers</div>
            <div class="col-12 col-md-4"><strong class="text-white">Free delivery</strong> on orders ₱500+</div>
            <div class="col-12 col-md-4"><strong class="text-white">Free drink</strong> with combo</div>
        </div>
    </div>
</div>
@endsection
