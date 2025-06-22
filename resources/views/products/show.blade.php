@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5 align-items-center">

        {{-- Product Image --}}
        <div class="col-md-6 text-center">
            <img src="{{ $product->image ? asset('images/products/' . $product->image) : 'https://via.placeholder.com/400x300' }}"
                 class="img-fluid rounded shadow-sm"
                 style="max-height: 400px; object-fit: cover;"
                 alt="{{ $product->name }}">
        </div>

        {{-- Product Info --}}
        <div class="col-md-6">
            <h1 class="display-5 fw-bold">{{ $product->name }}</h1>
            <p class="h3 text-success mb-3">₱{{ number_format($product->price, 2) }}</p>

            {{-- Stock Display --}}
            <p class="text-muted {{ $product->stock <= 5 ? 'text-danger fw-bold' : '' }}">
                <strong>In Stock:</strong> {{ $product->stock }}
            </p>

            <p class="text-muted fs-6">
                {{ $product->description }}
            </p>

            @if($product->category)
            <p class="mb-3">
                <span class="badge bg-secondary">Category: {{ $product->category->name }}</span>
            </p>
            @endif

           <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg px-4">
                    <i class="bi bi-cart-plus me-2"></i> Add to Cart
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="text-decoration-none text-muted">
                    ← Back to Products
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
