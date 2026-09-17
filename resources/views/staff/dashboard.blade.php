@extends('layouts.staff')

@section('title', 'Staff Dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Staff Dashboard</h2>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Orders</h5>
                <div class="fs-4">{{ $totalOrders }}</div>
                <a href="{{ route('staff.orders') }}" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Assigned Orders</h5>
                <div class="fs-4">{{ $assignedOrders }}</div>
                <a href="{{ route('staff.orders') }}" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Messages</h5>
                <div class="fs-4">{{ $messages }}</div>
                <a href="{{ route('staff.messages') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('staff.reports') }}" class="btn btn-outline-light">View Reports</a>
        <a href="{{ route('staff.messages') }}" class="btn btn-outline-light ms-2">Messages</a>
    </div>
</div>
@endsection
