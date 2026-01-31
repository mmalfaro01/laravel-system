@extends('layouts.admin')

@section('title', 'Manage Inventory')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Inventory Management</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Add Product</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 🔍 Search bar --}}
    <div class="mb-3">
        <input type="text" class="form-control" id="productSearch" placeholder="Search products by name or description...">
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle" id="productTable">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ Str::limit($product->description, 50) }}</td>
                        <td>{{ $product->formatted_price }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- JavaScript Search --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('productSearch');
            if (!input) return;

            input.addEventListener('input', function () {
                const value = this.value.toLowerCase();
                const rows = document.querySelectorAll('#productTable tbody tr');

                rows.forEach(row => {
                    const rowText = Array.from(row.cells).map(td => td.textContent.toLowerCase()).join(' ');
                    row.style.display = rowText.includes(value) ? '' : 'none';
                });
            });
        });
    </script>
@endsection
