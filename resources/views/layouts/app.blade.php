<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Veggie Shop')</title>

    {{-- Bootstrap & Vite Assets --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
   <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}">

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/sass/sneat/core.scss',
        'resources/js/sneat/core.js'
    ])
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navigation Bar --}}
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold fs-4" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;" class="me-2">
            Veggie Shop
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

                {{-- Notifications --}}
                @auth
                    <li class="nav-item dropdown me-2">
                        @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell fs-5"></i>
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown" style="min-width: 300px;">
                            <li class="dropdown-header fw-bold">Notifications</li>
                            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                <li>
                                    <a href="{{ $notification->data['url'] ?? '#' }}" class="dropdown-item small">
                                        {{ $notification->data['message'] }}
                                        <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
                                    </a>
                                </li>
                            @empty
                                <li class="dropdown-item text-muted">No new notifications</li>
                            @endforelse
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('notifications.read') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item small text-primary text-center">Mark all as read</button>
                                </form>
                            </li>
                            <li><a href="{{ route('notifications.index') }}" class="dropdown-item small text-center">View All</a></li>
                        </ul>
                    </li>
                @endauth

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
<footer class="bg-dark text-white pt-5 pb-3 mt-auto">
    <div class="container position-relative">
        <div class="row text-center text-md-start align-items-start">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-2">Veggie Shop</h5>
                <p class="small mb-0">Your trusted source for sustainable hydroponic produce.</p>
                <p class="small">Fresh. Organic. Local.</p>
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

        <div class="row align-items-center mt-4 border-top border-secondary pt-3">
            <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-2">Follow us on:</p>
                <div class="d-flex justify-content-center justify-content-md-start gap-3">
                    <a href="https://web.facebook.com/alfaro.kazz" class="text-white" target="_blank" rel="noopener">
                        <i class="bi bi-facebook fs-4"></i>
                    </a>
                    <a href="#" class="text-white"><i class="bi bi-twitter fs-4"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin fs-4"></i></a>
                </div>
                <p class="small text-muted mt-2 mb-0">Powered by Laravel & Bootstrap</p>
                <p class="small text-muted mb-0">&copy; {{ date('Y') }} <strong>Veggie Shop</strong>. All rights reserved.</p>
            </div>

            <div class="col-md-4 d-flex justify-content-center justify-content-md-end">
                <img src="{{ asset('images/logo.png') }}" alt="Veggie Shop Logo"
                     style="max-height: 100px; opacity: 0.05;">
            </div>
        </div>
    </div>
</footer>


   </body></html>
    
                