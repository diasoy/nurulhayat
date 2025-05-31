@component('mail::message')
# Pembayaran Berhasil

Terima kasih, pesanan aqiqah Anda telah berhasil diproses.

### Detail Pesanan:
- **Nama Pemesan:** {{ $order->pemesan_nama }}
- **Email:** {{ $order->pemesan_email }}
- **No HP:** {{ $order->pemesan_handphone }}
- **Alamat:** {{ $order->pemesan_alamat }}
- **Nama Anak:** {{ $order->aqiqoh_nama }}
- **Tipe Aqiqah:** {{ $order->type_aqiqah }}
- **Jumlah Kambing:** {{ $order->quantity }}
- **Jumlah Kotakan:** {{ $order->jumlah_kotakan }}
- **Total Harga:** Rp{{ number_format($order->total_harga,0,',','.') }}
- **Status Pembayaran:** {{ $order->midtrans_transaction_status == 'settlement' ? 'Berhasil' : 'Pending' }}

Tim Nurul Hayat akan segera memproses pesanan Anda.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent