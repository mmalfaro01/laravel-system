@extends('layouts.app')

@section('content')
<style>
    .dashboard-icon {
        font-size: 2.5rem;
        padding: 1.5rem;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
        color: white;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }
    .dashboard-card {
        border: 3px solid transparent;
        background: white;
        transition: all 0.4s ease-in-out;
    }
    .dashboard-card:hover {
        border-color: var(--tropical-orange);
        box-shadow: 0 8px 30px rgba(255, 107, 53, 0.3);
        transform: translateY(-10px);
    }
    .welcome-banner {
        background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
        color: white;
        padding: 3rem;
        border-radius: 1.5rem;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
</style>

<div class="container py-5">
    <div class="welcome-banner text-center mb-5">
        <i class='bx bxs-burger display-1 mb-3'></i>
        <h2 class="fw-bold display-5">Welcome back, {{ Auth::user()->name }}! 🎉</h2>
        <p class="fs-5 mb-0">Ready for some amazing tropical burgers? Let's get started!</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center shadow-lg p-4 h-100">
                    <div class="dashboard-icon mx-auto mb-3">
                        <i class='bx bxs-food-menu'></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">Browse Menu</h5>
                    <p class="text-muted small">Explore our delicious tropical burger selection!</p>
                    <span class="badge bg-warning text-dark mt-2">🔥 Hot Items</span>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('cart.index') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center shadow-lg p-4 h-100">
                    <div class="dashboard-icon mx-auto mb-3" style="background: linear-gradient(135deg, #FFD23F, #FFA500);">
                        <i class='bx bxs-cart'></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">My Cart</h5>
                    <p class="text-muted small">Review your selected burgers before checkout.</p>
                    <span class="badge bg-success text-white mt-2">🛒 Ready to Order</span>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="card dashboard-card text-center shadow-lg p-4 h-100">
                    <div class="dashboard-icon mx-auto mb-3" style="background: linear-gradient(135deg, #E74C3C, #C0392B);">
                        <i class='bx bxs-package'></i>
                    </div>
                    <h5 class="fw-bold" style="color: var(--tropical-brown);">My Orders</h5>
                    <p class="text-muted small">Track your burger deliveries in real-time!</p>
                    <span class="badge bg-danger text-white mt-2">🚚 Track Now</span>
                </div>
            </a>
        </div>
    </div>

    {{-- Quick Stats Banner --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%); border: 3px solid var(--tropical-orange);">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-center mb-4" style="color: var(--tropical-brown);">
                        <i class='bx bxs-offer me-2'></i>Today's Special Offers!
                    </h5>
                    <div class="row text-center">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <i class='bx bxs-discount fs-1 mb-2' style="color: var(--tropical-orange);"></i>
                            <p class="mb-0 fw-bold">20% OFF</p>
                            <small class="text-muted">On Double Burgers</small>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <i class='bx bxs-truck fs-1 mb-2' style="color: var(--tropical-green);"></i>
                            <p class="mb-0 fw-bold">FREE DELIVERY</p>
                            <small class="text-muted">Orders over ₱500</small>
                        </div>
                        <div class="col-md-4">
                            <i class='bx bxs-drink fs-1 mb-2' style="color: var(--tropical-red);"></i>
                            <p class="mb-0 fw-bold">FREE DRINK</p>
                            <small class="text-muted">With combo meals</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
