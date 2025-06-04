<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
      {{ __('Order Dapur') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-6">
          <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            Daftar Order Masuk
          </h3>

          <!-- Filter Section -->
          <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
            <form method="GET" action="{{ route('dapur.orders') }}" class="space-y-4">
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Filter Periode -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Periode</label>
                  <select name="periode" id="periode" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    <option value="">Semua Periode</option>
                    <option value="today" {{ request('periode') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="this_week" {{ request('periode') == 'this_week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="next_week" {{ request('periode') == 'next_week' ? 'selected' : '' }}>Minggu Depan</option>
                    <option value="this_month" {{ request('periode') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="next_month" {{ request('periode') == 'next_month' ? 'selected' : '' }}>Bulan Depan</option>
                    <option value="custom" {{ request('periode') == 'custom' ? 'selected' : '' }}>Pilih Tanggal</option>
                  </select>
                </div>

                <!-- Filter Hari -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Hari</label>
                  <select name="hari" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    <option value="">Semua Hari</option>
                    <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ request('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    <option value="Minggu" {{ request('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                  </select>
                </div>

                <!-- Filter Status -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Status</label>
                  <select name="status" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                    <option value="">Semua Status</option>
                    <option value="Belum Diproses" {{ request('status') == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Terkirim" {{ request('status') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                  </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-end space-x-2">
                  <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-200">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                  </button>
                  <a href="{{ route('dapur.orders') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Reset
                  </a>
                </div>
              </div>

              <!-- Custom Date Range (Hidden by default) -->
              <div id="custom-date-range" class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" style="display: {{ request('periode') == 'custom' ? 'grid' : 'none' }}">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai</label>
                  <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Selesai</label>
                  <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                </div>
              </div>
            </form>
          </div>

          <!-- Results Summary -->
          @if(request()->hasAny(['periode', 'hari', 'status', 'start_date', 'end_date']))
          <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900 rounded-lg">
            <p class="text-sm text-blue-800 dark:text-blue-200">
              <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              Menampilkan {{ $orders->count() }} order
              @if(request('periode'))
              - Periode: {{ ucfirst(str_replace('_', ' ', request('periode'))) }}
              @endif
              @if(request('hari'))
              - Hari: {{ request('hari') }}
              @endif
              @if(request('status'))
              - Status: {{ request('status') }}
              @endif
              @if(request('start_date') && request('end_date'))
              - Tanggal: {{ request('start_date') }} s/d {{ request('end_date') }}
              @endif
            </p>
          </div>
          @endif

          <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow">
            <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nama Pemesan</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Pelaksanaan</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status Supplier</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Jam Matang</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($orders as $order)
                <tr class="hover:bg-yellow-50 dark:hover:bg-yellow-900 transition cursor-pointer"
                  onclick="window.location='{{ route('dapur.order.show', $order->id) }}'">
                  <td class="px-6 py-4 font-mono text-yellow-600 dark:text-yellow-400">{{ $order->order_id }}</td>
                  <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $order->pemesan_nama }}</td>
                  <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                    <div class="text-sm">
                      <div class="font-medium">{{ $order->pelaksanaan_hari }}</div>
                      <div class="text-gray-500">{{ \Carbon\Carbon::parse($order->pelaksanaan_tanggal)->format('d/m/Y') }} - {{ $order->pelaksanaan_jam }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                    @if($order->status_dapur == 'Belum Diproses')
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                      {{ $order->status_dapur }}
                    </span>
                    @elseif($order->status_dapur == 'Diproses')
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                      {{ $order->status_dapur }}
                    </span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                      {{ $order->status_dapur }}
                    </span>
                    @endif
                  </td>
                  <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                    @if($order->status_supplier == 'Belum Diproses')
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                      {{ $order->status_supplier }}
                    </span>
                    @elseif($order->status_supplier == 'Diproses')
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                      {{ $order->status_supplier }}
                    </span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                      {{ $order->status_supplier }}
                    </span>
                    @endif
                  </td>
                  <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $order->jam_matang ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center py-8 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    @if(request()->hasAny(['periode', 'hari', 'status', 'start_date', 'end_date']))
                    Tidak ada order yang sesuai dengan filter yang dipilih.
                    @else
                    Belum ada order masuk.
                    @endif
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
  </script>
</x-app-layout>