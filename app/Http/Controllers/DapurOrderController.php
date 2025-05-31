<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DapurOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('dapur_id', auth()->id())->get();
        return view('Dapur.order.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
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
