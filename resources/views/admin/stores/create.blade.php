@extends('layouts.admin')

@section('title', 'Create Store')

@section('content')
<div class="container">
    <h2>Create Store</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.stores.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Store Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="owner_name" class="form-label">Owner Name</label>
            <input type="text" name="owner_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Owner Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Store</button>
    </form>
</div>
@endsection
