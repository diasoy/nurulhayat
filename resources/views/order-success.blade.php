<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Pemesanan Aqiqah Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>

<body class="antialiased bg-gradient-to-br from-primary-light/10 to-white dark:from-primary-dark dark:to-gray-900 min-h-screen flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 max-w-lg w-full">
        <div class="flex justify-center mb-4">
            <svg class="w-16 h-16 text-primary dark:text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" class="text-primary/20 dark:text-secondary/20" fill="currentColor" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" class="text-white" stroke="white" stroke-width="2" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-primary dark:text-secondary mb-2 text-center">Pembayaran Berhasil</h2>
        <p class="text-gray-700 dark:text-gray-300 mb-4 text-center">Terima kasih, pesanan aqiqah Anda telah berhasil diproses.</p>
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Detail Pesanan:</h3>
        <ul class="mb-6 text-gray-700 dark:text-gray-300 space-y-1">
            <li><b>Nama Pemesan:</b> {{ $order->pemesan_nama }}</li>
            <li><b>Email:</b> {{ $order->pemesan_email }}</li>
            <li><b>No HP:</b> {{ $order->pemesan_handphone }}</li>
            <li><b>Alamat:</b> {{ $order->pemesan_alamat }}</li>
            <li><b>Nama Anak:</b> {{ $order->aqiqoh_nama }}</li>
            <li><b>Tipe Aqiqah:</b> {{ $order->type_aqiqah }}</li>
            <li><b>Jumlah Kambing:</b> {{ $order->quantity }}</li>
            <li><b>Jumlah Kotakan:</b> {{ $order->jumlah_kotakan }}</li>
            <li><b>Total Harga:</b> Rp{{ number_format($order->total_harga,0,',','.') }}</li>
            <li><b>Status Pembayaran:</b> {{ $order->midtrans_transaction_status == 'settlement' ? 'Berhasil' : 'Pending' }}</li>
        </ul>
        <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">Tim Nurul Hayat akan segera memproses pesanan Anda.</p>
        <div class="flex justify-center">
            <a href="{{ url('/') }}" class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded transition">Kembali ke Dashboard</a>
        </div>
    </div>
</body>

</html>