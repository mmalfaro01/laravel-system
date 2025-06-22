@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Our Products</h1>
        <p class="text-muted">Explore our fresh and healthy hydroponic produce!</p>
    </div>

    {{-- Search and Category Filter --}}
    <div class="row justify-content-between align-items-center mb-4">
        <div class="col-md-6">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="col-md-4">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                <select name="category" class="form-select me-2">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-secondary">Filter</button>
            </form>
        </div>
    </div>

    {{-- Product List --}}
    <div class="row">
        @forelse($products as $product)
        <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow-sm w-100">
                <img src="{{ $product->image ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/400x300' }}"
                     alt="{{ $product->name }}"
                     class="card-img-top"
                     style="height: 250px; object-fit: cover; border-bottom: 1px solid #eee;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted small mb-2">
                        {{ Str::limit($product->description, 100) }}
                    </p>
                    <p class="h5 fw-semibold text-success">₱{{ number_format($product->price, 2) }}</p>

                    {{-- Stock Display --}}
                    <p class="text-muted small {{ $product->stock <= 5 ? 'text-danger fw-bold' : '' }}">
                        <strong>In Stock:</strong> {{ $product->stock }}
                    </p>
                </div>

                <div class="card-footer bg-white d-flex justify-content-between">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary w-50 me-1">View</a>
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="w-50">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                No products found.
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
