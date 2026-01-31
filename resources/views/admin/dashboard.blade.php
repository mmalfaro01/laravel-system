@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    .stat-card {
        border-radius: 1rem;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    }

    .stat-icon {
        font-size: 3rem;
        opacity: 0.8;
    }

    .chart-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 3px solid var(--tropical-orange);
    }
</style>
<div class="container-fluid py-4">

    {{-- Welcome Header --}}
    <div class="alert border-0 shadow-lg mb-4" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red)); color: white;">
        <div class="d-flex align-items-center">
            <i class='bx bxs-burger' style="font-size: 4rem; margin-right: 1.5rem;"></i>
            <div>
                <h3 class="fw-bold mb-1">Welcome to Tropical Burger Admin! 🍔</h3>
                <p class="mb-0">Manage your tropical burger empire from here</p>
            </div>
        </div>
    </div>

    {{-- Top Summary Card --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card h-100" style="background: linear-gradient(135deg, #28a745, #20c997);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 opacity-75">Total Earnings</h6>
                            <h3 class="fw-bold">₱{{ number_format($earnings ?? 0, 2, '.', ',') }}</h3>
                            <small class="badge bg-light text-success">
                                ▲ {{ $growth ?? 0 }}%
                            </small>
                        </div>
                        <div>
                            <i class="bx bx-dollar stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card h-100" style="background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 opacity-75">Total Burgers</h6>
                            <h3 class="fw-bold">{{ \App\Models\Product::count() }}</h3>
                            <small class="badge bg-light text-danger">Available</small>
                        </div>
                        <div>
                            <i class='bx bxs-burger stat-icon'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card h-100" style="background: linear-gradient(135deg, #ffc107, #ff9800);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 opacity-75">Total Orders</h6>
                            <h3 class="fw-bold">{{ \App\Models\Order::count() }}</h3>
                            <small class="badge bg-light text-warning">All Time</small>
                        </div>
                        <div>
                            <i class='bx bxs-shopping-bag stat-icon'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card h-100" style="background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 opacity-75">Happy Customers</h6>
                            <h3 class="fw-bold">{{ \App\Models\User::count() }}</h3>
                            <small class="badge bg-light text-purple">Registered</small>
                        </div>
                        <div>
                            <i class='bx bxs-user-circle stat-icon'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Monthly Earnings Chart --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="chart-card">
                <h5 class="mb-4 fw-bold" style="color: var(--tropical-brown);">
                    <i class='bx bx-line-chart me-2'></i>Monthly Burger Sales
                </h5>
                <canvas id="earningsChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg h-100" style="border: 3px solid var(--tropical-orange) !important;">
                <div class="card-body text-center p-4">
                    <i class='bx bxs-food-menu' style="font-size: 4rem; color: var(--tropical-orange);"></i>
                    <h5 class="fw-bold mt-3" style="color: var(--tropical-brown);">Manage Menu</h5>
                    <p class="text-muted">Add or edit burger items</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-warning text-dark fw-semibold">
                        <i class='bx bx-edit'></i> View Products
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg h-100" style="border: 3px solid var(--tropical-green) !important;">
                <div class="card-body text-center p-4">
                    <i class='bx bxs-package' style="font-size: 4rem; color: var(--tropical-green);"></i>
                    <h5 class="fw-bold mt-3" style="color: var(--tropical-brown);">Process Orders</h5>
                    <p class="text-muted">{{ \App\Models\Order::where('status', 'pending')->count() }} pending orders</p>
                    <a href="{{ route('admin.orders') }}" class="btn btn-success fw-semibold">
                        <i class='bx bx-receipt'></i> View Orders
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg h-100" style="border: 3px solid var(--tropical-red) !important;">
                <div class="card-body text-center p-4">
                    <i class='bx bxs-user-account' style="font-size: 4rem; color: var(--tropical-red);"></i>
                    <h5 class="fw-bold mt-3" style="color: var(--tropical-brown);">Manage Users</h5>
                    <p class="text-muted">{{ \App\Models\User::count() }} registered customers</p>
                    <a href="{{ route('admin.users') }}" class="btn btn-danger fw-semibold">
                        <i class='bx bx-user'></i> View Users
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('earningsChart').getContext('2d');

    const earningsData = @json(array_values($monthlyEarnings->all()));
    const earningsLabels = @json(array_map(function($m) {
        return \Carbon\Carbon::create()->month($m)->format('F');
    }, array_keys($monthlyEarnings->all())));

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: earningsLabels,
            datasets: [{
                label: 'Monthly Burger Sales (₱)',
                data: earningsData,
                backgroundColor: 'rgba(255, 107, 53, 0.8)',
                borderColor: 'rgba(231, 76, 60, 1)',
                borderWidth: 2,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(231, 76, 60, 0.9)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#8B4513',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 107, 53, 0.1)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        },
                        color: '#8B4513',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#8B4513',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
