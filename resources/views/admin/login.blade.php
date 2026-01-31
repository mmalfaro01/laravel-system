<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Tropical Burger</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/faviccon.png') }}">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        :root {
            --tropical-orange: #FF6B35;
            --tropical-yellow: #FFD23F;
            --tropical-red: #E74C3C;
            --tropical-green: #27AE60;
            --tropical-brown: #8B4513;
            --tropical-light: #FFF8DC;
            --tropical-cream: #FFE4B5;
            --tropical-dark: #654321;
        }

        body {
            background: linear-gradient(135deg, var(--tropical-orange) 0%, var(--tropical-red) 50%, var(--tropical-yellow) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><text y="50" font-size="60" opacity="0.05">🍔</text></svg>');
            background-size: 150px;
            animation: float 20s infinite linear;
            pointer-events: none;
        }

        @keyframes float {
            from { background-position: 0 0; }
            to { background-position: 150px 150px; }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 3rem 2.5rem;
            backdrop-filter: blur(10px);
            border: 5px solid var(--tropical-yellow);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .burger-icon {
            font-size: 5rem;
            display: inline-block;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .login-title {
            font-size: 2rem;
            font-weight: bold;
            color: var(--tropical-brown);
            text-align: center;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-subtitle {
            text-align: center;
            color: var(--tropical-orange);
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--tropical-brown);
            margin-bottom: 0.5rem;
        }

        .input-group {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 3px solid var(--tropical-orange);
        }

        .input-group-text {
            background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 0.75rem 1rem;
        }

        .form-control {
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            background: var(--tropical-light);
        }

        .form-control:focus {
            box-shadow: none;
            background: white;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--tropical-orange), var(--tropical-red));
            border: none;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 107, 53, 0.6);
            background: linear-gradient(135deg, var(--tropical-red), var(--tropical-orange));
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 1rem;
            border: none;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            border-left: 5px solid #c92a2a;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            color: var(--tropical-brown);
            font-weight: 600;
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: var(--tropical-orange);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link a:hover {
            color: var(--tropical-red);
            transform: translateX(-5px);
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px dashed var(--tropical-cream);
            color: var(--tropical-brown);
            font-size: 0.9rem;
        }

        /* Floating elements */
        .float-element {
            position: absolute;
            opacity: 0.1;
            animation: rotate 20s infinite linear;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="logo-container">
                <i class='bx bxs-burger burger-icon' style="color: var(--tropical-orange);"></i>
            </div>

            <h1 class="login-title">
                <i class='bx bxs-shield-alt-2' style="color: var(--tropical-red);"></i>
                Admin Panel
            </h1>
            <p class="login-subtitle">🌴 Tropical Burger Siquijor 🍔</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class='bx bxs-error-circle me-2'></i>Oops!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label">
                        <i class='bx bxs-envelope me-1'></i>Email Address
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class='bx bxs-user'></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               class="form-control" 
                               placeholder="admin@tropicalburger.ph"
                               value="{{ old('email') }}"
                               required 
                               autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class='bx bxs-lock-alt me-1'></i>Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class='bx bxs-key'></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="Enter your password"
                               required>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="color: var(--tropical-brown);">
                        Remember me for 30 days
                    </label>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class='bx bxs-log-in-circle me-2 fs-5'></i>
                    Login to Dashboard
                </button>
            </form>

            <div class="footer-text">
                <i class='bx bxs-lock-alt me-1'></i>
                Secure Admin Access Only
            </div>

            <div class="back-link">
                <a href="{{ route('home') }}">
                    <i class='bx bx-arrow-back'></i>
                    Back to Website
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
