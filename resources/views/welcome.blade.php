@extends('layouts.app')

@section('title', 'Tropical Burger | Home')

@section('content')
@php
    $placeholder = asset('images/default.png');
    $featuredImage = $featured && $featured->image
        ? asset('images/products/' . $featured->image)
        : $placeholder;
@endphp

<style>
    :root {
        --page-bg: #050505;
        --panel-bg: #111111;
        --card-bg: #0d0d0d;
        --accent-yellow: #ffc933;
        --accent-yellow-soft: #ffdd7a;
        --muted: #9b9b9b;
        --border-subtle: #252525;
    }

    body.home-landing {
        background: var(--page-bg);
    }

    .home-shell {
        max-width: 1180px;
        margin: 0 auto;
        padding: 2.5rem 1.25rem 3rem;
        color: #ffffff;
    }

    .home-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.25rem;
    }

    .home-logo {
        font-weight: 900;
        font-size: 1.7rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .home-header-meta {
        max-width: 420px;
        font-size: 0.85rem;
        color: var(--muted);
        text-align: right;
    }

    .hero-panel {
        background: #181818;
        border-radius: 1.5rem;
        border: 1px solid var(--border-subtle);
        overflow: hidden;
        box-shadow: 0 26px 60px rgba(0,0,0,0.8);
        margin-bottom: 2.5rem;
    }

    .hero-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.85rem 1.5rem;
        background: #101010;
        border-bottom: 1px solid #1f1f1f;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.14em;
    }

    .hero-nav-links {
        display: flex;
        gap: 1.75rem;
    }

    .hero-nav-links a {
        color: var(--muted);
        text-decoration: none;
    }

    .hero-nav-links a.active,
    .hero-nav-links a:hover {
        color: #ffffff;
    }

    .hero-content {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(0, 1.4fr);
        gap: 1.75rem;
        padding: 1.75rem 1.75rem 1.5rem;
    }

    .hero-copy-eyebrow {
        font-size: 0.78rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--accent-yellow-soft);
        margin-bottom: 0.75rem;
    }

    .hero-title-main {
        font-size: 2.4rem;
        line-height: 1.05;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .hero-sub {
        font-size: 0.93rem;
        color: var(--muted);
        margin-bottom: 1.4rem;
        max-width: 20rem;
    }

    .hero-cta-row {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        margin-bottom: 1.5rem;
    }

    .btn-pill-main {
        border-radius: 999px;
        padding: 0.75rem 1.6rem;
        border: none;
        background: var(--accent-yellow);
        color: #101010;
        font-weight: 800;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        text-decoration: none;
    }

    .btn-pill-main:hover {
        background: var(--accent-yellow-soft);
        color: #101010;
    }

    .hero-meta-line {
        font-size: 0.78rem;
        color: var(--muted);
    }

    .hero-image-wrap {
        position: relative;
        background: radial-gradient(circle at center, #262626 0, #111111 60%, #050505 100%);
        border-radius: 1.2rem;
        border: 1px solid #222;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem 1rem;
    }

    .hero-image-wrap img {
        max-width: 100%;
        height: auto;
        object-fit: contain;
        filter: drop-shadow(0 32px 45px rgba(0,0,0,0.9));
    }

    .hero-price-tag {
        position: absolute;
        bottom: 1.3rem;
        right: 1.3rem;
        background: #000;
        border-radius: 999px;
        padding: 0.45rem 0.95rem;
        font-weight: 800;
        font-size: 0.82rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .hero-price-tag span {
        color: var(--accent-yellow);
    }

    .catalog-panel {
        background: var(--panel-bg);
        border-radius: 1.5rem;
        border: 1px solid var(--border-subtle);
        padding: 1.5rem 1.5rem 1.75rem;
    }

    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.4rem;
    }

    .catalog-header h2 {
        font-size: 1.25rem;
        font-weight: 800;
        margin: 0;
    }

    .catalog-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.16em;
    }

    .catalog-tab {
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        border: 1px solid #262626;
        color: var(--muted);
        text-decoration: none;
        cursor: pointer;
        background: transparent;
    }

    .catalog-tab.active,
    .catalog-tab:hover {
        border-color: var(--accent-yellow);
        color: #ffffff;
        background: #181818;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: 1.1rem 1.2rem;
    }

    .product-card {
        background: var(--card-bg);
        border-radius: 1rem;
        border: 1px solid #202020;
        padding: 0.85rem 0.9rem 0.9rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-card img {
        width: 100%;
        height: 150px;
        object-fit: contain;
        margin-bottom: 0.65rem;
        background: radial-gradient(circle at center, #2a2a2a 0, #101010 70%);
        border-radius: 0.85rem;
    }

    .product-name {
        font-size: 0.98rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
    }

    .product-desc {
        font-size: 0.8rem;
        color: var(--muted);
        margin-bottom: 0.5rem;
        min-height: 2.4em;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        gap: 0.5rem;
    }

    .product-price {
        font-size: 0.95rem;
        font-weight: 800;
        color: var(--accent-yellow);
    }

    .product-cta-row {
        display: flex;
        gap: 0.4rem;
    }

    .btn-card {
        border-radius: 999px;
        font-size: 0.76rem;
        padding: 0.45rem 0.8rem;
        border: 1px solid #2b2b2b;
        background: transparent;
        color: #ffffff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-card-main {
        border-color: var(--accent-yellow);
        background: var(--accent-yellow);
        color: #111111;
        font-weight: 700;
    }

    .btn-card-main:hover {
        background: var(--accent-yellow-soft);
        border-color: var(--accent-yellow-soft);
        color: #111111;
    }

    @media (max-width: 991.98px) {
        .hero-content {
            grid-template-columns: minmax(0, 1fr);
        }
    }
</style>

<div class="home-shell">
    {{-- Top title bar --}}
    <div class="home-header-top">
        <div class="home-logo">TROPICAL BURGER</div>
        <div class="home-header-meta">
            Siquijor’s juicy, island‑style burgers. Fresh ingredients, toasted buns,
            and just the right amount of mess.
        </div>
    </div>

    {{-- HERO --}}
    <div class="hero-panel">
        <div class="hero-nav">
            <div>YOUR BURGER</div>
            <div class="hero-nav-links">
                <a href="{{ route('home') }}" class="active">Home</a>
                <a href="{{ route('products.index') }}">Burgers</a>
                <a href="{{ route('cart.index') }}">Cart</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>

        <div class="hero-content">
            <div>
                <div class="hero-copy-eyebrow">
                    {{ $featured ? 'Will you eat this?' : 'Signature burger' }}
                </div>
                <div class="hero-title-main">
                    @if($featured)
                        #{{ \Illuminate\Support\Str::headline($featured->name) }}
                    @else
                        #Your Damn Burger
                    @endif
                </div>
                <p class="hero-sub">
                    @if($featured)
                        {{ \Illuminate\Support\Str::limit($featured->description, 110) }}
                    @else
                        Island‑style burgers, grilled fresh with tropical flavor in every bite.
                    @endif
                </p>

                <div class="hero-cta-row">
                    <a href="{{ route('products.index') }}" class="btn-pill-main">
                        Add to bag
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <span class="hero-meta-line">
                        Open {{ now()->format('g:i A') }} – Late night cravings welcome.
                    </span>
                </div>
            </div>

            <div class="hero-image-wrap">
                <img src="{{ $featuredImage }}" alt="{{ $featured->name ?? 'Featured burger' }}">
                @if($featured)
                    <div class="hero-price-tag">
                        <span>{{ $featured->formatted_price }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- CATALOG --}}
    <section class="catalog-panel">
        <div class="catalog-header">
            <h2>Our Menu</h2>
            <div class="catalog-tabs" id="catalogTabs">
                <button type="button" class="catalog-tab active" data-category="burgers">Burgers</button>
                <button type="button" class="catalog-tab" data-category="snacks">Snacks</button>
                <button type="button" class="catalog-tab" data-category="drinks">Drinks</button>
            </div>
        </div>

        {{-- Burgers --}}
        @if($burgers->count())
            <h3 class="mt-2 mb-2" style="font-size: 1rem; font-weight: 700;">Burgers</h3>
            <div class="product-grid mb-4 catalog-section" data-category="burgers">
                @foreach($burgers as $product)
                    @php
                        $img = $product->image
                            ? asset('images/products/' . $product->image)
                            : $placeholder;
                    @endphp
                    <article class="product-card">
                        <img src="{{ $img }}" alt="{{ $product->name }}">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">
                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                        </p>
                        <div class="product-meta">
                            <div class="product-price">
                                {{ $product->formatted_price }}
                            </div>
                            <div class="product-cta-row">
                                <a href="{{ route('products.show', $product) }}" class="btn-card">Details</a>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-card btn-card-main">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        {{-- Snacks --}}
        @if($snacks->count())
            <h3 class="mt-2 mb-2" style="font-size: 1rem; font-weight: 700;">Snacks</h3>
            <div class="product-grid mb-4 catalog-section" data-category="snacks">
                @foreach($snacks as $product)
                    @php
                        $img = $product->image
                            ? asset('images/products/' . $product->image)
                            : $placeholder;
                    @endphp
                    <article class="product-card">
                        <img src="{{ $img }}" alt="{{ $product->name }}">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">
                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                        </p>
                        <div class="product-meta">
                            <div class="product-price">
                                {{ $product->formatted_price }}
                            </div>
                            <div class="product-cta-row">
                                <a href="{{ route('products.show', $product) }}" class="btn-card">Details</a>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-card btn-card-main">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        {{-- Drinks --}}
        @if($drinks->count())
            <h3 class="mt-2 mb-2" style="font-size: 1rem; font-weight: 700;">Drinks</h3>
            <div class="product-grid catalog-section" data-category="drinks">
                @foreach($drinks as $product)
                    @php
                        $img = $product->image
                            ? asset('images/products/' . $product->image)
                            : $placeholder;
                    @endphp
                    <article class="product-card">
                        <img src="{{ $img }}" alt="{{ $product->name }}">
                        <h3 class="product-name">{{ $product->name }}</h3>
                        <p class="product-desc">
                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                        </p>
                        <div class="product-meta">
                            <div class="product-price">
                                {{ $product->formatted_price }}
                            </div>
                            <div class="product-cta-row">
                                <a href="{{ route('products.show', $product) }}" class="btn-card">Details</a>
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-card btn-card-main">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        @if(!$burgers->count() && !$snacks->count() && !$drinks->count())
            <p class="text-center text-muted mb-0">No products yet – add some items in the admin panel.</p>
        @endif
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('#catalogTabs .catalog-tab');
    var sections = document.querySelectorAll('.catalog-section');

    if (!tabs.length || !sections.length) return;

    function setActive(category) {
        tabs.forEach(function (tab) {
            tab.classList.toggle('active', tab.getAttribute('data-category') === category);
        });
        sections.forEach(function (section) {
            var matches = section.getAttribute('data-category') === category;
            section.style.display = matches ? '' : 'none';
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            setActive(tab.getAttribute('data-category'));
        });
    });

    // Default to burgers
    setActive('burgers');
});
</script>
@endsection