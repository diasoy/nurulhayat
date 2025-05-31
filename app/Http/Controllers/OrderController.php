<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;
use App\Mail\OrderSuccessMail;
use Illuminate\Support\Facades\Mail;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('Admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $suppliers = User::whereHas('roles', function ($q) {
            $q->where('slug', 'supplier');
        })->get();
        $dapurs = User::whereHas('roles', function ($q) {
            $q->where('slug', 'dapur');
        })->get();
        
        return view('Admin.order.show', compact('order', 'suppliers', 'dapurs'));
    }

    public function sendToDapurSupplier(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_order = true;
        $order->pesanan_tambahan = $request->pesanan_tambahan;
        $order->keterangan_masak = $request->keterangan_masak;
        $order->supplier_id = $request->supplier_id;
        $order->dapur_id = $request->dapur_id;
        $order->save();

        return redirect()->route('admin.order.show', $order->id)->with('success', 'Order dikirim ke dapur dan supplier.');
    }
    public function midtransToken(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        $orderId = 'ORDER-' . time();
        $grossAmount = (int) $request->input('summary_total', 0);

        $order = new Order();
        $order->pemesan_nama = $request->input('pemesan_nama');
        $order->pemesan_alamat = $request->input('pemesan_alamat');
        $order->pemesan_telepon = $request->input('pemesan_telepon');
        $order->pemesan_handphone = $request->input('pemesan_handphone');
        $order->pemesan_email = $request->input('pemesan_email');
        $order->aqiqoh_nama = $request->input('aqiqoh_nama');
        $order->aqiqoh_binbinti = $request->input('aqiqoh_binbinti');
        $order->aqiqoh_tempat_lahir = $request->input('aqiqoh_tempat_lahir');
        $order->aqiqoh_tanggal_lahir = $request->input('aqiqoh_tanggal_lahir');
        $order->aqiqoh_jenis_kelamin = $request->input('aqiqoh_jenis_kelamin');
        $order->pelaksanaan_hari = $request->input('pelaksanaan_hari');
        $order->pelaksanaan_tanggal = $request->input('pelaksanaan_tanggal');
        $order->pelaksanaan_jam = $request->input('pelaksanaan_jam');
        $order->pelaksanaan_alamat = $request->input('pelaksanaan_alamat');
        $order->type_aqiqah = $request->input('type_aqiqah');
        $order->animal_gender = $request->input('animal_gender');
        $order->menu_option = $request->input('menu_option');
        $order->quantity = $request->input('quantity_platinum') ?: $request->input('quantity_istimewa') ?: $request->input('quantity_super') ?: $request->input('quantity_puas') ?: $request->input('quantity_tasyakuran');
        $order->jumlah_kotakan = $request->input('jumlah_kotakan');
        $order->total_harga = $grossAmount;
        $order->order_id = $orderId;
        $order->midtrans_transaction_status = 'pending';
        $order->save();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $request->input('pemesan_nama'),
                'email' => $request->input('pemesan_email'),
                'phone' => $request->input('pemesan_handphone'),
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function midtransNotification(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notif = new Notification();

        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;
        $paymentType = $notif->payment_type;
        $vaNumber = null;
        if (isset($notif->va_numbers[0]->va_number)) {
            $vaNumber = $notif->va_numbers[0]->va_number;
        }

        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            $order = Order::where('order_id', $orderId)->first();
            if (!$order) {

                return response()->json(['message' => 'Order not found'], 404);
            }
            $order->midtrans_transaction_status = $transactionStatus;
            $order->midtrans_payment_type = $paymentType;
            $order->midtrans_va_number = $vaNumber;
            $order->midtrans_raw = json_encode($notif);
            $order->save();
        }

        return response()->json(['message' => 'Notification processed']);
    }

    public function updateStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $transactionStatus = $request->input('transaction_status');
        $paymentType = $request->input('payment_type');
        $vaNumber = $request->input('va_number');
        $midtransRaw = $request->input('midtrans_raw');

        $order = Order::where('order_id', $orderId)->first();
        if ($order) {
            $order->midtrans_transaction_status = $transactionStatus;
            $order->midtrans_payment_type = $paymentType;
            $order->midtrans_va_number = $vaNumber;
            $order->midtrans_raw = $midtransRaw;
            $order->save();

            if ($order->midtrans_transaction_status === 'settlement' || $order->midtrans_transaction_status === 'capture') {
                try {
                    Mail::to($order->pemesan_email)->send(new OrderSuccessMail($order));
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim email order sukses: ' . $e->getMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Pembayaran berhasil, namun email gagal dikirim: ' . $e->getMessage()
                    ], 500);
                }
            }

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function orderSuccess(Request $request)
    {
        $order = Order::orderBy('created_at', 'desc')->first();

        if (!$order) {
            return redirect('/')->with('error', 'Order tidak ditemukan.');
        }

        return view('order-success', compact('order'));
    }
}
