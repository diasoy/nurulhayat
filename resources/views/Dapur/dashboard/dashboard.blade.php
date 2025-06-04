<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard Dapur') }}
    </h2>
  </x-slot>

  {{-- Include Charts.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

      {{-- Filter Section --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="GET" action="{{ route('dapur.dashboard') }}" class="space-y-4">
          <div>
            <label for="filter" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
              Periode Laporan
            </label>
            <select name="filter" id="filter" onchange="this.form.submit()"
              class="block w-full sm:w-auto px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 
           text-gray-900 dark:text-gray-100 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500">
              <option value="year" {{ $filter === 'year' ? 'selected' : '' }}>Tahun Ini</option>
              <option value="month" {{ $filter === 'month' ? 'selected' : '' }}>Bulan Ini</option>
              <option value="week" {{ $filter === 'week' ? 'selected' : '' }}>Minggu Ini</option>
            </select>
          </div>
        </form>
      </div>

      {{-- Main Stats --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Order --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Order</p>
              <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                {{ $statistics['total_order'] }}
              </p>
            </div>
            <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-full">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
            </div>
          </div>
        </div>

        {{-- Order Selesai --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Order Selesai</p>
              <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                {{ $statistics['order_selesai'] }}
              </p>
            </div>
            <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-full">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
          </div>
        </div>

        {{-- Order Diproses --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Order Diproses</p>
              <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                {{ $statistics['order_proses'] }}
              </p>
            </div>
            <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-full">
              <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>

        {{-- Order Pending --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Order Pending</p>
              <p class="text-2xl font-bold text-red-600 dark:text-red-400">
                {{ $statistics['order_pending'] }}
              </p>
            </div>
            <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-full">
              <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      {{-- Charts Section --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Order Trend Chart --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Tren Order</h3>
            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
          </div>
          <div class="relative h-64">
            <canvas id="orderTrendChart"></canvas>
          </div>
        </div>

        {{-- Menu Analytics Chart --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Analisis Menu</h3>
            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
          </div>
          <div class="relative h-64">
            <canvas id="menuAnalyticsChart"></canvas>
          </div>
        </div>
      </div>

      {{-- Order Schedule --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Jadwal Order</h3>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
              {{ now()->format('d M Y') }}
            </span>
          </div>
        </div>

        <div class="divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($jadwalDapur as $tanggal => $orders)
          <div class="py-4">
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-center space-x-3">
                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                <span class="font-semibold text-gray-800 dark:text-gray-200">
                  {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                </span>
              </div>
              <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 rounded-full">
                {{ $orders->count() }} order
              </span>
            </div>
            <div class="space-y-2 ml-4">
              @foreach($orders->sortBy('pelaksanaan_jam') as $order)
              <div class="flex items-center text-sm bg-gray-50 dark:bg-gray-700 rounded p-2">
                <div class="w-32">
                  <div class="text-gray-500 dark:text-gray-400">
                    {{ \Carbon\Carbon::parse($order->pelaksanaan_jam)->format('H:i') }} WIB
                  </div>
                </div>
                <div class="flex-1">
                  <div class="text-gray-800 dark:text-gray-200">
                    {{ $order->pemesan_nama }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $order->menu_option }} ({{ $order->quantity }})
                  </div>
                </div>
                <div>
                  <span class="px-2 py-1 text-xs rounded-full whitespace-nowrap
                                        {{ $order->status_dapur == 'Terkirim' 
                                            ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                            : ($order->status_dapur == 'Diproses'
                                                ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100'
                                                : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100') 
                                        }}">
                    {{ $order->status_dapur }}
                  </span>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @empty
          <div class="text-gray-500 dark:text-gray-400 text-center py-4">
            Tidak ada jadwal order
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  {{-- Charts Initialization --}}
  <script>
    const isDarkMode = document.documentElement.classList.contains('dark');
    const colors = {
      text: isDarkMode ? '#F3F4F6' : '#374151',
      grid: isDarkMode ? '#4B5563' : '#E5E7EB',
      background: isDarkMode ? '#1F2937' : '#FFFFFF',
    };

    // Order Trend Chart
    new Chart(document.getElementById('orderTrendChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: @json($orderTrend -> pluck('date')),
        datasets: [{
          label: 'Jumlah Order',
          data: @json($orderTrend -> pluck('total')),
          borderColor: '#3B82F6',
          backgroundColor: '#3B82F660',
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: colors.grid
            },
            ticks: {
              color: colors.text
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: colors.text
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              color: colors.text
            }
          }
        }
      }
    });

    // Menu Analytics Chart
    new Chart(document.getElementById('menuAnalyticsChart').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: @json($menuAnalytics -> pluck('menu_option')),
        datasets: [{
          data: @json($menuAnalytics -> pluck('total')),
          backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
          borderColor: colors.background,
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: colors.text
            }
          }
        }
      }
    });
  </script>
</x-app-layout>