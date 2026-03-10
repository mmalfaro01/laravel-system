@extends('layouts.app')

@section('title', 'Tropical Burger | Home')

@section('content')
<style>
    /* Same palette as layout: pitch black, black, orange, burger gold */
    .fullscreen-landing {
        min-height: 100vh;
        background: var(--burger-orange);
        padding: 1rem;
        display: flex;
        align-items: stretch;
        justify-content: center;
    }

    .landing-shell {
        position: relative;
        width: 100%;
        min-height: calc(100vh - 2rem);
        border-radius: 1.8rem;
        overflow: hidden;
        background: linear-gradient(180deg, var(--burger-black) 0%, var(--burger-pitch) 100%);
        color: var(--burger-white);
        box-shadow: 0 30px 80px #000;
        border: 1px solid #2a2826;
    }

    .landing-shell::before {
        content: "BURGERS";
        position: absolute;
        top: 4.5rem;
        left: 1.5rem;
        font-size: clamp(4rem, 18vw, 11rem);
        line-height: 0.9;
        font-weight: 900;
        letter-spacing: 0.04em;
        color: var(--burger-white);
        opacity: 1;
        z-index: 0;
        pointer-events: none;
    }

    .landing-inner {
        position: relative;
        z-index: 2;
        min-height: calc(100vh - 2rem);
        display: flex;
        flex-direction: column;
        padding: 1.1rem 1.15rem 1.3rem;
    }

    .landing-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .landing-brand {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.8rem;
        height: 2.8rem;
        border-radius: 999px;
        background: #1c1b19;
        border: 1px solid #2a2826;
        color: var(--burger-white);
        font-size: 1.2rem;
    }

    .landing-nav {
        display: none;
        align-items: center;
        gap: 1.5rem;
        font-size: 0.74rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .landing-nav a:hover {
        color: var(--burger-white);
    }

    .landing-tools {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        font-size: 1rem;
        color: var(--burger-muted);
    }

    .landing-tools a,
    .landing-tools button {
        color: inherit;
    }

    .landing-cart-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        background: var(--tropical-red);
        color: var(--burger-white);
        font-size: 0.65rem;
        min-width: 1.1rem;
        height: 1.1rem;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .landing-tools .position-relative {
        position: relative;
    }

    .landing-mobile-nav a:hover {
        opacity: 0.9;
    }

    .carousel-arrow-btn {
        cursor: pointer;
        color: var(--burger-muted);
        font-size: 1.35rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-arrow-btn:hover {
        color: var(--burger-white);
    }

    .footer-dot {
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 999px;
        background: #5a5856;
        border: none;
        padding: 0;
        cursor: pointer;
        transition: background 0.2s;
    }

    .footer-dot.active,
    .footer-dot:hover {
        background: var(--burger-white);
    }

    .landing-body {
        flex: 1;
        display: grid;
        gap: 1rem;
        align-items: center;
        padding-top: 1rem;
    }

    .landing-copy {
        max-width: 18rem;
    }

    .landing-copy .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        color: var(--burger-gold);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.11em;
        margin-bottom: 1rem;
    }

    .landing-copy h1 {
        font-size: clamp(2rem, 7vw, 3.2rem);
        line-height: 0.98;
        font-weight: 900;
        margin-bottom: 0.8rem;
        color: var(--burger-white);
    }

    .landing-copy p,
    .promo-card p,
    .floating-item small,
    .landing-footer {
        color: var(--burger-muted);
    }

    .landing-copy .subcopy {
        max-width: 14rem;
        margin-bottom: 1rem;
    }

    .action-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.78rem 1.15rem;
        border-radius: 999px;
        font-weight: 800;
        text-decoration: none;
        margin-right: 0.65rem;
        margin-top: 0.65rem;
    }

    .action-pill.primary {
        background: var(--burger-orange);
        color: #1a1208;
    }

    .action-pill.primary:hover {
        background: var(--burger-orange-bright);
        color: #1a1208;
    }

    .action-pill.secondary {
        border: 1px solid #2a2826;
        color: var(--burger-white);
    }

    .landing-social {
        display: none;
        position: absolute;
        left: 1.2rem;
        bottom: 1.2rem;
        z-index: 3;
        gap: 0.9rem;
        flex-direction: column;
        color: var(--burger-muted);
    }

    .hero-visual {
        position: relative;
        min-height: 260px;
        display: flex;
        align-items: end;
        justify-content: center;
    }

    .hero-visual img {
        width: 100%;
        max-width: 520px;
        object-fit: contain;
        position: relative;
        z-index: 2;
        filter: drop-shadow(0 38px 40px #000);
    }

    .hero-visual::after {
        content: "";
        position: absolute;
        bottom: 0.6rem;
        left: 50%;
        transform: translateX(-50%);
        width: 68%;
        height: 26px;
        border-radius: 999px;
        background: var(--burger-pitch);
        opacity: 1;
        filter: blur(20px);
    }

    .promo-rail {
        display: grid;
        gap: 0.95rem;
        align-self: center;
    }

    .promo-card,
    .floating-item {
        background: var(--burger-dark);
        border: 1px solid #2a2826;
        border-radius: 1.2rem;
        padding: 0.9rem;
    }

    .promo-card {
        max-width: 14rem;
        transition: transform 0.2s, border-color 0.2s;
    }

    .promo-card:hover {
        transform: translateY(-2px);
        border-color: #b8730e;
    }

    .promo-card h3,
    .floating-item h3 {
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 0.35rem;
        color: var(--burger-white);
    }

    .promo-card .price,
    .floating-item .price {
        color: var(--burger-gold);
        font-weight: 800;
    }

    .promo-card img,
    .floating-item img {
        width: 100%;
        object-fit: contain;
        display: block;
    }

    .promo-card img {
        height: 90px;
        margin-bottom: 0.65rem;
    }

    .floating-carousel {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        display: none;
        gap: 0.9rem;
        align-items: center;
    }


    .floating-item {
        width: 100px;
        padding: 0.7rem;
        text-align: center;
    }

    .floating-item img {
        height: 58px;
        margin-bottom: 0.45rem;
    }

    .landing-footer {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.7rem;
        font-size: 0.82rem;
        margin-top: 0.75rem;
    }

    .footer-dots {
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    @media (min-width: 992px) {
        .fullscreen-landing {
            padding: 0.85rem;
        }

        .landing-shell,
        .landing-inner {
            min-height: calc(100vh - 1.7rem);
        }

        .landing-nav {
            display: flex;
        }

        .landing-social,
        .floating-carousel {
            display: flex;
        }

        .landing-body {
            grid-template-columns: 230px minmax(0, 1fr) 170px;
            gap: 1.5rem;
            padding: 0 5rem 0 3.8rem;
        }

        .landing-copy {
            padding-bottom: 3rem;
        }

        .landing-shell::before {
            top: 4.7rem;
            left: 4.8rem;
        }

        .landing-footer {
            flex-direction: row;
            justify-content: center;
            gap: 2.5rem;
        }
    }
</style>

@php
    $menuRoute = route('products.index');
    $primaryBurger = 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=900&q=80';
    $secondaryBurger = 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?auto=format&fit=crop&w=800&q=80';
    $tertiaryBurger = 'https://images.unsplash.com/photo-1550317138-10000687a72b?auto=format&fit=crop&w=800&q=80';
    $quaternaryBurger = 'https://images.unsplash.com/photo-1594212699903-ec8a3eca50f5?auto=format&fit=crop&w=800&q=80';
    $heroSlides = [$primaryBurger, $secondaryBurger, $quaternaryBurger];
@endphp

<div class="fullscreen-landing" id="landingPage" data-hero-slides="{{ json_encode($heroSlides) }}">
    <section class="landing-shell">
        <div class="landing-inner">
            <div class="landing-topbar">
                <a href="{{ route('home') }}" class="landing-brand text-decoration-none">
                    <i class="bx bxs-burger"></i>
                </a>

                <nav class="landing-nav">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">HOME</a>
                    <a href="{{ route('products.index') }}" class="text-white text-decoration-none">BURGERS</a>
                    <a href="{{ route('products.index') }}" class="text-white text-decoration-none">SNACKS</a>
                    <a href="{{ route('products.index') }}" class="text-white text-decoration-none">DRINKS</a>
                    <a href="{{ route('contact') }}" class="text-white text-decoration-none">CONTACT</a>
                </nav>

                <div class="landing-tools">
                    <a href="{{ route('cart.index') }}" class="text-white text-decoration-none position-relative" title="Cart">
                        <i class="bi bi-bag"></i>
                        @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                        @if($cartCount)
                            <span class="landing-cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="#" class="text-white text-decoration-none" title="Share" aria-label="Share"><i class="bi bi-share"></i></a>
                    <button type="button" class="landing-menu-btn border-0 bg-transparent text-white p-0" aria-label="Menu" data-bs-toggle="collapse" data-bs-target="#landingMobileNav">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div class="collapse" id="landingMobileNav">
                <div class="landing-mobile-nav py-3">
                    <a href="{{ route('home') }}" class="d-block text-white py-2">Home</a>
                    <a href="{{ route('products.index') }}" class="d-block text-white py-2">Burgers</a>
                    <a href="{{ route('products.index') }}" class="d-block text-white py-2">Snacks</a>
                    <a href="{{ route('products.index') }}" class="d-block text-white py-2">Drinks</a>
                    <a href="{{ route('contact') }}" class="d-block text-white py-2">Contact</a>
                    <a href="{{ route('cart.index') }}" class="d-block text-white py-2">Cart</a>
                    @guest
                        <a href="{{ route('login') }}" class="d-block text-white py-2">Log in</a>
                        <a href="{{ route('register') }}" class="d-block text-white py-2">Sign up</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="d-block text-white py-2">My Orders</a>
                        <a href="{{ route('profile.show') }}" class="d-block text-white py-2">Profile</a>
                    @endguest
                </div>
            </div>

            <div class="landing-body">
                <div class="landing-copy">
                    <span class="eyebrow">Fried chicken burger</span>
                    <h1 class="text-uppercase">Fried Chicken Burger</h1>
                    <p class="subcopy text-uppercase">Tropical Burger's Special Fried Chicken Burgers</p>

                    <a href="{{ $menuRoute }}" class="action-pill primary">
                        ADD TO BAG
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="action-pill secondary">Log in</a>
                        <a href="{{ route('register') }}" class="action-pill secondary">Sign up</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="action-pill secondary">My orders</a>
                    @endguest
                </div>

                <div class="hero-visual">
                    <img id="heroSlideImg" src="{{ $primaryBurger }}" alt="Fried Chicken Burger" class="hero-slide-img">
                </div>

                <div class="promo-rail">
                    <a href="{{ $menuRoute }}" class="promo-card text-decoration-none text-white">
                        <img src="{{ $secondaryBurger }}" alt="Garden Gourmet">
                        <h3>Garden Gourmet</h3>
                        <p class="mb-2">Fresh premium layers and a smooth house sauce.</p>
                        <span class="price">Rs 539.00</span>
                    </a>
                    <a href="{{ $menuRoute }}" class="promo-card text-decoration-none text-white">
                        <img src="{{ $tertiaryBurger }}" alt="Classic Beef">
                        <h3>Classic Beef</h3>
                        <p class="mb-2">Smoky beef patty with crisp texture.</p>
                        <span class="price">Rs 429.00</span>
                    </a>
                </div>
            </div>

            <div class="floating-carousel">
                <button type="button" class="carousel-arrow-btn border-0 bg-transparent text-white p-0" id="heroPrev" aria-label="Previous">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="carousel-arrow-btn border-0 bg-transparent text-white p-0" id="heroNext" aria-label="Next">
                    <i class="bi bi-chevron-right"></i>
                </button>
                <a href="{{ $menuRoute }}" class="floating-item text-decoration-none text-white">
                    <img src="{{ $secondaryBurger }}" alt="Garden Gourmet">
                    <h3>Garden</h3>
                    <small class="price">Rs 539</small>
                </a>
                <a href="{{ $menuRoute }}" class="floating-item text-decoration-none text-white">
                    <img src="{{ $quaternaryBurger }}" alt="Spicy">
                    <h3>Spicy</h3>
                    <small class="price">Rs 539</small>
                </a>
            </div>

            <div class="landing-social">
                <a href="#" class="text-white" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            </div>

            <div class="landing-footer">
                <span class="text-uppercase">Tropical Burger's Special Fried Chicken Burgers</span>
                <div class="footer-dots" id="heroDots" role="tablist">
                    <button type="button" role="tab" class="footer-dot active" data-slide="0" aria-label="Slide 1"></button>
                    <button type="button" role="tab" class="footer-dot" data-slide="1" aria-label="Slide 2"></button>
                    <button type="button" role="tab" class="footer-dot" data-slide="2" aria-label="Slide 3"></button>
                </div>
                <span id="heroCounter">01 / 03</span>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    var el = document.getElementById('landingPage');
    var slides = el && el.getAttribute('data-hero-slides') ? JSON.parse(el.getAttribute('data-hero-slides')) : [];
    var current = 0;
    var img = document.getElementById('heroSlideImg');
    var counter = document.getElementById('heroCounter');
    var dots = document.querySelectorAll('.footer-dot');
    if (!img || !slides.length) return;

    function goTo(i) {
        current = (i + slides.length) % slides.length;
        img.src = slides[current];
        img.alt = 'Slide ' + (current + 1);
        if (counter) counter.textContent = String(current + 1).padStart(2, '0') + ' / ' + String(slides.length).padStart(2, '0');
        dots.forEach(function (d, j) {
            d.classList.toggle('active', j === current);
        });
    }

    document.getElementById('heroPrev')?.addEventListener('click', function () { goTo(current - 1); });
    document.getElementById('heroNext')?.addEventListener('click', function () { goTo(current + 1); });
    dots.forEach(function (d, i) {
        d.addEventListener('click', function () { goTo(i); });
    });
})();
</script>
@endsection
