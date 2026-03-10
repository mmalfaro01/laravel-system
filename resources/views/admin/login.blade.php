<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Tropical Burger</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
            background: var(--burger-pitch);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--burger-white);
        }
        .login-wrap { width: 100%; max-width: 400px; padding: 1rem; }
        .login-card {
            background: var(--burger-white);
            border-radius: 1.5rem;
            box-shadow: 0 24px 48px #000;
            padding: 2rem;
            color: #1a1a1a;
        }
        .login-card .brand { text-align: center; margin-bottom: 1.25rem; }
        .login-card .brand i { font-size: 2.5rem; color: var(--burger-orange); }
        .login-card h1 { font-size: 1.35rem; font-weight: 800; color: var(--burger-dark); margin: 0 0 0.25rem; text-align: center; }
        .login-card .subtitle { text-align: center; color: #6b7280; font-size: 0.9rem; margin-bottom: 1.5rem; }
        .login-card .form-label { font-weight: 600; color: #374151; font-size: 0.875rem; }
        .login-card .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 999px;
            padding: 0.6rem 1rem;
            background: #fff;
        }
        .login-card .form-control:focus { border-color: var(--burger-orange); box-shadow: 0 0 0 3px #3d2a0a; }
        .login-card .form-check-label { color: #4b5563; }
        .login-card .btn-login {
            background: var(--burger-orange);
            border: none;
            color: #1a1208;
            font-weight: 700;
            padding: 0.75rem;
            border-radius: 999px;
            width: 100%;
        }
        .login-card .btn-login:hover { background: #ff8c00; color: #1a1208; }
        .login-card .back-link { text-align: center; margin-top: 1.25rem; }
        .login-card .back-link a { color: var(--burger-orange); font-weight: 600; text-decoration: none; }
        .login-card .back-link a:hover { color: #ff8c00; }
        .login-card .footer-text { text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 0.85rem; }
        .login-card .alert-danger { background: #1a0a0a; border: 1px solid #e74c3c; color: #fca5a5; border-radius: 0.75rem; }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <div class="brand">
                <i class='bx bxs-burger'></i>
            </div>
            <h1>Admin</h1>
            <p class="subtitle">Tropical Burger · Sign in</p>

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@example.com" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-login">Sign in</button>
            </form>

            <p class="footer-text">Secure admin access</p>
            <div class="back-link">
                <a href="{{ route('home') }}">← Back to site</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
