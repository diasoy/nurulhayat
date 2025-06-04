<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DapurOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('dapur_id', auth()->id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%{$search}%")
                    ->orWhere('pemesan_nama', 'LIKE', "%{$search}%")
                    ->orWhere('pemesan_telepon', 'LIKE', "%{$search}%");
            });
        }
        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $today = Carbon::now();

            switch ($request->periode) {
                case 'today':
                    $query->whereDate('pelaksanaan_tanggal', $today->format('Y-m-d'));
                    break;

                case 'this_week':
                    $startOfWeek = $today->copy()->startOfWeek();
                    $endOfWeek = $today->copy()->endOfWeek();
                    $query->whereBetween('pelaksanaan_tanggal', [
                        $startOfWeek->format('Y-m-d'),
                        $endOfWeek->format('Y-m-d')
                    ]);
                    break;

                case 'next_week':
                    $startOfNextWeek = $today->copy()->addWeek()->startOfWeek();
                    $endOfNextWeek = $today->copy()->addWeek()->endOfWeek();
                    $query->whereBetween('pelaksanaan_tanggal', [
                        $startOfNextWeek->format('Y-m-d'),
                        $endOfNextWeek->format('Y-m-d')
                    ]);
                    break;

                case 'this_month':
                    $query->whereMonth('pelaksanaan_tanggal', $today->month)
                        ->whereYear('pelaksanaan_tanggal', $today->year);
                    break;

                case 'next_month':
                    $nextMonth = $today->copy()->addMonth();
                    $query->whereMonth('pelaksanaan_tanggal', $nextMonth->month)
                        ->whereYear('pelaksanaan_tanggal', $nextMonth->year);
                    break;

                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('pelaksanaan_tanggal', [
                            $request->start_date,
                            $request->end_date
                        ]);
                    }
                    break;
            }
        }

        // Filter berdasarkan custom date range (jika tidak menggunakan periode)
        if (!$request->filled('periode') && $request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('pelaksanaan_tanggal', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Filter berdasarkan hari
        if ($request->filled('hari')) {
            $query->where('pelaksanaan_hari', $request->hari);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_dapur', $request->status);
        }

        // Urutkan berdasarkan tanggal pelaksanaan (terbaru dulu)

        $orders = $query->orderBy('pelaksanaan_tanggal', 'asc')
            ->orderBy('pelaksanaan_jam', 'asc')
            ->paginate($request->input('per_page', 10));

        return view('Dapur.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Pastikan order ini milik dapur yang sedang login
        if ($order->dapur_id !== auth()->id()) {
            abort(403, 'Unauthorized access');
        }

        return view('Dapur.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order->dapur_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $request->validate([
                'status_dapur' => 'required|in:Belum Diproses,Diproses,Terkirim'
            ]);

            $order->status_dapur = $request->status_dapur;

            // Jika status diubah menjadi 'Terkirim', set jam_matang ke waktu sekarang
            if ($request->status_dapur === 'Terkirim' && !$order->jam_matang) {
                $order->jam_matang = Carbon::now()->format('H:i');
            }

            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOrderStatistics(Request $request)
    {
        $query = Order::where('dapur_id', auth()->id());

        // Terapkan filter yang sama seperti di index
        if ($request->filled('periode')) {
            $today = Carbon::now();

            switch ($request->periode) {
                case 'today':
                    $query->whereDate('pelaksanaan_tanggal', $today->format('Y-m-d'));
                    break;
                case 'this_week':
                    $startOfWeek = $today->copy()->startOfWeek();
                    $endOfWeek = $today->copy()->endOfWeek();
                    $query->whereBetween('pelaksanaan_tanggal', [
                        $startOfWeek->format('Y-m-d'),
                        $endOfWeek->format('Y-m-d')
                    ]);
                    break;
                case 'this_month':
                    $query->whereMonth('pelaksanaan_tanggal', $today->month)
                        ->whereYear('pelaksanaan_tanggal', $today->year);
                    break;
            }
        }

        $statistics = [
            'total' => $query->count(),
            'belum_diproses' => $query->clone()->where('status_dapur', 'Belum Diproses')->count(),
            'diproses' => $query->clone()->where('status_dapur', 'Diproses')->count(),
            'terkirim' => $query->clone()->where('status_dapur', 'Terkirim')->count(),
        ];

        return response()->json($statistics);
    }
}
