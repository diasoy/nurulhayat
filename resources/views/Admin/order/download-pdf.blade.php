<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Laporan Order</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 1rem;
    }

    .table th,
    .table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .table th {
      background-color: #f8f9fa;
    }

    .stats {
      margin-bottom: 20px;
    }

    .stats-item {
      margin-bottom: 10px;
    }

    .header {
      margin-bottom: 20px;
    }

    .filters {
      margin-bottom: 20px;
    }

    .filter-item {
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <div class="header">
    <h2>Laporan Order Nurul Hayat</h2>
    <p>Tanggal Cetak: {{ now()->format('d M Y H:i') }}</p>
  </div>

  @if(!empty($statistics['filter_info']))
  <div class="filters">
    <h3>Filter yang Digunakan:</h3>
    @foreach($statistics['filter_info'] as $filter)
    <div class="filter-item">{{ $filter }}</div>
    @endforeach
  </div>
  @endif

  <div class="stats">
    <div class="stats-item">Total Order: {{ $statistics['total_orders'] }}</div>
    <div class="stats-item">Settlement: {{ $statistics['settlement_count'] }}</div>
    <div class="stats-item">Pending: {{ $statistics['pending_count'] }}</div>
    <div class="stats-item">Total Pendapatan: Rp {{ number_format($statistics['total_revenue'], 0, ',', '.') }}</div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Nama Pemesan</th>
        <th>Status Pembayaran</th>
        <th>Status Order</th>
        <th>Status Dapur</th>
        <th>Status Supplier</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{ $order->order_id }}</td>
        <td>{{ $order->pemesan_nama }}</td>
        <td>{{ ucfirst($order->midtrans_transaction_status) }}</td>
        <td>{{ $order->status_order ? 'Terkirim' : 'Belum Terkirim' }}</td>
        <td>{{ $order->status_dapur }}</td>
        <td>{{ $order->status_supplier }}</td>
        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>