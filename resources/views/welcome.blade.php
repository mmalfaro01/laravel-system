@extends('layouts.app')

@section('content')
<style>
    .carousel-item img {
        height: 75vh;
        object-fit: cover;
        filter: brightness(0.8);
    }

    .carousel-caption {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.9), rgba(231, 76, 60, 0.9));
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    }

    .carousel-indicators [data-bs-target] {
        background-color: var(--tropical-yellow);
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid white;
    }

    .info-section {
        background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%);
        padding: 3rem 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        border: 3px solid var(--tropical-orange);
    }

    .info-section h2 {
        font-weight: 800;
        color: var(--tropical-brown);
    }

    .info-section p {
        font-size: 1.15rem;
        color: #333;
    }

    .info-section .highlight {
        color: var(--tropical-orange);
        font-weight: 700;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .link-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
    }

    .link-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(255, 107, 53, 0.3);
    }

    .link-card .btn {
        font-weight: 600;
        padding: 0.5rem 1.5rem;
        font-size: 1rem;
    }

    .burger-icon {
        font-size: 3rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<div class="container py-5">

    {{-- ✅ Auto-Sliding Hero Carousel --}}
    <div id="heroCarousel" class="carousel slide carousel-fade shadow rounded-4 overflow-hidden mb-5"
         data-bs-ride="carousel"
         data-bs-interval="4000"
         data-bs-pause="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slider/1.jpg') }}" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block text-center">
                    <i class='bx bxs-burger burger-icon' style="color: var(--tropical-yellow);"></i>
                    <h1 class="fw-bold text-white display-4">Welcome to Tropical Burger</h1>
                    <p class="fs-4">Taste the <strong>Island Paradise</strong> in Every Bite! 🌴</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg mt-3 px-5 fw-bold" style="color: var(--tropical-orange);">
                        <i class='bx bx-menu me-2'></i>Order Now
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider/2.jpg') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block text-center">
                    <h1 class="fw-bold text-white display-4">Juicy Island Burgers 🍔</h1>
                    <p class="fs-4">Crafted with Fresh Ingredients & Tropical Flavors</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider/3.jpg') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block text-center">
                    <h1 class="fw-bold text-white display-4">Fire-Grilled Perfection 🔥</h1>
                    <p class="fs-4">100% Beef Patties. Authentic Caribbean Spices.</p>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
    </div>

    {{-- 🍔 Info Section --}}
    <div class="info-section shadow-lg mb-5">
        <h2 class="text-center mb-4">
            <i class='bx bxs-hot fs-1 text-danger'></i> 
            Why Choose <span class="highlight">Tropical Burger?</span>
            <i class='bx bxs-hot fs-1 text-danger'></i>
        </h2>
        <p class="lead text-center mb-4">Experience the perfect blend of Caribbean flavors and American classics in every bite!</p>
        <p>At <span class="highlight">Tropical Burger</span>, we bring you mouthwatering burgers infused with exotic island spices and fresh tropical ingredients.</p>
        <div class="row mt-4">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="mb-3"><i class='bx bxs-cheese text-warning fs-4 me-2'></i> <strong>100% Premium Beef</strong> - No fillers, just quality</li>
                    <li class="mb-3"><i class='bx bxs-sun text-warning fs-4 me-2'></i> <strong>Tropical Marinades</strong> - Caribbean spice blends</li>
                    <li class="mb-3"><i class='bx bxs-leaf text-success fs-4 me-2'></i> <strong>Fresh Toppings</strong> - Crisp lettuce, ripe tomatoes</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="mb-3"><i class='bx bxs-flame text-danger fs-4 me-2'></i> <strong>Fire-Grilled</strong> - Smoky perfection every time</li>
                    <li class="mb-3"><i class='bx bxs-truck text-primary fs-4 me-2'></i> <strong>Fast Delivery</strong> - Hot and fresh to your door</li>
                    <li class="mb-3"><i class='bx bxs-happy-heart-eyes text-danger fs-4 me-2'></i> <strong>Satisfaction Guaranteed</strong> - Love it or it's free!</li>
        </ul>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-lg px-5 fw-bold" 
               style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); color: white; border: none; box-shadow: 0 4px 15px rgba(255,107,53,0.4);">
                <i class='bx bx-food-menu me-2'></i>View Our Menu
            </a>
        </div>
    </div>

    {{-- 🍔 Featured Burgers Section --}}
    <div class="info-section shadow-lg my-5">
        <h2 class="text-center mb-4">
            <i class='bx bxs-star text-warning fs-1'></i>
            Our Signature Burgers
            <i class='bx bxs-star text-warning fs-1'></i>
        </h2>
        <p class="text-center lead mb-5">Handcrafted masterpieces that will transport you to paradise! 🏝️</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class='bx bxs-cheese fs-1 mb-3' style="color: var(--tropical-yellow);"></i>
                        <h4 class="fw-bold text-tropical">Island Classic</h4>
                        <p class="text-muted">Juicy beef patty, cheddar cheese, fresh lettuce, tomato & our secret tropical sauce</p>
                        <span class="badge bg-warning text-dark px-3 py-2">BESTSELLER</span>
                    </div>
                </div>
                        </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class='bx bxs-hot fs-1 mb-3' style="color: var(--tropical-red);"></i>
                        <h4 class="fw-bold text-danger">Volcano Burger</h4>
                        <p class="text-muted">Spicy jalapeños, pepper jack cheese, chipotle mayo & grilled pineapple rings</p>
                        <span class="badge bg-danger px-3 py-2">SPICY! 🔥</span>
                    </div>
                </div>
                        </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body text-center p-4">
                        <i class='bx bxs-crown fs-1 mb-3' style="color: var(--tropical-orange);"></i>
                        <h4 class="fw-bold" style="color: var(--tropical-orange);">Paradise Premium</h4>
                        <p class="text-muted">Double patty, bacon, avocado, caramelized onions & honey mustard glaze</p>
                        <span class="badge bg-success px-3 py-2">PREMIUM</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-lg btn-warning fw-bold px-5 text-dark">
                <i class='bx bx-cart-add me-2 fs-5'></i>Order Your Favorite Now!
            </a>
        </div>
    </div>

    {{-- 🎬 Customer Reviews Section --}}
    <div class="info-section shadow-lg mb-5">
        <h2 class="text-center mb-4">
            <i class='bx bxs-happy-heart-eyes text-danger fs-1'></i>
            What Our Customers Say
        </h2>
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card border-0 bg-white p-4 h-100">
                    <div class="mb-3">
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                    </div>
                    <p class="fst-italic">"Best burger I've ever had! The tropical flavors are amazing!"</p>
                    <p class="text-muted small mb-0">- Maria Santos</p>
                </div>
                        </div>
            <div class="col-md-4">
                <div class="card border-0 bg-white p-4 h-100">
                    <div class="mb-3">
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                    </div>
                    <p class="fst-italic">"The Volcano Burger is fire! 🔥 Perfect spice level!"</p>
                    <p class="text-muted small mb-0">- Juan Dela Cruz</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-white p-4 h-100">
                    <div class="mb-3">
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                        <i class='bx bxs-star text-warning'></i>
                    </div>
                    <p class="fst-italic">"Fast delivery and always fresh. My family's favorite!"</p>
                    <p class="text-muted small mb-0">- Lisa Reyes</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
