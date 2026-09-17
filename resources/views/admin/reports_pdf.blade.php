<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f4f4f4; }
        .summary { margin-top: 10px; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <h2 class="center">Sales Report</h2>
    <p>Generated: {{ now()->format('Y-m-d H:i') }}</p>

    <div class="summary">
        <strong>Total Sales:</strong> ₱{{ number_format($report->total_sales ?? 0, 2) }}<br>
        <strong>Total Quantity:</strong> {{ $report->total_quantity ?? 0 }}<br>
        <strong>Total Items:</strong> {{ $report->total_transactions ?? 0 }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Order ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>#{{ $item->order_id }}</td>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₱{{ number_format($item->price, 2) }}</td>
                <td>₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
