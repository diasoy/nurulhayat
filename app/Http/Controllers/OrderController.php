<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;
use App\Mail\OrderSuccessMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function midtransToken(Request $request)
    {
        // Set Midtrans config
        Config::$serverKey = 'SB-Mid-server-IvGHB48Hpnyo2y-gxaguMz47';
        Config::$isProduction = false; // Sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $orderId = 'ORDER-' . time();
        $grossAmount = (int) $request->input('summary_total', 0);

        // Simpan order ke database
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

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function midtransNotification(Request $request)
    {
        Config::$serverKey = 'YOUR_MIDTRANS_SERVER_KEY';
        Config::$isProduction = false;

        $notif = new Notification();

        // Ambil data custom dari order_id (misal: ORDER-<timestamp>)
        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;
        $paymentType = $notif->payment_type;
        $vaNumber = null;
        if (isset($notif->va_numbers[0]->va_number)) {
            $vaNumber = $notif->va_numbers[0]->va_number;
        }

        // Cek jika pembayaran sukses
        if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
            // Ambil data order dari database, atau buat baru jika belum ada
            $order = Order::where('order_id', $orderId)->first();
            if (!$order) {
                // Data order dari snap_token harus dikirim ke backend saat generate token,
                // atau bisa juga simpan data order sebelum proses pembayaran.
                // Untuk contoh ini, asumsikan data order sudah disimpan sebelum pembayaran.
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

            // Kirim email hanya jika status sukses
            if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                Mail::to($order->pemesan_email)->send(new OrderSuccessMail($order));
            }

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
