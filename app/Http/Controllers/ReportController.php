<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $query = OrderItem::query();

        // Optional filters
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $report = $query->selectRaw('
                    SUM(price * quantity) as total_sales,
                    SUM(quantity) as total_quantity,
                    COUNT(*) as total_transactions
                ')
                ->first();

        return view('admin.reports', compact('report'));
    }
}
