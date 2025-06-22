@extends('layouts.app')

@section('content')
<style>
    .carousel-item img {
        height: 75vh;
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.65);
        border-radius: 1rem;
        padding: 2rem;
    }

    .carousel-indicators [data-bs-target] {
        background-color: #28a745;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .info-section {
        background-color: #f8f9fa;
        padding: 3rem 1.5rem;
        border-radius: 1rem;
    }

    .info-section h2 {
        font-weight: 700;
    }

    .info-section p {
        font-size: 1.1rem;
    }

    .info-section .highlight {
        color: #28a745;
        font-weight: 600;
    }

    .link-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
    }

    .link-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .link-card .btn {
        font-weight: 500;
        padding: 0.4rem 1.2rem;
        font-size: 0.95rem;
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
                    <h1 class="fw-bold text-white">Welcome to Veggie Shop</h1>
                    <p>Your trusted online source for <strong>hydroponically grown</strong> produce.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-lg mt-3 px-4">Shop Now</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider/2.jpg') }}" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block text-center">
                    <h1 class="fw-bold text-white">Grown with Innovation</h1>
                    <p>Efficient and sustainable farming powered by hydroponic systems.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider/3.jpg') }}" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block text-center">
                    <h1 class="fw-bold text-white">Fresh & Organic</h1>
                    <p>Locally grown. Zero soil. Maximum freshness.</p>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
    </div>

    {{-- 🧠 Info Section --}}
    <div class="info-section shadow-sm mb-5">
        <h2 class="text-center mb-4">Why Choose <span class="highlight">Local Hydroponic Produce?</span></h2>
        <p>Supporting hydroponically grown local produce isn’t just about freshness — it’s about making a smart,
            sustainable choice for the environment and your health.</p>
        <p>By choosing <span class="highlight">Veggie Shop</span> products, you help support local farmers and reduce emissions.</p>
        <ul>
            <li>🌱 Grown in controlled environments</li>
            <li>🚫 No harmful pesticides</li>
            <li>💧 Uses 90% less water than traditional farming</li>
            <li>🛒 Delivered fresh from smart farms to your table</li>
        </ul>
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-outline-success btn-lg">Explore Fresh Produce</a>
        </div>
    </div>

    {{-- 🎬 YouTube Carousel --}}
    <div class="info-section shadow-sm my-5">
        <h2 class="text-center mb-4">🎮 Watch Hydroponics in Action</h2>

        <div id="youtubeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <div class="mx-auto" style="max-width: 768px;">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/LGF33NN4B8U" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="mx-auto" style="max-width: 768px;">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/4LAWf9T4kRc" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="mx-auto" style="max-width: 768px;">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/2Oz_IiBxbqg" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="mx-auto" style="max-width: 768px;">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/XkDpUi6KeDo" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#youtubeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#youtubeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <div class="text-center mt-4">
                <a href="https://www.youtube.com/results?search_query=hydroponics+philippines" target="_blank" class="btn btn-outline-danger btn-lg">
                    View More on YouTube
                </a>
            </div>
        </div>
    </div>

    {{-- 🏫 Siquijor State College Highlight --}}
    <div class="info-section shadow-sm mb-5 text-center">
        <h2 class="mb-3">🏫 Innovation at <span class="highlight">Siquijor State College</span></h2>
        <p>
            Siquijor State College leads the way in local food technology with its hydroponic greenhouse initiatives — 
            bringing sustainable agriculture and education together.
        </p>
        <a href="https://siquijorstate.edu.ph/" class="btn btn-outline-success btn-lg" target="_blank">
            Visit SSC Website
        </a>
    </div>
</div>
@endsection
