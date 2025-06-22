@extends('layouts.app')

@section('content')
<style>
    .dashboard-icon {
        font-size: 2rem;
        padding: 1rem;
        border-radius: 50%;
        background-color: rgba(0, 128, 0, 0.1);
        color: #198754;
    }
    .dashboard-card:hover {
        box-shadow: 0 0 20px rgba(0,0,0,0.15);
        transform: scale(1.02);
        transition: all 0.3s ease-in-out;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Welcome back, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-muted">Glad to have you again. Here's a quick overview to get you started.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none text-dark">
                <div class="card dashboard-card text-center shadow-sm p-4">
                    <div class="dashboard-icon mx-auto mb-3">
                        <i class="bx bx-store"></i>
                    </div>
                    <h5 class="fw-bold">Browse Products</h5>
                    <p class="text-muted small">Check out fresh and organic hydroponic items.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('cart.index') }}" class="text-decoration-none text-dark">
                <div class="card dashboard-card text-center shadow-sm p-4">
                    <div class="dashboard-icon mx-auto mb-3 bg-warning text-white">
                        <i class="bx bx-cart-alt"></i>
                    </div>
                    <h5 class="fw-bold">View Cart</h5>
                    <p class="text-muted small">Ready to checkout? Review your cart items.</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('orders.index') }}" class="text-decoration-none text-dark">
                <div class="card dashboard-card text-center shadow-sm p-4">
                    <div class="dashboard-icon mx-auto mb-3 bg-primary text-white">
                        <i class="bx bx-receipt"></i>
                    </div>
                    <h5 class="fw-bold">My Orders</h5>
                    <p class="text-muted small">Track your orders and delivery status.</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
