<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pemesanan Aqiqah Berhasil</title>
</head>

<body>
    <h2>Pembayaran Berhasil</h2>
    <p>Terima kasih, pesanan aqiqah Anda telah berhasil diproses.</p>
    <h3>Detail Pesanan:</h3>
    <ul>
        <li><b>Nama Pemesan:</b> {{ $order->pemesan_nama }}</li>
        <li><b>Email:</b> {{ $order->pemesan_email }}</li>
        <li><b>No HP:</b> {{ $order->pemesan_handphone }}</li>
        <li><b>Alamat:</b> {{ $order->pemesan_alamat }}</li>
        <li><b>Nama Anak:</b> {{ $order->aqiqoh_nama }}</li>
        <li><b>Tipe Aqiqah:</b> {{ $order->type_aqiqah }}</li>
        <li><b>Jumlah Kambing:</b> {{ $order->quantity }}</li>
        <li><b>Jumlah Kotakan:</b> {{ $order->jumlah_kotakan }}</li>
        <li><b>Total Harga:</b> Rp{{ number_format($order->total_harga,0,',','.') }}</li>
        <li><b>Status Pembayaran:</b> {{ $order->midtrans_transaction_status }}</li>
    </ul>
    <p>Tim Nurul Hayat akan segera memproses pesanan Anda.</p>
</body>

</html>