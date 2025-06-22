@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            {{-- Login Card --}}
            <div class="card shadow-lg border-0 rounded-4 bg-white dark:bg-dark text-dark dark:text-light">
                <div class="card-body p-5">
                    <h3 class="text-center mb-3 fw-bold text-primary">{{ __('Welcome Back!') }}</h3>
                    <p class="text-center text-muted dark:text-secondary mb-4">Login to continue shopping with us.</p>

                    {{-- Social Logins --}}
                    <div class="d-flex justify-content-center gap-3 my-3">

    {{-- Google Login Button --}}
    <a href="{{ route('login.google') }}" class="btn btn-light border rounded-circle p-2 shadow-sm" title="Login with Google">
        <img src="https://th.bing.com/th/id/OIP.HgH-NjiOdFOrkmwjsZCCfAHaHl?rs=1&pid=ImgDetMain" alt="Google" width="32" height="32">
    </a>

    {{-- Facebook Login Button --}}
    <a href="{{ route('login.facebook') }}" class="btn btn-light border rounded-circle p-2 shadow-sm" title="Login with Facebook">
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook" width="32" height="32">
    </a>

</div>


                    <div class="text-center my-3 text-muted">OR</div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email"
                                   class="form-control rounded-pill @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control rounded-pill @error('password') is-invalid @enderror"
                                   name="password" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">
                                {{ __('Login') }}
                            </button>
                        </div>

                        {{-- Forgot Password --}}
                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="text-decoration-none text-muted" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Register --}}
            <div class="text-center mt-4">
                <small class="text-muted">Don't have an account?</small><br>
                <a href="{{ route('register') }}" class="text-decoration-none text-primary fw-semibold">Create one</a>
            </div>

        </div>
    </div>
</div>
@endsection
