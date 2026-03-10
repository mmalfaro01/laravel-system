@extends('layouts.app')

@section('title', 'Login - Tropical Burger')

@section('content')
<style>
    .auth-form-wrap {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-card {
        background: var(--burger-white);
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.35);
        overflow: hidden;
        max-width: 420px;
    }

    .auth-card .card-body {
        padding: 2rem 2.25rem;
        color: #1a1a1a;
    }

    .auth-card .auth-title {
        color: var(--auth-accent);
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .auth-card .auth-subtitle {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .auth-card .form-label {
        color: #374151;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .auth-card .form-control {
        border-radius: 999px;
        padding: 0.65rem 1.25rem;
        font-size: 0.95rem;
        border: 2px solid #e5e7eb;
        background: var(--burger-white);
        color: #1a1a1a;
    }

    .auth-card .form-control:focus {
        border-color: var(--burger-orange);
        box-shadow: 0 0 0 3px #3d2a0a;
        background: var(--burger-white);
        color: #1a1a1a;
    }

    .auth-card .form-control::placeholder {
        color: #9ca3af;
    }

    /* Password field: dark fill like in reference */
    .auth-card input[type="password"].form-control {
        background: var(--burger-pitch);
        border-color: var(--burger-dark);
        color: var(--burger-white);
    }

    .auth-card input[type="password"].form-control:focus {
        border-color: var(--burger-orange);
        background: var(--burger-black);
        color: var(--burger-white);
    }

    .auth-card .form-check-input {
        border: 2px solid #d1d5db;
        background: var(--burger-white);
    }

    .auth-card .form-check-input:checked {
        background-color: var(--burger-orange);
        border-color: var(--burger-orange);
    }

    .auth-card .form-check-label {
        color: #4b5563;
    }

    .auth-card .btn-primary {
        border-radius: 999px;
        padding: 0.7rem 1.5rem;
        font-weight: 700;
        font-size: 1rem;
    }

    .auth-divider {
        color: #9ca3af;
        font-size: 0.8rem;
        margin: 1rem 0;
    }

    .auth-social-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid #e5e7eb;
        background: var(--burger-white);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .auth-social-btn:hover {
        border-color: var(--burger-orange);
        box-shadow: 0 4px 12px #2a2008;
    }

    .auth-footer-text {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .auth-footer-link {
        color: var(--auth-accent);
        font-weight: 600;
        text-decoration: underline;
    }

    .auth-footer-link:hover {
        color: var(--burger-orange);
    }

    .auth-forgot-link {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .auth-forgot-link:hover {
        color: var(--auth-accent);
    }
</style>

<div class="auth-form-wrap">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-6 col-lg-5">

                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <h3 class="auth-title text-center">{{ __('Welcome Back!') }}</h3>
                        <p class="auth-subtitle text-center">Login to continue shopping with us.</p>

                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <a href="{{ route('login.google') }}" class="auth-social-btn" title="Login with Google">
                                <i class="bi bi-google" style="font-size: 1.4rem; color: #4285F4;"></i>
                            </a>
                            <a href="{{ route('login.facebook') }}" class="auth-social-btn" title="Login with Facebook">
                                <i class="bi bi-facebook" style="font-size: 1.4rem; color: #1877F2;"></i>
                            </a>
                        </div>

                        <div class="text-center auth-divider">OR</div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autofocus
                                       placeholder="you@example.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="auth-forgot-link text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="auth-footer-text mb-1">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="auth-footer-link">Create one</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
