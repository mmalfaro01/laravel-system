@extends('layouts.admin')

@section('title', 'Create Driver')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-1">Create Driver Account</h2>
            <p class="text-muted mb-0">Create a dedicated driver login for assigned orders.</p>
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-outline-light">Back to Users</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.drivers.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Driver Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Full name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="driver@example.com" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning text-dark fw-bold">Create Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection