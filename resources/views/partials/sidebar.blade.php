<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .nav-link.active {
            font-weight: bold;
            background-color: #e9ecef;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar bg-white shadow-sm p-3">
        <h4 class="mb-4">Admin - Veggie Shop</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    🏠 Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products') }}" class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                    🛍️ Products
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories') }}" class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    📂 Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.attributes') }}" class="nav-link {{ request()->routeIs('admin.attributes') ? 'active' : '' }}">
                    🔖 Attributes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    📦 Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    👤 Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.store') }}" class="nav-link {{ request()->routeIs('admin.store') ? 'active' : '' }}">
                    🌐 Online Store
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    📈 Reports
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    ⚙️ Settings
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.faq') }}" class="nav-link {{ request()->routeIs('admin.faq') ? 'active' : '' }}">
                    ❓ FAQ
                </a>
            </li>
            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-link nav-link text-danger" type="submit">🚪 Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('earningsChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                    datasets: [{
                        label: 'Earnings',
                        data: [50000, 65000, 70000, 80000, 90000],
                        borderColor: 'green',
                        fill: false,
                        tension: 0.4
                    }]
                }
            });
        }
    </script>
</body>
</html>
