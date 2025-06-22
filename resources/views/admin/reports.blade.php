@extends('layouts.admin')

@section('title', 'Sales Report')

@section('content')
<div class="container">
    <h2 class="mb-4">Sales Report</h2>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.sales.report') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" name="year" id="year" class="form-control" placeholder="e.g. 2025" value="{{ request('year') }}">
        </div>
        <div class="col-md-3">
            <label for="month" class="form-label">Month</label>
            <input type="number" name="month" id="month" class="form-control" placeholder="1-12" value="{{ request('month') }}">
        </div>
        <div class="col-md-3">
            <label for="from" class="form-label">From Date</label>
            <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
        </div>
        <div class="col-md-3">
            <label for="to" class="form-label">To Date</label>
            <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
        </div>
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-success">🔍 Filter Report</button>
        </div>
    </form>

    {{-- Report Summary --}}
    <div class="card p-4 mt-3">
        <h5>Total Sales: <strong>₱{{ number_format($report->total_sales ?? 0, 2) }}</strong></h5>
        <p>Total Quantity Sold: <strong>{{ $report->total_quantity ?? 0 }}</strong></p>
        <p>Total Order Items: <strong>{{ $report->total_transactions ?? 0 }}</strong></p>
    </div>
</div>
@endsection
