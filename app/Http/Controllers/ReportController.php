<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    private function salesQuery(Request $request)
    {
        $query = OrderItem::query()->whereHas('order', function ($orderQuery) {
            $orderQuery->where('status', 'completed');
        });

        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        return $query;
    }

    public function sales(Request $request)
    {
        $query = $this->salesQuery($request);

        $report = (clone $query)
            ->selectRaw('SUM(price * quantity) as total_sales, SUM(quantity) as total_quantity, COUNT(*) as total_transactions')
            ->first();

        return view('admin.reports', compact('report'));
    }

    /**
     * Generate PDF for sales report (filtered)
     */
    public function salesPdf(Request $request)
    {
        $query = $this->salesQuery($request);

        $items = (clone $query)
            ->with(['product', 'order'])
            ->orderByDesc('created_at')
            ->get();

        $report = (clone $query)
            ->selectRaw('SUM(price * quantity) as total_sales, SUM(quantity) as total_quantity, COUNT(*) as total_transactions')
            ->first();

        $data = compact('items', 'report');

        try {
            $fileName = 'sales-report-' . now()->format('Ymd_His') . '.pdf';

            return Pdf::loadView('admin.reports_pdf', $data)->download($fileName);
        } catch (\Exception $e) {
            Log::error('PDF generation failed: '.$e->getMessage());
        }

        // Fallback: return HTML view
        return view('admin.reports_pdf', $data);
    }
}
