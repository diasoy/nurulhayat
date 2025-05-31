<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SupplierOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('supplier_id', auth()->id())->get();
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
