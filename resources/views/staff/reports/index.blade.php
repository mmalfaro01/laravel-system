@extends('layouts.staff')

@section('title', 'Staff Reports')

@section('content')
<div class="container">
    <h2 class="mb-4">Product Sales (Top 10)</h2>

    <table class="table table-striped">
        <thead><tr><th>Product</th><th>Quantity Sold</th></tr></thead>
        <tbody>
            @forelse($productSales as $p)
                <tr>
                    <td>{{ $p->product_name }}</td>
                    <td>{{ $p->total_quantity }}</td>
                </tr>
            @empty
                <tr><td colspan="2">No sales data available.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
