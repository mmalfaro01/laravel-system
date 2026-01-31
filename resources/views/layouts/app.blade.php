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
        :root {
            --tropical-orange: #FF6B35;
            --tropical-yellow: #FFD23F;
            --tropical-red: #E74C3C;
            --tropical-green: #27AE60;
            --tropical-brown: #8B4513;
            --tropical-light: #FFF8DC;
        }
        
        body {
            background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--tropical-orange) 0%, var(--tropical-red) 100%) !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
            border: none;
            font-weight: 600;
            transition: transform 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        .text-tropical {
            color: var(--tropical-orange);
        }

        .bg-tropical {
            background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
        }

        .badge {
            font-weight: 600;
        }

        footer {
            background: linear-gradient(135deg, var(--tropical-brown) 0%, #654321 100%) !important;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

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
                {{-- Cart --}}
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

                {{-- Notifications - Disabled (table doesn't exist) --}}
                {{-- @auth
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative" href="#" id="notifDropdown">
                            <i class="bi bi-bell fs-5"></i>
                        </a>
                    </li>
                @endauth --}}

                {{-- Auth --}}
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


    {{-- Content --}}
    <main class="container my-5 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </main>
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


   </body></html>
    
                