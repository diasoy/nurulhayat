<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SupplierOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('supplier_id', auth()->id());

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $today = Carbon::now();

            switch ($request->periode) {
                case 'today':
                    $query->whereDate('pelaksanaan_tanggal', $today->format('Y-m-d'));
                    break;
                case 'this_week':
                    $query->whereBetween('pelaksanaan_tanggal', [
                        $today->copy()->startOfWeek()->format('Y-m-d'),
                        $today->copy()->endOfWeek()->format('Y-m-d')
                    ]);
                    break;
                case 'next_week':
                    $query->whereBetween('pelaksanaan_tanggal', [
                        $today->copy()->addWeek()->startOfWeek()->format('Y-m-d'),
                        $today->copy()->addWeek()->endOfWeek()->format('Y-m-d')
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

        // Filter berdasarkan hari
        if ($request->filled('hari')) {
            $query->where('pelaksanaan_hari', $request->hari);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_supplier', $request->status);
        }

        $orders = $query->orderBy('pelaksanaan_tanggal', 'asc')
            ->orderBy('pelaksanaan_jam', 'asc')
            ->get();

        return view('Supplier.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('Supplier.order.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            if ($order->supplier_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $request->validate([
                'status_supplier' => 'required|in:Belum Diproses,Diproses,Terkirim'
            ]);

            $order->status_supplier = $request->status_supplier;
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
}
