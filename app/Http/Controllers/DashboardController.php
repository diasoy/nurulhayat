<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'year');
        $now = Carbon::now();

        // Set periode berdasarkan filter
        switch ($filter) {
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                break;
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                break;
            default:
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
        }

        // Statistik Utama
        $statistics = $this->getMainStatistics($start, $end);

        // Tren Pendapatan
        $revenueTrend = $this->getRevenueTrend($start, $end, $filter);

        // Top Performers
        $topDapur = $this->getTopPerformers('dapur_id', $start, $end);
        $topSupplier = $this->getTopPerformers('supplier_id', $start, $end);

        // Jadwal
        $jadwalDapur = $this->getSchedule('dapur_id', $start, $end);
        $jadwalSupplier = $this->getSchedule('supplier_id', $start, $end);

        // Menu Analytics
        $menuAnalytics = $this->getMenuAnalytics($start, $end);

        // Performance Metrics
        $performanceMetrics = $this->getPerformanceMetrics($start, $end);

        return view('admin.dashboard.dashboard', compact(
            'filter',
            'statistics',
            'revenueTrend',
            'topDapur',
            'topSupplier',
            'jadwalDapur',
            'jadwalSupplier',
            'menuAnalytics',
            'performanceMetrics'
        ));
    }

    private function getMainStatistics($start, $end)
    {
        $orders = Order::whereBetween('created_at', [$start, $end]);

        return [
            'total_pendapatan' => $orders->whereIn('midtrans_transaction_status', ['settlement', 'capture'])->sum('total_harga'),
            'total_order' => $orders->count(),
            'order_pending' => $orders->where('midtrans_transaction_status', 'pending')->count(),
            'order_sukses' => $orders->whereIn('midtrans_transaction_status', ['settlement', 'capture'])->count(),
            'average_order_value' => $orders->avg('total_harga'),
            'total_customers' => $orders->distinct('pemesan_email')->count(),
        ];
    }

    private function getRevenueTrend($start, $end, $filter)
    {
        $groupBy = $filter == 'year' ? 'month' : 'day';

        return Order::whereBetween('created_at', [$start, $end])
            ->whereIn('midtrans_transaction_status', ['settlement', 'capture'])
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"),
                DB::raw('SUM(total_harga) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getTopPerformers($role, $start, $end)
    {
        return Order::whereBetween('created_at', [$start, $end])
            ->whereIn('midtrans_transaction_status', ['settlement', 'capture'])
            ->select($role, DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_harga) as total_revenue'))
            ->with([$role == 'dapur_id' ? 'dapur' : 'supplier'])
            ->groupBy($role)
            ->orderByDesc('total_orders')
            ->limit(5)
            ->get();
    }

    private function getMenuAnalytics($start, $end)
    {
        return Order::whereBetween('created_at', [$start, $end])
            ->whereIn('midtrans_transaction_status', ['settlement', 'capture'])
            ->select('menu_option', DB::raw('COUNT(*) as total'))
            ->groupBy('menu_option')
            ->orderByDesc('total')
            ->get();
    }

    private function getPerformanceMetrics($start, $end)
    {
        $orders = Order::whereBetween('created_at', [$start, $end]);

        return [
            'on_time_delivery' => $orders->where('status_order', true)->count(),
            'late_delivery' => $orders->where('status_order', false)->count(),
            'customer_satisfaction' => 95, // Dummy data, implement actual calculation
            'order_completion_rate' => ($orders->where('status_order', true)->count() / max($orders->count(), 1)) * 100
        ];
    }

    private function getSchedule($role, $start, $end)
    {
        return Order::with([$role == 'dapur_id' ? 'dapur' : 'supplier'])
            ->whereBetween('pelaksanaan_tanggal', [$start, $end])
            ->orderBy('pelaksanaan_tanggal')
            ->orderBy('pelaksanaan_jam')
            ->get()
            ->groupBy($role);
    }
}
