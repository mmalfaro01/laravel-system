<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title') - Admin | Tropical Burger</title>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    :root {
      --burger-pitch: #050303;
      --burger-black: #0a0806;
      --burger-dark: #1a1a1a;
      --burger-orange: #f39a12;
      --burger-gold: #ffcb72;
      --burger-white: #ffffff;
      --burger-muted: #b0aeab;
      --burger-border: #2a2826;
    }
    body {
      display: flex;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      background: var(--burger-pitch);
      color: var(--burger-white);
    }
    .sidebar {
      width: 260px;
      transition: all 0.3s ease;
      background: var(--burger-black);
      border-right: 2px solid var(--burger-orange);
      padding: 1.5rem 1rem;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      overflow-y: auto;
      z-index: 1030;
    }
    .sidebar.collapsed { width: 72px; padding: 1.5rem 0.5rem; }
    .sidebar h4, .sidebar .nav-link span { transition: opacity 0.3s ease; }
    .sidebar.collapsed h4, .sidebar.collapsed .nav-link span { opacity: 0; visibility: hidden; }
    .sidebar .brand-icon { font-size: 2rem; color: var(--burger-gold); }
    .sidebar h4 { color: var(--burger-white); font-weight: 800; font-size: 1rem; }
    .sidebar .brand-sub { color: var(--burger-muted); font-size: 0.75rem; }
    .sidebar hr { border-color: var(--burger-border); }
    .nav-link {
      display: flex;
      align-items: center;
      color: var(--burger-muted);
      font-weight: 500;
      padding: 0.6rem 0.75rem;
      border-radius: 0.5rem;
      transition: 0.2s;
      margin-bottom: 0.25rem;
      text-decoration: none;
    }
    .nav-link i { width: 24px; font-size: 1.2rem; }
    .nav-link:hover { background: var(--burger-dark); color: var(--burger-orange); }
    .nav-link.active { background: var(--burger-dark); color: var(--burger-orange); font-weight: 700; border: 1px solid var(--burger-border); }
    .content {
      margin-left: 260px;
      padding: 1.25rem;
      transition: margin-left 0.3s ease;
      flex-grow: 1;
      background: var(--burger-pitch);
    }
    .sidebar.collapsed ~ .content { margin-left: 72px; }
    .toggle-btn {
      position: fixed;
      top: 0.75rem;
      left: 260px;
      z-index: 1040;
      width: 36px;
      height: 36px;
      border: none;
      border-radius: 0.5rem;
      background: var(--burger-orange);
      color: #1a1208;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: left 0.3s ease;
    }
    .sidebar.collapsed ~ .toggle-btn { left: 72px; }
    .toggle-btn:hover { background: #ff8c00; color: #1a1208; }
    .content .card, .content .page-panel { background: var(--burger-dark); border: 1px solid var(--burger-border); color: var(--burger-white); }
    .content .text-muted { color: var(--burger-muted) !important; }
    @media (max-width: 768px) {
      .sidebar, .toggle-btn { display: none; }
      .content { margin-left: 0; padding: 1rem; }
    }
  </style>
</head>
<body>
  <div id="adminSidebar" class="sidebar">
    <div class="text-center mb-3">
      <i class='bx bxs-burger brand-icon'></i>
      <h4 class="mt-2">Tropical Burger</h4>
      <small class="brand-sub">Admin</small>
    </div>
    <hr>
    <ul class="nav flex-column mt-3">
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
      <li class="nav-item mt-3">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="nav-link border-0 w-100 text-start bg-transparent" style="color: var(--burger-muted);">
            <i class='bx bx-log-out'></i> <span class="ms-2">Logout</span>
          </button>
        </form>
      </li>
    </ul>
  </div>
  <button class="toggle-btn" onclick="toggleSidebar()" title="Toggle sidebar">
    <i class='bx bx-chevron-left'></i>
  </button>
  <div class="content" id="adminContent">
    @yield('content')
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      document.getElementById('adminSidebar').classList.toggle('collapsed');
      const icon = document.querySelector('.toggle-btn i');
      icon.classList.toggle('bx-chevron-left');
      icon.classList.toggle('bx-chevron-right');
    }
  </script>
  @yield('scripts')
</body>
</html>
