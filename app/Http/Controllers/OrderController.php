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
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', '%' . $search . '%')
                    ->orWhere('pemesan_nama', 'like', '%' . $search . '%')
                    ->orWhere('pemesan_email', 'like', '%' . $search . '%')
                    ->orWhere('pemesan_handphone', 'like', '%' . $search . '%')
                    ->orWhere('aqiqoh_nama', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $today = Carbon::now();

            switch ($request->periode) {
                case 'today':
                    $query->whereDate('created_at', $today->format('Y-m-d'));
                    break;
                case 'this_week':
                    $query->whereBetween('created_at', [
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
                    $query->whereMonth('created_at', $today->month)
                        ->whereYear('created_at', $today->year);
                    break;
                case 'next_month':
                    $nextMonth = $today->copy()->addMonth();
                    $query->whereMonth('pelaksanaan_tanggal', $nextMonth->month)
                        ->whereYear('pelaksanaan_tanggal', $nextMonth->year);
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('created_at', [
                            $request->start_date,
                            $request->end_date
                        ]);
                    }
                    break;
            }
        }

        // Filter berdasarkan status pembayaran
        if ($request->filled('payment_status')) {
            $query->where('midtrans_transaction_status', $request->payment_status);
        }

        // Filter berdasarkan status order
        if ($request->filled('status')) {
            $query->where('status_order', $request->status == 'Terkirim' ? 1 : 0);
        }

        $orders = $query->latest()->get();
        return view('Admin.order.index', compact('orders'));
    }

    public function downloadPdf(Request $request)
    {
        // Gunakan query yang sama dengan index
        $query = Order::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', '%' . $search . '%')
                    ->orWhere('pemesan_nama', 'like', '%' . $search . '%')
                    ->orWhere('pemesan_email', 'like', '%' . $search . '%')
                    ->orWhere('pemesan_handphone', 'like', '%' . $search . '%')
                    ->orWhere('aqiqoh_nama', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan periode
        if ($request->filled('periode')) {
            $today = Carbon::now();

            switch ($request->periode) {
                case 'today':
                    $query->whereDate('created_at', $today->format('Y-m-d'));
                    break;
                case 'this_week':
                    $query->whereBetween('created_at', [
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
                    $query->whereMonth('created_at', $today->month)
                        ->whereYear('created_at', $today->year);
                    break;
                case 'next_month':
                    $nextMonth = $today->copy()->addMonth();
                    $query->whereMonth('pelaksanaan_tanggal', $nextMonth->month)
                        ->whereYear('pelaksanaan_tanggal', $nextMonth->year);
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('created_at', [
                            $request->start_date,
                            $request->end_date
                        ]);
                    }
                    break;
            }
        }

        // Filter berdasarkan status pembayaran
        if ($request->filled('payment_status')) {
            $query->where('midtrans_transaction_status', $request->payment_status);
        }

        // Filter berdasarkan status order
        if ($request->filled('status')) {
            $query->where('status_order', $request->status == 'Terkirim' ? 1 : 0);
        }

        $orders = $query->latest()->get();

        // Statistik untuk laporan
        $statistics = [
            'total_orders' => $orders->count(),
            'settlement_count' => $orders->where('midtrans_transaction_status', 'settlement')->count(),
            'pending_count' => $orders->where('midtrans_transaction_status', 'pending')->count(),
            'total_revenue' => $orders->where('midtrans_transaction_status', 'settlement')->sum('total_harga'),
            'filter_info' => $this->getFilterInfo($request)
        ];

        $pdf = Pdf::loadView('Admin.order.pdf-report', compact('orders', 'statistics'))
            ->setPaper('a4', 'landscape');

        $filename = 'laporan-order-' . date('Y-m-d-H-i-s') . '.pdf';

        return $pdf->download($filename);
    }

    private function getFilterInfo($request)
    {
        $filters = [];

        if ($request->filled('search')) {
            $filters[] = 'Pencarian: ' . $request->search;
        }

        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'today':
                    $filters[] = 'Periode: Hari Ini';
                    break;
                case 'this_week':
                    $filters[] = 'Periode: Minggu Ini';
                    break;
                case 'this_month':
                    $filters[] = 'Periode: Bulan Ini';
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $filters[] = 'Periode: ' . $request->start_date . ' - ' . $request->end_date;
                    }
                    break;
            }
        }

        if ($request->filled('payment_status')) {
            $filters[] = 'Status Pembayaran: ' . ucfirst($request->payment_status);
        }

        if ($request->filled('status')) {
            $filters[] = 'Status Order: ' . ($request->status == '1' ? 'Terkirim' : 'Belum Terkirim');
        }

        return $filters;
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

        // $request->validate([
        //     'pemesan_nama' => 'required',
        //     'pemesan_email' => 'required|email',
        //     'pemesan_handphone' => 'required',
        //     'pemesan_alamat' => 'required',
        //     'aqiqoh_nama' => 'required',
        //     'aqiqoh_binbinti' => 'required',
        //     'aqiqoh_jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        //     'aqiqoh_tempat_lahir' => 'required',
        //     'aqiqoh_tanggal_lahir' => 'required|date',
        //     'pelaksanaan_hari' => 'required',
        //     'pelaksanaan_tanggal' => 'required|date',
        //     'pelaksanaan_jam' => 'required',
        //     'pelaksanaan_alamat' => 'required',
        //     'type_aqiqah' => 'required',
        //     'menu_option' => 'required',
        //     'jumlah_kotakan' => 'required|numeric|min:1',
        //     'matang_tanggal' => 'required|date',
        //     'matang_jam' => 'required',
        //     'supplier_id' => 'required|exists:users,id',
        //     'dapur_id' => 'required|exists:users,id',
        // ]);
        try {
            $order = Order::findOrFail($id);
            $jamMatang = null;
            if ($request->matang_tanggal && $request->matang_jam) {
                $jamMatang = Carbon::createFromFormat(
                    'Y-m-d H:i',
                    $request->matang_tanggal . ' ' . $request->matang_jam
                );
            }
            $order->update([
                'pemesan_nama' => $request->pemesan_nama,
                'pemesan_email' => $request->pemesan_email,
                'pemesan_handphone' => $request->pemesan_handphone,
                'pemesan_alamat' => $request->pemesan_alamat,
                'aqiqoh_nama' => $request->aqiqoh_nama,
                'aqiqoh_binbinti' => $request->aqiqoh_binbinti,
                'aqiqoh_jenis_kelamin' => $request->aqiqoh_jenis_kelamin,
                'aqiqoh_tempat_lahir' => $request->aqiqoh_tempat_lahir,
                'aqiqoh_tanggal_lahir' => $request->aqiqoh_tanggal_lahir,
                'pelaksanaan_hari' => $request->pelaksanaan_hari,
                'pelaksanaan_tanggal' => $request->pelaksanaan_tanggal,
                'pelaksanaan_jam' => $request->pelaksanaan_jam,
                'pelaksanaan_alamat' => $request->pelaksanaan_alamat,
                'type_aqiqah' => $request->type_aqiqah,
                'menu_option' => $request->menu_option,
                'jumlah_kotakan' => $request->jumlah_kotakan,
                'status_order' => true,
                'pesanan_tambahan' => $request->pesanan_tambahan,
                'keterangan_masak' => $request->keterangan_masak,
                'supplier_id' => $request->supplier_id,
                'dapur_id' => $request->dapur_id,
                'jam_matang' => $jamMatang,
            ]);

            return redirect()->route('admin.order.show', $order->id)
                ->with('success', 'Order berhasil diperbarui dan dikirim ke dapur dan supplier.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
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
