<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pemesanan Aqiqah Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-green-50 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
        <h2 class="text-2xl font-bold text-green-700 mb-2 text-center">Pembayaran Berhasil</h2>
        <p class="text-gray-700 mb-4 text-center">Terima kasih, pesanan aqiqah Anda telah berhasil diproses.</p>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Detail Pesanan:</h3>
        <ul class="mb-6 text-gray-700 space-y-1">
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
        <p class="text-gray-600 mb-6 text-center">Tim Nurul Hayat akan segera memproses pesanan Anda.</p>
        <div class="flex justify-center">
            <a href="{{ url('/dashboard') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded transition">Kembali ke Dashboard</a>
        </div>
    </div>
</body>

</html>