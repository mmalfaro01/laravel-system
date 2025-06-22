@extends('layouts.admin')

@section('title', 'Manage Resellers')

@section('content')
<div class="container">
    <h2 class="mb-4">Reseller Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.stores.create') }}" class="btn btn-success mb-3">+ Add Reseller</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Store Name</th>
                <th>Owner</th>
                <th>Email</th>
                <th>Products Count</th>
                <th>Total Earnings</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stores as $index => $store)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->owner_name }}</td>
                    <td>{{ $store->email }}</td>
                    <td>{{ $store->products_count ?? 0 }}</td>
                    <td><strong>₱{{ number_format($store->earnings ?? 0, 2) }}</strong></td>
                    <td>
                        <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.stores.destroy', $store->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this reseller?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No resellers found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
