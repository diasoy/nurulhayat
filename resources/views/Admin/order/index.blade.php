<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Admin Orders') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-6">
          <!-- Filter Section -->
          <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
            <form method="GET" action="{{ route('admin.order.index') }}" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search Field -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pencarian</label>
                  <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Order ID, Nama, Email..." class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Filter Periode -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Periode</label>
                  <select name="periode" id="periode" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Periode</option>
                    <option value="today" {{ request('periode') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="this_week" {{ request('periode') == 'this_week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="this_month" {{ request('periode') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="custom" {{ request('periode') == 'custom' ? 'selected' : '' }}>Pilih Tanggal</option>
                  </select>
                </div>

                <!-- Filter Status Pembayaran -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Pembayaran</label>
                  <select name="payment_status" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="settlement" {{ request('payment_status') == 'settlement' ? 'selected' : '' }}>Settlement</option>
                    <option value="expire" {{ request('payment_status') == 'expire' ? 'selected' : '' }}>Expire</option>
                    <option value="cancel" {{ request('payment_status') == 'cancel' ? 'selected' : '' }}>Cancel</option>
                  </select>
                </div>

                <!-- Filter Status Order -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Order</label>
                  <select name="status" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Belum Terkirim</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Terkirim</option>
                  </select>
                </div>
              </div>

              <!-- Custom Date Range -->
              <div id="custom-date-range" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" style="display: {{ request('periode') == 'custom' ? 'grid' : 'none' }}">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai</label>
                  <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Selesai</label>
                  <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                  Filter
                </button>
                <a href="{{ route('admin.order.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                  </svg>
                  Reset
                </a>
                <!-- Download PDF Button -->
                <button type="button" onclick="downloadPDF()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                  <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  Download PDF
                </button>
              </div>
            </form>
          </div>

          <!-- Table Section -->
          <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Pemesan</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Pembayaran</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Perintah Order</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Dapur</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status Supplier</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 dark:text-blue-400">
                    {{ $order->order_id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    {{ $order->pemesan_nama }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                    $statusColor = match($order->midtrans_transaction_status) {
                    'settlement', 'capture' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                    'expire', 'cancel' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                    default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                    };
                    @endphp
                    <span class="px-2 py-1 text-xs rounded-full {{ $statusColor }}">
                      {{ ucfirst($order->midtrans_transaction_status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full {{ $order->status_order ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                      {{ $order->status_order ? 'Terkirim' : 'Belum Terkirim' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full
                      @if ($order->status_dapur == " Belum Diproses")
                      bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                      @elseif ($order->status_dapur == "Diproses")
                      bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                      @else
                      bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                      @endif">
                      @if ($order->status_dapur == "Belum Diproses")
                      Belum diproses
                      @elseif ($order->status_dapur == "Diproses")
                      Diproses
                      @else
                      Terkirim
                      @endif
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full
                      @if ($order->status_supplier == " Belum Diproses")
                      bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                      @elseif ($order->status_supplier == "Diproses")
                      bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                      @else
                      bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                      @endif">
                      @if ($order->status_supplier == "Belum Diproses")
                      Belum diproses
                      @elseif ($order->status_supplier == "Diproses")
                      Diproses
                      @else
                      Terkirim
                      @endif
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                    <a href="{{ route('admin.order.show', $order->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Detail</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
                    Tidak ada order yang ditemukan
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('periode').addEventListener('change', function() {
      const customDateRange = document.getElementById('custom-date-range');
      if (this.value === 'custom') {
        customDateRange.style.display = 'grid';
      } else {
        customDateRange.style.display = 'none';
      }
    });

    function downloadPDF() {
      // Get current URL parameters to maintain filters
      const urlParams = new URLSearchParams(window.location.search);

      // Create form data
      const formData = new FormData();

      // Add all current filters to the form data
      for (const [key, value] of urlParams) {
        formData.append(key, value);
      }

      // Create temporary form for PDF download
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '{{ route("admin.order.download-pdf") }}';
      form.target = '_blank';

      // Add CSRF token
      const csrfToken = document.createElement('input');
      csrfToken.type = 'hidden';
      csrfToken.name = '_token';
      csrfToken.value = '{{ csrf_token() }}';
      form.appendChild(csrfToken);

      // Add all parameters as hidden inputs
      for (const [key, value] of formData) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
      }

      document.body.appendChild(form);
      form.submit();
      document.body.removeChild(form);
    }

    function downloadPDF() {
      // Get current URL parameters to maintain filters
      const urlParams = new URLSearchParams(window.location.search);

      // Create form data
      const formData = new FormData();

      // Add all current filters to the form data
      for (const [key, value] of urlParams) {
        formData.append(key, value);
      }

      // Create temporary form for PDF download
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '{{ route("admin.order.download-pdf") }}';

      // Add CSRF token
      const csrfToken = document.createElement('input');
      csrfToken.type = 'hidden';
      csrfToken.name = '_token';
      csrfToken.value = '{{ csrf_token() }}';
      form.appendChild(csrfToken);

      // Add all parameters as hidden inputs
      for (const [key, value] of formData) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
      }

      document.body.appendChild(form);
      form.submit();
      document.body.removeChild(form);
    }
  </script>
</x-app-layout>