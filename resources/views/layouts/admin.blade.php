<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title') - Admin Panel | Tropical Burger</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    :root {
      --tropical-orange: #FF6B35;
      --tropical-yellow: #FFD23F;
      --tropical-red: #E74C3C;
      --tropical-brown: #8B4513;
    }

    body {
      display: flex;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%);
    }

    .sidebar {
      width: 260px;
      transition: all 0.3s ease;
      background: linear-gradient(180deg, var(--tropical-orange) 0%, var(--tropical-red) 100%);
      border-right: none;
      padding: 2rem 1rem;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      overflow-y: auto;
      z-index: 1030;
      box-shadow: 4px 0 15px rgba(0,0,0,0.2);
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
      color: white;
      font-weight: 500;
      padding: 0.8rem 1rem;
      border-radius: 0.5rem;
      transition: 0.3s;
      margin-bottom: 0.5rem;
    }

    .nav-link i {
      width: 25px;
      font-size: 1.3rem;
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      color: var(--tropical-yellow);
      transform: translateX(5px);
    }

    .nav-link.active {
      background-color: rgba(255, 255, 255, 0.3);
      color: var(--tropical-yellow) !important;
      font-weight: 700;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
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
      width: 40px;
      height: 40px;
      border: none;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: left 0.3s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .sidebar.collapsed ~ .toggle-btn {
      left: 80px;
    }

    .toggle-btn:hover {
      background: linear-gradient(135deg, var(--tropical-red), var(--tropical-orange));
      transform: scale(1.1);
    }

    .sidebar h4 {
      color: white !important;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .content {
      background: transparent;
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
  <div id="adminSidebar" class="sidebar">
    <div class="text-center mb-4">
      <i class='bx bxs-burger' style="font-size: 3rem; color: var(--tropical-yellow);"></i>
      <h4 class="mt-2 fw-bold">Tropical Burger</h4>
      <small class="text-white-50">Admin Dashboard</small>
    </div>
    <hr style="border-color: rgba(255,255,255,0.3);">
    <ul class="nav flex-column mt-4">
      @php
        $routes = [
          ['admin.dashboard', 'bxs-dashboard', 'Dashboard'],
          ['admin.products.index', 'bxs-cart', 'Products'],
          ['admin.users', 'bxs-user', 'Users'],
          ['admin.orders', 'bx-receipt', 'Orders'],        
          ['admin.reports', 'bxs-report', 'Reports'],       
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
          <button type="submit" class="btn btn-link nav-link" style="color: var(--tropical-yellow); border: 2px solid rgba(255,255,255,0.3);">
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
