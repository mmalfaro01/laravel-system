@extends('layouts.app')

@section('title', 'Register - Tropical Burger')

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

    .auth-card .btn-primary {
        border-radius: 999px;
        padding: 0.7rem 1.5rem;
        font-weight: 700;
        font-size: 1rem;
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
</style>

<div class="auth-form-wrap">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-6 col-lg-5">

                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <h3 class="auth-title text-center">{{ __('Create an Account') }}</h3>
                        <p class="text-center text-secondary mb-4" style="font-size: 0.9rem;">Join us and start ordering.</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus
                                       placeholder="Your name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required
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

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password"
                                       class="form-control"
                                       name="password_confirmation" required placeholder="••••••••">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top" style="border-color: #e5e7eb !important;">
                            <p class="auth-footer-text mb-1">Already have an account?</p>
                            <a href="{{ route('login') }}" class="auth-footer-link">Login here</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
