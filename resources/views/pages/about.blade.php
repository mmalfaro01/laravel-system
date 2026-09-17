@extends('layouts.app')

@section('title', 'About Us - Tropical Burger Siquijor')

@section('content')
<style>
    .about-title {
        color: var(--burger-white);
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    }

    .about-lead {
        color: var(--burger-muted);
    }

    .about-section-title {
        color: var(--burger-gold);
    }

    .about-card,
    .about-feature-card {
        background: var(--burger-dark);
        border-radius: 1.25rem;
        border: 1px solid var(--burger-border);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.7);
    }

    .about-feature-card h5 {
        color: var(--burger-gold);
    }

    .about-feature-card p {
        color: var(--burger-muted);
    }

    .about-highlight {
        background: rgba(243, 154, 18, 0.08);
        border-left: 4px solid var(--burger-orange);
        border-radius: 1rem;
        color: var(--burger-muted);
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <i class='bx bxs-burger display-1 mb-3' style="color: var(--tropical-orange);"></i>
        <h1 class="display-4 fw-bold about-title">About Tropical Burger</h1>
        <p class="lead about-lead">🌴 Siquijor's Premier Island Burger Experience 🍔</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3 class="fw-bold mb-3 about-section-title">Our Story</h3>
            <p>
                Welcome to <strong>Tropical Burger</strong>, Siquijor's most beloved burger destination! Nestled in the heart of this enchanting island paradise, 
                we bring you the perfect fusion of American comfort food with vibrant tropical flavors that capture the essence of island living.
            </p>
            <p>
                Since our opening, we've been dedicated to serving fresh, high-quality burgers made with premium ingredients sourced locally whenever possible. 
                Our secret? A passion for great food and the island's natural bounty of fresh produce, herbs, and tropical fruits that add that special 
                "Siquijor magic" to every bite.
            </p>
            <p>
                Whether you're a local islander, a tourist exploring our mystical shores, or a diver taking a break from the beautiful coral reefs, 
                Tropical Burger is your go-to spot for delicious, satisfying meals in a relaxed, island-style atmosphere.
            </p>
        </div>
        <div class="col-md-6">
            {{-- Embedded Google Map / Street View provided by user --}}
            <div class="ratio ratio-4x3 rounded shadow-lg" style="border: 5px solid var(--burger-orange);">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1780225741150!6m8!1m7!1sf3Mxf00T3DHvj9CxPsIK-w!2m2!1d9.213560589120979!2d123.5019524607573!3f301.51896349172034!4f1.2163060365165563!5f0.7820865974627469"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg mb-5 about-card">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4 about-section-title">
                <i class='bx bxs-map me-2' style="color: var(--burger-orange);"></i>Visit Us in Paradise
            </h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold about-section-title">📍 Location</h5>
                    <p class="mb-1">
                        <strong>Tropical Burger Siquijor</strong><br>
                        Poblacion, Siquijor, Siquijor<br>
                        6226 Philippines
                    </p>
                    <p class="text-muted small">
                        <i class='bx bx-info-circle me-1'></i>Located near the town center, just minutes from beautiful beaches!
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">🕒 Operating Hours</h5>
                    <ul class="list-unstyled mb-0">
                        <li><i class='bx bx-time me-2' style="color: var(--burger-orange);"></i>Monday – Sunday</li>
                        <li class="ms-4">10:00 AM – 10:00 PM</li>
                        <li class="mt-2 text-muted small">
                            <i class='bx bx-party me-1'></i>Open Daily! Serving you island time and beyond
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold about-section-title">📞 Contact</h5>
                    <p class="mb-0">
                        <i class='bx bx-phone me-2' style="color: var(--tropical-green);"></i>+63 912 345 6789<br>
                        <i class='bx bx-envelope me-2' style="color: var(--tropical-green);"></i>hello@tropicalburger.ph<br>
                        <i class='bx bxl-facebook-circle me-2' style="color: var(--tropical-green);"></i>@TropicalBurgerSiquijor
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold about-section-title">🌊 Why Siquijor?</h5>
                    <p class="mb-0 small">
                        Siquijor is known for its pristine beaches, mystical waterfalls, and enchanting caves. 
                        After exploring the island's wonders, refuel with our delicious tropical burgers!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 text-center mb-4">
            <div class="card h-100 border-0 shadow-sm about-feature-card">
                <div class="card-body">
                    <i class='bx bxs-leaf display-3 mb-3' style="color: var(--tropical-green);"></i>
                    <h5 class="fw-bold">Fresh Ingredients</h5>
                    <p>We use locally-sourced fresh produce and premium meats to ensure every burger is packed with flavor and quality.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="card h-100 border-0 shadow-sm about-feature-card">
                <div class="card-body">
                    <i class='bx bxs-heart display-3 mb-3' style="color: var(--tropical-red);"></i>
                    <h5 class="fw-bold">Made with Love</h5>
                    <p>Every burger is handcrafted with care and passion by our dedicated team who love what they do.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="card h-100 border-0 shadow-sm about-feature-card">
                <div class="card-body">
                    <i class='bx bxs-sun display-3 mb-3' style="color: var(--tropical-yellow);"></i>
                    <h5 class="fw-bold">Island Vibes</h5>
                    <p>Enjoy your meal in our tropical-themed restaurant with a relaxed, friendly atmosphere that captures Siquijor's spirit.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-lg px-5 py-3 fw-bold text-white shadow-lg" 
           style="background: linear-gradient(135deg, var(--burger-orange), #ff6b3d); border: none; border-radius: 999px; font-size: 1.2rem;">
            <i class='bx bxs-food-menu me-2'></i>View Our Menu
        </a>
    </div>
</div>
@endsection
