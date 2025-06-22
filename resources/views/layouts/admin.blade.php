<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title') - Admin Panel | Veggie Shop</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      display: flex;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }

    .sidebar {
      width: 260px;
      transition: all 0.3s ease;
      background: #fff;
      border-right: 1px solid #e3e3e3;
      padding: 2rem 1rem;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      overflow-y: auto;
      z-index: 1030;
    }

    .sidebar.collapsed {
      width: 80px;
      padding: 2rem 0.5rem;
    }

    .sidebar h4,
    .sidebar .nav-link span {
      transition: opacity 0.3s ease;
    }

    .sidebar.collapsed h4,
    .sidebar.collapsed .nav-link span {
      opacity: 0;
      visibility: hidden;
    }

    .nav-link {
      display: flex;
      align-items: center;
      color: #333;
      font-weight: 500;
      padding: 0.6rem 1rem;
      border-radius: 0.375rem;
      transition: 0.3s;
    }

    .nav-link i {
      width: 25px;
      font-size: 1.2rem;
    }

    .nav-link:hover {
      background-color: #f1f1f1;
      color: #0d6efd;
    }

    .nav-link.active {
      background-color: #e7f1ff;
      color: #0d6efd !important;
      font-weight: 600;
    }

    .content {
      margin-left: 260px;
      padding: 2rem;
      transition: margin-left 0.3s ease;
      flex-grow: 1;
    }

    .sidebar.collapsed ~ .content {
      margin-left: 80px;
    }

    .toggle-btn {
      position: fixed;
      top: 1rem;
      left: 260px;
      z-index: 1040;
      width: 36px;
      height: 36px;
      border: none;
      border-radius: 50%;
      background-color: #198754;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: left 0.3s ease;
    }

    .sidebar.collapsed ~ .toggle-btn {
      left: 80px;
    }

    .toggle-btn:hover {
      background-color: #157347;
    }

    @media (max-width: 768px) {
      .sidebar, .toggle-btn {
        display: none;
      }

      .content {
        margin-left: 0;
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  {{-- Sidebar --}}
  <div id="adminSidebar" class="sidebar shadow-sm">
    <h4 class="text-center">🥬 Veggie Shop</h4>
    <ul class="nav flex-column mt-4">
      @php
        $routes = [
          ['admin.dashboard', 'bxs-dashboard', 'Dashboard'],
          ['admin.products.index', 'bxs-cart', 'Products'],
          ['admin.users', 'bxs-user', 'Users'],
          ['admin.orders', 'bx-receipt', 'Orders'],

          ['admin.stores.index', 'bx-globe', 'Online Store'],
          ['admin.reports', 'bxs-report', 'Reports'],
          ['admin.settings', 'bxs-cog', 'Settings'],
          ['admin.faq', 'bxs-help-circle', 'FAQs'],
        ];
      @endphp

      @foreach ($routes as [$route, $icon, $label])
        <li class="nav-item">
          <a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
            <i class='bx {{ $icon }}'></i> <span class="ms-2">{{ $label }}</span>
          </a>
        </li>
      @endforeach

      <li class="nav-item mt-4">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="btn btn-link nav-link text-danger">
            <i class='bx bx-log-out'></i> <span class="ms-2">Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </div>

  {{-- Toggle Button --}}
  <button class="toggle-btn" onclick="toggleSidebar()" title="Toggle Sidebar">
    <i class='bx bx-chevron-left'></i>
  </button>

  {{-- Main Content --}}
  <div class="content" id="adminContent">
    @yield('content')
  </div>

  {{-- Scripts --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('adminSidebar');
      const toggleBtn = document.querySelector('.toggle-btn');
      const icon = toggleBtn.querySelector('i');
      sidebar.classList.toggle('collapsed');
      icon.classList.toggle('bx-chevron-left');
      icon.classList.toggle('bx-chevron-right');
    }
  </script>
  @yield('scripts')
</body>
</html>
