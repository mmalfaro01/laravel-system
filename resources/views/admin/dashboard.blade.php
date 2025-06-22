@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">

    {{-- Top Summary Card --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Total Earnings</h6>
                            <h3 class="fw-bold">₱{{ number_format($earnings ?? 0, 2, '.', ',') }}</h3>
                            <small class="text-success">
                                ▲ {{ $growth ?? 0 }}%
                            </small>
                        </div>
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="bx bx-dollar fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Monthly Earnings Chart --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Monthly Earnings Chart</h5>
                    <canvas id="earningsChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- System Status Cards --}}
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-primary">Products Available</h5>
                    <p class="display-6">{{ \App\Models\Product::count() }}</p>
                    <small class="text-muted">Fresh & Organic</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-success">Orders Completed</h5>
                    <p class="display-6">{{ \App\Models\Order::where('status', 'completed')->count() }}</p>
                    <small class="text-muted">Happy Customers</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-warning">Users Registered</h5>
                    <p class="display-6">{{ \App\Models\User::count() }}</p>
                    <small class="text-muted">Join our community</small>
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
                label: 'Monthly Earnings (₱)',
                data: earningsData,
                backgroundColor: 'rgba(25, 135, 84, 0.7)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
