@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .stat-card {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 1rem;
        padding: 1rem;
        transition: border-color 0.2s;
    }
    .stat-card:hover { border-color: var(--burger-orange); }
    .stat-card h6 { color: var(--burger-muted); font-size: 0.8rem; margin-bottom: 0.25rem; }
    .stat-card h3 { color: var(--burger-white); font-weight: 800; font-size: 1.35rem; margin: 0; }
    .stat-card .stat-icon { font-size: 2rem; opacity: 0.9; }
    .chart-card {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 1rem;
        padding: 1.25rem;
    }
    .chart-card h5 { color: var(--burger-gold); font-size: 1rem; font-weight: 700; margin-bottom: 1rem; }
    .chart-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .chart-toolbar .btn {
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .chart-toolbar .btn.active {
        background: var(--burger-orange);
        color: #1a1208;
        border-color: var(--burger-orange);
    }
    .action-card {
        background: var(--burger-dark);
        border: 1px solid var(--burger-border);
        border-radius: 1rem;
        padding: 1.25rem;
        height: 100%;
        text-align: center;
        text-decoration: none;
        display: block;
        transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }
    .action-card:hover {
        border-color: var(--burger-orange);
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.25);
    }
    .action-card .action-icon { font-size: 2.5rem; margin-bottom: 0.5rem; }
    .action-card h5 { color: var(--burger-white); font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem; }
    .action-card p { color: var(--burger-muted); font-size: 0.85rem; margin-bottom: 0.75rem; }
    .action-card .btn { border-radius: 999px; font-weight: 600; font-size: 0.875rem; }
    .action-card:focus {
        outline: 2px solid var(--burger-orange);
        outline-offset: 3px;
    }
</style>

<div class="container-fluid py-3">
    <div class="d-flex align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--burger-border);">
        <i class='bx bxs-burger' style="font-size: 2rem; color: var(--burger-orange);"></i>
        <div>
            <h4 class="mb-0 fw-bold">Dashboard</h4>
            <small class="text-muted">Overview</small>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Earnings</h6>
                        <h3>₱{{ number_format($earnings ?? 0, 0, '.', ',') }}</h3>
                        @if(isset($growth))
                            <small class="text-success">▲ {{ $growth }}%</small>
                        @endif
                    </div>
                    <i class='bx bx-dollar stat-icon' style="color: #22c55e;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Products</h6>
                        <h3>{{ \App\Models\Product::count() }}</h3>
                    </div>
                    <i class='bx bxs-burger stat-icon' style="color: var(--burger-orange);"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Orders</h6>
                        <h3>{{ \App\Models\Order::count() }}</h3>
                    </div>
                    <i class='bx bxs-shopping-bag stat-icon' style="color: var(--burger-gold);"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6>Users</h6>
                        <h3>{{ \App\Models\User::count() }}</h3>
                    </div>
                    <i class='bx bxs-user-circle stat-icon' style="color: #a78bfa;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="chart-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                    <h5 class="mb-0"><i class='bx bx-line-chart me-2'></i>Products sold by period</h5>
                    <div class="chart-toolbar">
                        <button type="button" class="btn btn-outline-warning active" data-period="day">Today</button>
                        <button type="button" class="btn btn-outline-warning" data-period="week">This Week</button>
                        <button type="button" class="btn btn-outline-warning" data-period="month">This Month</button>
                        <button type="button" class="btn btn-outline-info" data-type="bar">Bar</button>
                        <button type="button" class="btn btn-outline-info" data-type="line">Line</button>
                    </div>
                </div>
                <div id="productSalesChartData" class="d-none" data-chart='{{ $productSalesChartData }}'></div>
                <canvas id="earningsChart" height="90"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="action-card">
                <i class='bx bxs-food-menu action-icon' style="color: var(--burger-orange);"></i>
                <h5>Products</h5>
                <p>Manage menu items</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-warning text-dark">Products</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="action-card">
                <i class='bx bxs-package action-icon' style="color: #22c55e;"></i>
                <h5>Orders</h5>
                <p>{{ \App\Models\Order::where('status', 'pending')->count() }} pending</p>
                <a href="{{ route('admin.orders') }}" class="btn btn-success">Orders</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="action-card">
                <i class='bx bxs-user-account action-icon' style="color: #e74c3c;"></i>
                <h5>Users</h5>
                <p>{{ \App\Models\User::count() }} registered</p>
                <a href="{{ route('admin.users') }}" class="btn btn-danger">Users</a>
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
    const chartData = JSON.parse(document.getElementById('productSalesChartData').dataset.chart);

    let currentPeriod = 'day';
    let currentType = 'bar';

    const chart = new Chart(ctx, {
        type: currentType,
        data: {
            labels: chartData[currentPeriod].labels,
            datasets: [{
                label: 'Quantity Sold',
                data: chartData[currentPeriod].values,
                backgroundColor: '#f39a12',
                borderColor: '#ff8c00',
                borderWidth: 1,
                borderRadius: 6,
                fill: false,
                tension: 0.35
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    labels: { color: '#ffffff' }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#2a2826' },
                    ticks: {
                        callback: v => v,
                        color: '#b0aeab'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#b0aeab' }
                }
            }
        }
    });

    function updatePeriod(period) {
        currentPeriod = period;
        chart.data.labels = chartData[currentPeriod].labels;
        chart.data.datasets[0].data = chartData[currentPeriod].values;
        chart.update();

        document.querySelectorAll('[data-period]').forEach(btn => btn.classList.toggle('active', btn.dataset.period === currentPeriod));
    }

    function updateChartType(type) {
        currentType = type;
        chart.config.type = currentType;
        chart.update();

        document.querySelectorAll('[data-type]').forEach(btn => btn.classList.toggle('active', btn.dataset.type === currentType));
    }

    document.querySelectorAll('[data-period]').forEach(button => {
        button.addEventListener('click', function () {
            updatePeriod(this.dataset.period);
        });
    });

    document.querySelectorAll('[data-type]').forEach(button => {
        button.addEventListener('click', function () {
            updateChartType(this.dataset.type);
        });
    });

    const periodCycle = ['day', 'week', 'month'];
    document.getElementById('earningsChart').addEventListener('click', function () {
        const currentIndex = periodCycle.indexOf(currentPeriod);
        const nextPeriod = periodCycle[(currentIndex + 1) % periodCycle.length];
        updatePeriod(nextPeriod);
    });
});
</script>
@endsection
