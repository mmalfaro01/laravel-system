@extends('layouts.app')

@section('title', 'About Us - Tropical Burger Siquijor')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <i class='bx bxs-burger display-1 mb-3' style="color: var(--tropical-orange);"></i>
        <h1 class="display-4 fw-bold" style="color: var(--tropical-brown);">About Tropical Burger</h1>
        <p class="lead" style="color: var(--tropical-orange);">🌴 Siquijor's Premier Island Burger Experience 🍔</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3 class="fw-bold mb-3" style="color: var(--tropical-brown);">Our Story</h3>
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
            {{-- Embedded Google Map of Siquijor --}}
            <div class="ratio ratio-4x3 rounded shadow-lg" style="border: 5px solid var(--tropical-orange);">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126060.85824753842!2d123.48687032763673!3d9.213618587999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33ab3f51cf8ecc9d%3A0x72ea7c6769d3c3e8!2sSiquijor%2C%20Philippines!5e0!3m2!1sen!2sph!4v1734438000000!5m2!1sen!2sph" 
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-lg mb-5" style="background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%); border: 3px solid var(--tropical-orange) !important;">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4" style="color: var(--tropical-brown);">
                <i class='bx bxs-map me-2' style="color: var(--tropical-orange);"></i>Visit Us in Paradise
            </h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">📍 Location</h5>
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
                        <li><i class='bx bx-time me-2' style="color: var(--tropical-orange);"></i>Monday – Sunday</li>
                        <li class="ms-4">10:00 AM – 10:00 PM</li>
                        <li class="mt-2 text-muted small">
                            <i class='bx bx-party me-1'></i>Open Daily! Serving you island time and beyond
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">📞 Contact</h5>
                    <p class="mb-0">
                        <i class='bx bx-phone me-2' style="color: var(--tropical-green);"></i>+63 912 345 6789<br>
                        <i class='bx bx-envelope me-2' style="color: var(--tropical-green);"></i>hello@tropicalburger.ph<br>
                        <i class='bx bxl-facebook-circle me-2' style="color: var(--tropical-green);"></i>@TropicalBurgerSiquijor
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">🌊 Why Siquijor?</h5>
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
            <div class="card h-100 border-0 shadow-sm" style="border: 2px solid var(--tropical-orange) !important;">
                <div class="card-body">
                    <i class='bx bxs-leaf display-3 mb-3' style="color: var(--tropical-green);"></i>
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">Fresh Ingredients</h5>
                    <p>We use locally-sourced fresh produce and premium meats to ensure every burger is packed with flavor and quality.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="card h-100 border-0 shadow-sm" style="border: 2px solid var(--tropical-orange) !important;">
                <div class="card-body">
                    <i class='bx bxs-heart display-3 mb-3' style="color: var(--tropical-red);"></i>
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">Made with Love</h5>
                    <p>Every burger is handcrafted with care and passion by our dedicated team who love what they do.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="card h-100 border-0 shadow-sm" style="border: 2px solid var(--tropical-orange) !important;">
                <div class="card-body">
                    <i class='bx bxs-sun display-3 mb-3' style="color: var(--tropical-yellow);"></i>
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">Island Vibes</h5>
                    <p>Enjoy your meal in our tropical-themed restaurant with a relaxed, friendly atmosphere that captures Siquijor's spirit.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-lg px-5 py-3 fw-bold text-white shadow-lg" 
           style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); border: none; font-size: 1.2rem;">
            <i class='bx bxs-food-menu me-2'></i>View Our Menu
        </a>
    </div>
</div>
@endsection
