<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Tropical Burger - Island Flavor Burgers')</title>

    {{-- Bootstrap & Vite Assets --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}?v={{ time() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/sass/sneat/core.scss',
        'resources/js/sneat/core.js'
    ])

    <style>
        /* Design system: black, pitch black, orange, burger gold – applied site-wide */
        :root {
            --burger-pitch: #050303;
            --burger-black: #0a0806;
            --burger-dark: #1a1a1a;
            --burger-orange: #f39a12;
            --burger-orange-bright: #ff8c00;
            --burger-gold: #ffcb72;
            --burger-white: #ffffff;
            --burger-muted: #b0aeab;
            --burger-border: #2a2826;
            /* Legacy names for other views */
            --tropical-orange: #f39a12;
            --tropical-yellow: #ffcb72;
            --tropical-red: #e74c3c;
            --tropical-brown: #1a1a1a;
            --tropical-light: #ffcb72;
            /* Auth pages: medium blue for headings and signup link */
            --auth-accent: #4a90d9;
        }

        body {
            background: var(--burger-pitch);
            color: var(--burger-white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body a {
            color: var(--burger-white);
        }

        body a:hover {
            color: var(--burger-gold);
        }

        body.home-landing {
            background: var(--burger-orange);
        }

        .navbar {
            background: var(--burger-black) !important;
            border-bottom: 2px solid var(--burger-orange);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        .navbar .nav-link {
            color: var(--burger-muted);
        }

        .navbar .nav-link:hover,
        .navbar .navbar-brand {
            color: var(--burger-white);
        }

        .navbar .navbar-brand i {
            color: var(--burger-gold);
        }

        .btn-primary {
            background: var(--burger-orange);
            border: none;
            color: #1a1208;
            font-weight: 700;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            background: var(--burger-orange-bright);
            color: #1a1208;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px #664409;
        }

        .btn-outline-primary {
            border-color: var(--burger-orange);
            color: var(--burger-orange);
        }

        .btn-outline-primary:hover {
            background: var(--burger-orange);
            color: #1a1208;
        }

        .card {
            background: var(--burger-dark);
            border: 1px solid var(--burger-border);
            border-radius: 1rem;
            color: var(--burger-white);
            transition: all 0.3s;
        }

        .card:hover {
            border-color: #b8730e;
            box-shadow: 0 8px 24px #000;
        }

        .card .text-muted {
            color: var(--burger-muted) !important;
        }

        .text-tropical, .text-warning {
            color: var(--burger-gold) !important;
        }

        .bg-tropical {
            background: var(--burger-orange);
        }

        .badge {
            font-weight: 600;
        }

        .badge.bg-warning {
            background: var(--burger-orange) !important;
            color: #1a1208;
        }

        footer {
            background: var(--burger-pitch) !important;
            border-top: 2px solid var(--burger-orange);
        }

        footer h5, footer h6 {
            color: var(--burger-white);
        }

        footer .text-light, footer .small {
            color: var(--burger-muted) !important;
        }

        footer a:hover {
            color: var(--burger-gold);
        }

        /* Alerts and form controls on dark */
        .alert-success {
            background: #1a3320;
            border-color: var(--burger-orange);
            color: var(--burger-white);
        }

        .form-control, .form-select {
            background: var(--burger-dark);
            border-color: var(--burger-border);
            color: var(--burger-white);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--burger-orange);
            box-shadow: 0 0 0 0.2rem #3d2a0a;
        }

        .form-control::placeholder {
            color: var(--burger-muted);
        }

        .table {
            color: var(--burger-white);
        }

        .table-light {
            background: var(--burger-dark);
            color: var(--burger-white);
        }
    </style>
</head>
@php
    $isHomeLanding = request()->is('/');
@endphp

<body class="d-flex flex-column min-vh-100 {{ $isHomeLanding ? 'home-landing' : '' }}">

    @unless($isHomeLanding)
        {{-- Navigation Bar --}}
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center fw-bold fs-3" href="{{ route('home') }}">
                    <i class='bx bxs-burger fs-2 me-2' style="color: var(--tropical-yellow);"></i>
                    <span style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Tropical Burger</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('products.index') }}">Products</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item me-2">
                            <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart fs-5"></i>
                                @php
                                    $cart = session()->get('cart', []);
                                    $cartCount = array_sum(array_column($cart, 'quantity'));
                                @endphp
                                @if($cartCount)
                                    <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        </li>

                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">My Orders</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile.show') }}">My Profile</a></li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link text-decoration-none">Logout</button>
                                </form>
                            </li>
                            @if(auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link text-warning fw-semibold" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                </li>
                            @endif
                        @endauth

                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    @endunless

    <main class="{{ $isHomeLanding ? 'flex-grow-1 p-0' : 'container my-4 flex-grow-1' }}">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show {{ $isHomeLanding ? 'm-3 position-fixed top-0 end-0 shadow z-3' : '' }}">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show {{ $isHomeLanding ? 'm-3 position-fixed top-0 end-0 shadow z-3' : '' }}">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </main>

    @unless($isHomeLanding)
        {{-- Footer --}}
        <footer class="text-white pt-5 pb-3 mt-auto">
            <div class="container position-relative">
                <div class="row text-center text-md-start align-items-start">
                    <div class="col-md-4 mb-4">
                        <h5 class="fw-bold mb-2 d-flex align-items-center">
                            <i class='bx bxs-burger fs-3 me-2' style="color: var(--tropical-yellow);"></i>
                            Tropical Burger
                        </h5>
                        <p class="small mb-0">Experience Island Flavors in Every Bite!</p>
                        <p class="small">Juicy. Tropical. Delicious.</p>
                    </div>

                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-2">Quick Links</h6>
                        <ul class="list-unstyled small">
                            <li><a href="{{ route('products.index') }}" class="text-white text-decoration-none">Browse Products</a></li>
                            <li><a href="{{ route('cart.index') }}" class="text-white text-decoration-none">My Cart</a></li>
                            <li><a href="{{ route('orders.index') }}" class="text-white text-decoration-none">My Orders</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-2">Company</h6>
                        <ul class="list-unstyled small">
                            <li><a href="{{ route('about') }}" class="text-white text-decoration-none">About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="text-white text-decoration-none">Contact</a></li>
                            <li><a href="{{ route('privacy') }}" class="text-white text-decoration-none">Privacy Policy</a></li>
                            <li><a href="{{ route('faq.index') }}" class="text-white text-decoration-none">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row align-items-center mt-4 border-top border-secondary pt-4">
                    <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-2 fw-bold">📍 Siquijor's Best Burgers!</p>
                        <p class="small text-light mb-2">Poblacion, Siquijor, Siquijor 6226, Philippines | +63 912 345 6789</p>
                        <p class="mb-2">Follow us on:</p>
                        <div class="d-flex justify-content-center justify-content-md-start gap-3">
                            <a href="#" class="text-white" title="Facebook">
                                <i class="bi bi-facebook fs-4"></i>
                            </a>
                            <a href="#" class="text-white" title="Instagram"><i class="bi bi-instagram fs-4"></i></a>
                            <a href="#" class="text-white" title="TikTok"><i class="bi bi-tiktok fs-4"></i></a>
                            <a href="#" class="text-white" title="Email"><i class="bi bi-envelope-fill fs-4"></i></a>
                        </div>
                        <p class="small text-light mt-3 mb-0">&copy; {{ date('Y') }} <strong>Tropical Burger Siquijor</strong>. All rights reserved.</p>
                        <p class="small text-light mb-0">Made with 🍔 and 🌴 in Siquijor Island</p>
                    </div>

                    <div class="col-md-4 d-flex justify-content-center justify-content-md-end">
                        <i class='bx bxs-burger' style="font-size: 100px; opacity: 0.15; color: var(--tropical-yellow);"></i>
                    </div>
                </div>
            </div>
        </footer>
    @endunless


   </body></html>
    
                