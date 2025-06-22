@extends('layouts.admin')

@section('title', 'Edit Store')

@section('content')
<div class="container">
    <h2>Edit Store</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.stores.update', $store->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Store Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $store->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="owner_name" class="form-label">Owner Name</label>
            <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', $store->owner_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Owner Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $store->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Store</button>
    </form>
</div>
@endsection
