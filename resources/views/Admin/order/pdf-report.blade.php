<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Laporan Order</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      color: #333;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .stats-container {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #f8f9fa;
      border-radius: 5px;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
    }

    .stat-item {
      padding: 8px;
    }

    .filters-used {
      margin-bottom: 20px;
      padding: 10px;
      background-color: #edf2f7;
      border-radius: 5px;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .table th,
    .table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .table th {
      background-color: #f8f9fa;
      font-weight: bold;
    }

    .table tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    .status-badge {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 11px;
    }

    .status-settlement {
      background-color: #dcfce7;
      color: #166534;
    }

    .status-pending {
      background-color: #fef9c3;
      color: #854d0e;
    }

    .status-expire,
    .status-cancel {
      background-color: #fee2e2;
      color: #991b1b;
    }
  </style>
</head>

<body>
  <div class="header">
    <h2>Laporan Order Aqiqah Nurul Hayat</h2>
    <p>Tanggal Cetak: {{ now()->format('d M Y H:i') }}</p>
  </div>

  <div class="stats-container">
    <div class="stats-grid">
      <div class="stat-item">
        <strong>Total Orders:</strong> {{ $statistics['total_orders'] }}
      </div>
      <div class="stat-item">
        <strong>Total Pendapatan:</strong> Rp {{ number_format($statistics['total_revenue'], 0, ',', '.') }}
      </div>
      <div class="stat-item">
        <strong>Settlement:</strong> {{ $statistics['settlement_count'] }} order
      </div>
      <div class="stat-item">
        <strong>Pending:</strong> {{ $statistics['pending_count'] }} order
      </div>
    </div>
  </div>

  @if(!empty($statistics['filter_info']))
  <div class="filters-used">
    <strong>Filter yang Digunakan:</strong><br>
    @foreach($statistics['filter_info'] as $filter)
    • {{ $filter }}<br>
    @endforeach
  </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Order ID</th>
        <th>Tanggal</th>
        <th>Nama Pemesan</th>
        <th>Paket</th>
        <th>Menu</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @php $no = 1; @endphp
      @foreach($orders as $order)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $order->order_id }}</td>
        <td>{{ $order->created_at->format('d/m/Y') }}</td>
        <td>{{ $order->pemesan_nama }}</td>
        <td>{{ $order->type_aqiqah }}</td>
        <td>{{ $order->menu_option }}</td>
        <td>{{ $order->quantity }}x</td>
        <td>
          <span class="status-badge status-{{ $order->midtrans_transaction_status }}">
            {{ ucfirst($order->midtrans_transaction_status) }}
          </span>
        </td>
        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="8" style="text-align: right;"><strong>Total Pendapatan:</strong></td>
        <td><strong>Rp {{ number_format($statistics['total_revenue'], 0, ',', '.') }}</strong></td>
      </tr>
    </tfoot>
  </table>

  <div style="margin-top: 20px; font-size: 10px; color: #666;">
    <p>* Status pembayaran: Settlement = Pembayaran selesai, Pending = Menunggu pembayaran, Expire = Pembayaran kadaluarsa, Cancel = Pembayaran dibatalkan</p>
  </div>
</body>

</html>