<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
        {{ __('Dashboard Supplier') }}
      </h2>
      <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ now()->format('d M Y, H:i') }} WIB</span>
      </div>
    </div>
  </x-slot>

  {{-- Include Charts.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
      {{-- Filter Section --}}
      <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 p-6 transition-all duration-300 hover:shadow-xl">
        <form method="GET" action="{{ route('supplier.dashboard') }}" class="space-y-4">
          <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
              <div class="w-2 h-2 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full animate-pulse"></div>
              <label for="filter" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                Periode Laporan
              </label>
            </div>
            <select name="filter" id="filter" onchange="this.form.submit()"
              class="px-4 py-2.5 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm border border-gray-300/50 dark:border-gray-600/50 
                     text-gray-900 dark:text-gray-100 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500
                     transition-all duration-200 hover:shadow-md font-medium">
              <option value="year" {{ $filter === 'year' ? 'selected' : '' }}>📅 Tahun Ini</option>
              <option value="month" {{ $filter === 'month' ? 'selected' : '' }}>🗓️ Bulan Ini</option>
              <option value="week" {{ $filter === 'week' ? 'selected' : '' }}>📊 Minggu Ini</option>
            </select>
          </div>
        </form>
      </div>

      {{-- Main Stats --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Order --}}
        <div class="group bg-gradient-to-br from-blue-50 to-blue-100/50 dark:from-blue-900/20 dark:to-blue-800/10 
                    rounded-2xl shadow-lg border border-blue-200/30 dark:border-blue-700/30 p-6 
                    transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1">
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                <p class="text-sm font-semibold text-blue-700 dark:text-blue-300">Total Order</p>
              </div>
              <p class="text-3xl font-bold text-blue-900 dark:text-blue-100 transition-all duration-300 group-hover:scale-110">
                {{ $statistics['total_order'] }}
              </p>
              <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">Pesanan Masuk</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg transition-all duration-300 group-hover:shadow-2xl group-hover:scale-110">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
            </div>
          </div>
        </div>

        {{-- Total Kambing --}}
        <div class="group bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-900/20 dark:to-emerald-800/10 
                    rounded-2xl shadow-lg border border-emerald-200/30 dark:border-emerald-700/30 p-6 
                    transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1">
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">Total Kambing</p>
              </div>
              <p class="text-3xl font-bold text-emerald-900 dark:text-emerald-100 transition-all duration-300 group-hover:scale-110">
                {{ $statistics['total_kambing'] }}
              </p>
              <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Ekor Dipesan</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-lg transition-all duration-300 group-hover:shadow-2xl group-hover:scale-110">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
          </div>
        </div>

        {{-- Order Diproses --}}
        <div class="group bg-gradient-to-br from-amber-50 to-amber-100/50 dark:from-amber-900/20 dark:to-amber-800/10 
                    rounded-2xl shadow-lg border border-amber-200/30 dark:border-amber-700/30 p-6 
                    transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1">
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                <p class="text-sm font-semibold text-amber-700 dark:text-amber-300">Order Diproses</p>
              </div>
              <p class="text-3xl font-bold text-amber-900 dark:text-amber-100 transition-all duration-300 group-hover:scale-110">
                {{ $statistics['order_proses'] }}
              </p>
              <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">Sedang Dikerjakan</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-lg transition-all duration-300 group-hover:shadow-2xl group-hover:scale-110">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>

        {{-- Order Pending --}}
        <div class="group bg-gradient-to-br from-rose-50 to-rose-100/50 dark:from-rose-900/20 dark:to-rose-800/10 
                    rounded-2xl shadow-lg border border-rose-200/30 dark:border-rose-700/30 p-6 
                    transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1">
          <div class="flex items-center justify-between">
            <div class="space-y-2">
              <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></div>
                <p class="text-sm font-semibold text-rose-700 dark:text-rose-300">Order Pending</p>
              </div>
              <p class="text-3xl font-bold text-rose-900 dark:text-rose-100 transition-all duration-300 group-hover:scale-110">
                {{ $statistics['order_pending'] }}
              </p>
              <p class="text-xs text-rose-600 dark:text-rose-400 font-medium">Menunggu Proses</p>
            </div>
            <div class="p-4 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl shadow-lg transition-all duration-300 group-hover:shadow-2xl group-hover:scale-110">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      {{-- Charts Section --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Order Trend Chart --}}
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 p-8 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
              <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full animate-pulse"></div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Tren Order</h3>
            </div>
            <div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
              <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
              <span>Real-time</span>
            </div>
          </div>
          <div class="relative h-72 p-2">
            <canvas id="orderTrendChart"></canvas>
          </div>
        </div>

        {{-- Menu Analytics Chart --}}
        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 p-8 transition-all duration-300 hover:shadow-xl">
          <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
              <div class="w-3 h-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full animate-pulse"></div>
              <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Analisis Paket</h3>
            </div>
            <div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
              <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
              <span>Top 5</span>
            </div>
          </div>
          <div class="relative h-72 p-2">
            <canvas id="menuAnalyticsChart"></canvas>
          </div>
        </div>
      </div>

      {{-- Order Schedule --}}
      <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 dark:border-gray-700/50 p-8 transition-all duration-300 hover:shadow-xl">
        <div class="flex items-center justify-between mb-8">
          <div class="flex items-center space-x-3">
            <div class="w-3 h-3 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full animate-pulse"></div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Jadwal Order</h3>
          </div>
          <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-full">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <span class="font-medium">{{ now()->format('d M Y') }}</span>
            </div>
          </div>
        </div>

        <div class="space-y-6">
          @forelse($jadwalSupplier as $tanggal => $orders)
          <div class="border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-6 bg-gradient-to-r from-gray-50 to-gray-100/50 dark:from-gray-700/30 dark:to-gray-800/30 transition-all duration-300 hover:shadow-md">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center space-x-4">
                <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full animate-pulse"></div>
                <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                  {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                </h4>
                <span class="text-xs px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 rounded-full font-semibold">
                  {{ $orders->count() }} order
                </span>
              </div>
            </div>
            
            <div class="space-y-3 ml-6">
              @foreach($orders->sortBy('pelaksanaan_jam') as $order)
              <div class="group flex items-center bg-white/70 dark:bg-gray-700/50 backdrop-blur-sm rounded-xl p-4 shadow-sm border border-gray-200/30 dark:border-gray-600/30 transition-all duration-300 hover:shadow-md hover:scale-[1.02]">
                <div class="w-20 text-center">
                  <div class="text-sm font-bold text-indigo-600 dark:text-indigo-400">
                    {{ \Carbon\Carbon::parse($order->pelaksanaan_jam)->format('H:i') }}
                  </div>
                  <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">WIB</div>
                </div>
                <div class="flex-1 ml-4">
                  <div class="font-semibold text-gray-900 dark:text-gray-100 mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                    {{ $order->pemesan_nama }}
                  </div>
                  <div class="text-sm text-gray-600 dark:text-gray-300 flex items-center space-x-2">
                    <span class="bg-gray-200 dark:bg-gray-600 px-2 py-1 rounded-lg text-xs font-medium">
                      {{ $order->type_aqiqah }}
                    </span>
                    <span class="text-xs">•</span>
                    <span class="font-medium">{{ $order->quantity }} ekor</span>
                  </div>
                </div>
                <div class="ml-4">
                  <span class="px-3 py-2 text-xs font-semibold rounded-xl whitespace-nowrap transition-all duration-200
                    {{ $order->status_supplier == 'Terkirim' 
                        ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-300 shadow-emerald-100 dark:shadow-emerald-800/30' 
                        : ($order->status_supplier == 'Diproses'
                            ? 'bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-300 shadow-amber-100 dark:shadow-amber-800/30'
                            : 'bg-rose-100 text-rose-800 dark:bg-rose-800/30 dark:text-rose-300 shadow-rose-100 dark:shadow-rose-800/30') 
                    }} shadow-sm">
                    {{ $order->status_supplier }}
                  </span>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @empty
          <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Tidak ada jadwal order</p>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Semua order sudah selesai atau belum ada yang masuk</p>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  {{-- Charts Initialization --}}
  <script>
    // Enhanced chart styling
    const isDarkMode = document.documentElement.classList.contains('dark');
    const colors = {
      text: isDarkMode ? '#F3F4F6' : '#374151',
      grid: isDarkMode ? '#4B5563' : '#E5E7EB',
      background: isDarkMode ? 'transparent' : 'transparent',
    };

    // Chart defaults
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.plugins.legend.labels.usePointStyle = true;
    Chart.defaults.plugins.legend.labels.padding = 20;

    // Order Trend Chart with enhanced styling
    new Chart(document.getElementById('orderTrendChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: @json($orderTrend->pluck('date')),
        datasets: [{
          label: 'Jumlah Order',
          data: @json($orderTrend->pluck('total')),
          borderColor: '#3B82F6',
          backgroundColor: 'rgba(59, 130, 246, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#3B82F6',
          pointBorderColor: '#ffffff',
          pointBorderWidth: 2,
          pointRadius: 5,
          pointHoverRadius: 8,
          pointHoverBackgroundColor: '#1D4ED8',
          pointHoverBorderColor: '#ffffff',
          pointHoverBorderWidth: 3,
        }, {
          label: 'Total Kambing',
          data: @json($orderTrend->pluck('total_kambing')),
          borderColor: '#10B981',
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#10B981',
          pointBorderColor: '#ffffff',
          pointBorderWidth: 2,
          pointRadius: 5,
          pointHoverRadius: 8,
          pointHoverBackgroundColor: '#047857',
          pointHoverBorderColor: '#ffffff',
          pointHoverBorderWidth: 3,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          intersect: false,
          mode: 'index'
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { 
              color: colors.grid,
              lineWidth: 1
            },
            ticks: { 
              color: colors.text,
              padding: 10
            }
          },
          x: {
            grid: { display: false },
            ticks: { 
              color: colors.text,
              padding: 10
            }
          }
        },
        plugins: {
          legend: {
            labels: { 
              color: colors.text,
              padding: 20,
              font: {
                weight: '600'
              }
            }
          },
          tooltip: {
            backgroundColor: isDarkMode ? 'rgba(31, 41, 55, 0.9)' : 'rgba(255, 255, 255, 0.9)',
            titleColor: colors.text,
            bodyColor: colors.text,
            borderColor: isDarkMode ? '#4B5563' : '#E5E7EB',
            borderWidth: 1,
            cornerRadius: 12,
            padding: 12
          }
        }
      }
    });

    // Menu Analytics Chart with enhanced styling
    new Chart(document.getElementById('menuAnalyticsChart').getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: @json($menuAnalytics->pluck('menu_option')),
        datasets: [{
          data: @json($menuAnalytics->pluck('total_kambing')),
          backgroundColor: [
            'rgba(59, 130, 246, 0.8)',
            'rgba(16, 185, 129, 0.8)', 
            'rgba(245, 158, 11, 0.8)',
            'rgba(239, 68, 68, 0.8)',
            'rgba(139, 92, 246, 0.8)'
          ],
          borderColor: [
            '#3B82F6',
            '#10B981',
            '#F59E0B',
            '#EF4444',
            '#8B5CF6'
          ],
          borderWidth: 3,
          hoverBorderWidth: 4,
          hoverOffset: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: {
          legend: {
            position: 'bottom',
            labels: { 
              color: colors.text,
              padding: 20,
              font: {
                weight: '600'
              }
            }
          },
          tooltip: {
            backgroundColor: isDarkMode ? 'rgba(31, 41, 55, 0.9)' : 'rgba(255, 255, 255, 0.9)',
            titleColor: colors.text,
            bodyColor: colors.text,
            borderColor: isDarkMode ? '#4B5563' : '#E5E7EB',
            borderWidth: 1,
            cornerRadius: 12,
            padding: 12
          }
        }
      }
    });
  </script>
</x-app-layout>