<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Admin Dashboard') }}
    </h2>
  </x-slot>

  {{-- Include Charts.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

      {{-- Filter Section --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="space-y-4">
          <div>
            <label for="filter" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
              Periode Laporan
            </label>
            <select name="filter" id="filter" onchange="this.form.submit()"
              class="block w-full sm:w-auto px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 
                     text-gray-900 dark:text-gray-100 rounded-lg shadow-sm
                     focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                     dark:focus:ring-blue-400 dark:focus:border-blue-400
                     transition-colors duration-200">
              <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>Tahun Ini</option>
              <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
              <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
            </select>
          </div>
        </form>
      </div>

      {{-- Main Stats --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 
                    hover:shadow-md dark:hover:shadow-lg transition-all duration-300 group">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Pendapatan</p>
              <p class="text-2xl font-bold text-green-600 dark:text-green-400 mb-2">
                Rp {{ number_format($statistics['total_pendapatan'],0,',','.') }}
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                Rata-rata: <span class="font-semibold text-gray-700 dark:text-gray-300">Rp {{ number_format($statistics['average_order_value'],0,',','.') }}</span>
              </p>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center
                        group-hover:scale-110 transition-transform duration-200">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 
                    hover:shadow-md dark:hover:shadow-lg transition-all duration-300 group">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Order</p>
              <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                {{ $statistics['total_order'] }}
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $statistics['total_customers'] }}</span> pelanggan unik
              </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center
                        group-hover:scale-110 transition-transform duration-200">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 
                    hover:shadow-md dark:hover:shadow-lg transition-all duration-300 group">
          <div class="flex items-center justify-between">
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Order Pending</p>
              <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mb-2">
                {{ $statistics['order_pending'] }}
              </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">
                Butuh <span class="font-semibold text-gray-700 dark:text-gray-300">tindak lanjut</span>
              </p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center
                        group-hover:scale-110 transition-transform duration-200">
              <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>

      {{-- Charts Section --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Tren Pendapatan</h3>
            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
          </div>
          <div class="relative h-64">
            <canvas id="revenueTrendChart"></canvas>
          </div>
        </div>

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

      {{-- Schedules Section --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Dapur Schedule --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Jadwal Dapur</h3>
            <div class="flex items-center space-x-2">
              <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
              <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                {{ now()->format('d M Y') }}
              </span>
            </div>
          </div>

          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($jadwalDapur as $dapurId => $orders)
            <div class="py-4">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                  <span class="font-semibold text-gray-800 dark:text-gray-200">
                    {{ optional($orders->first()->dapur)->name ?? 'Belum Ditentukan' }}
                  </span>
                </div>
                <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 rounded-full">
                  {{ $orders->count() }} order
                </span>
              </div>
              <div class="space-y-2 ml-4">
                @foreach($orders->sortBy('pelaksanaan_tanggal')->sortBy('pelaksanaan_jam') as $order)
                <div class="flex items-center text-sm bg-gray-50 dark:bg-gray-700 rounded p-2">
                  <div class="w-32">
                    <div class="text-gray-600 dark:text-gray-400">
                      {{ $order->pelaksanaan_tanggal->format('d M Y') }}
                    </div>
                    <div class="text-gray-500 dark:text-gray-500 text-xs">
                      {{ \Carbon\Carbon::parse($order->pelaksanaan_jam)->format('H:i') }} WIB
                    </div>
                  </div>
                  <div class="flex-1 ml-2">
                    <div class="text-gray-800 dark:text-gray-200">
                      {{ $order->pemesan_nama }}
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                      {{ $order->menu_option }} ({{ $order->quantity }} )
                    </div>
                  </div>
                  <div>
                    <span class="px-2 py-1 text-xs rounded-full whitespace-nowrap
                            {{ $order->status_order 
                                ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' 
                            }}">
                      {{ $order->status_order ? 'Selesai' : 'Proses' }}
                    </span>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @empty
            <div class="text-gray-500 dark:text-gray-400 text-center py-4">
              Tidak ada jadwal dapur
            </div>
            @endforelse
          </div>
        </div>

        {{-- Supplier Schedule --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Jadwal Supplier</h3>
            <div class="flex items-center space-x-2">
              <div class="w-2 h-2 bg-green-500 rounded-full"></div>
              <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                {{ now()->format('d M Y') }}
              </span>
            </div>
          </div>

          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($jadwalSupplier as $supplierId => $orders)
            <div class="py-4">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                  <span class="font-semibold text-gray-800 dark:text-gray-200">
                    {{ optional($orders->first()->supplier)->name ?? 'Belum Ditentukan' }}
                  </span>
                </div>
                <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 rounded-full">
                  {{ $orders->count() }} order
                </span>
              </div>
              <div class="space-y-2 ml-4">
                @foreach($orders->sortBy('pelaksanaan_tanggal')->sortBy('pelaksanaan_jam') as $order)
                <div class="flex items-center text-sm bg-gray-50 dark:bg-gray-700 rounded p-2">
                  <div class="w-32">
                    <div class="text-gray-600 dark:text-gray-400">
                      {{ $order->pelaksanaan_tanggal->format('d M Y') }}
                    </div>
                    <div class="text-gray-500 dark:text-gray-500 text-xs">
                      {{ \Carbon\Carbon::parse($order->pelaksanaan_jam)->format('H:i') }} WIB
                    </div>
                  </div>
                  <div class="flex-1 ml-2">
                    <div class="text-gray-800 dark:text-gray-200">
                      {{ $order->pemesan_nama }}
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">
                      {{ $order->menu_option }} ({{ $order->quantity }} Kambing)
                    </div>
                  </div>
                  <div>
                    <span class="px-2 py-1 text-xs rounded-full whitespace-nowrap
                            {{ $order->status_supplier 
                                ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' 
                                : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' 
                            }}">
                      {{ $order->status_supplier ? 'Selesai' : 'Proses' }}
                    </span>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @empty
            <div class="text-gray-500 dark:text-gray-400 text-center py-4">
              Tidak ada jadwal supplier
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Custom Styles --}}
  <style>
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.1);
      border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: rgba(0, 0, 0, 0.3);
      border-radius: 3px;
    }

    .dark .custom-scrollbar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
    }
  </style>

  {{-- Charts Initialization with Improved Dark Mode Support --}}
  <script>
    // Detect dark mode more reliably
    function isDarkMode() {
      return document.documentElement.classList.contains('dark') ||
        (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
    }

    // Dynamic color scheme
    function getColorScheme() {
      const darkMode = isDarkMode();
      return {
        textColor: darkMode ? '#F3F4F6' : '#374151',
        gridColor: darkMode ? '#4B5563' : '#E5E7EB',
        backgroundColor: darkMode ? '#1F2937' : '#FFFFFF',
        primaryColor: darkMode ? '#60A5FA' : '#3B82F6',
        secondaryColor: darkMode ? '#34D399' : '#10B981',
        accentColor: darkMode ? '#FBBF24' : '#F59E0B'
      };
    }

    const colors = getColorScheme();

    // Revenue Trend Chart with enhanced styling
    const revenueTrendCtx = document.getElementById('revenueTrendChart').getContext('2d');
    const revenueTrendChart = new Chart(revenueTrendCtx, {
      type: 'line',
      data: {
        labels: @json($revenueTrend -> pluck('date')),
        datasets: [{
          label: 'Pendapatan',
          data: @json($revenueTrend -> pluck('total')),
          borderColor: colors.primaryColor,
          backgroundColor: colors.primaryColor + '20',
          tension: 0.4,
          borderWidth: 3,
          pointBackgroundColor: colors.primaryColor,
          pointBorderColor: colors.backgroundColor,
          pointBorderWidth: 2,
          pointRadius: 6,
          pointHoverRadius: 8,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
          intersect: false,
          mode: 'index'
        },
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: colors.backgroundColor,
            titleColor: colors.textColor,
            bodyColor: colors.textColor,
            borderColor: colors.gridColor,
            borderWidth: 1,
            cornerRadius: 8,
            displayColors: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: colors.gridColor,
              drawBorder: false
            },
            ticks: {
              color: colors.textColor,
              font: {
                size: 12,
                weight: '500'
              },
              callback: function(value) {
                return 'Rp ' + value.toLocaleString('id-ID');
              }
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: colors.textColor,
              font: {
                size: 12,
                weight: '500'
              }
            }
          }
        }
      }
    });

    // Menu Analytics Chart with enhanced styling
    const menuAnalyticsCtx = document.getElementById('menuAnalyticsChart').getContext('2d');
    const menuAnalyticsChart = new Chart(menuAnalyticsCtx, {
      type: 'doughnut',
      data: {
        labels: @json($menuAnalytics -> pluck('menu_option')),
        datasets: [{
          data: @json($menuAnalytics -> pluck('total')),
          backgroundColor: [
            '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
            '#06B6D4', '#84CC16', '#F97316', '#EC4899', '#6366F1'
          ],
          borderColor: colors.backgroundColor,
          borderWidth: 3,
          hoverBorderWidth: 4
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
              color: colors.textColor,
              font: {
                size: 12,
                weight: '500'
              },
              padding: 20,
              usePointStyle: true,
              pointStyle: 'circle'
            }
          },
          tooltip: {
            backgroundColor: colors.backgroundColor,
            titleColor: colors.textColor,
            bodyColor: colors.textColor,
            borderColor: colors.gridColor,
            borderWidth: 1,
            cornerRadius: 8
          }
        }
      }
    });

    // Listen for theme changes and update charts
    function updateChartsTheme() {
      const newColors = getColorScheme();

      // Update revenue chart
      revenueTrendChart.options.scales.y.grid.color = newColors.gridColor;
      revenueTrendChart.options.scales.y.ticks.color = newColors.textColor;
      revenueTrendChart.options.scales.x.ticks.color = newColors.textColor;
      revenueTrendChart.data.datasets[0].borderColor = newColors.primaryColor;
      revenueTrendChart.data.datasets[0].backgroundColor = newColors.primaryColor + '20';
      revenueTrendChart.data.datasets[0].pointBackgroundColor = newColors.primaryColor;
      revenueTrendChart.data.datasets[0].pointBorderColor = newColors.backgroundColor;
      revenueTrendChart.update();

      // Update menu chart
      menuAnalyticsChart.options.plugins.legend.labels.color = newColors.textColor;
      menuAnalyticsChart.data.datasets[0].borderColor = newColors.backgroundColor;
      menuAnalyticsChart.update();
    }

    // Watch for theme changes
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.attributeName === 'class') {
          setTimeout(updateChartsTheme, 100);
        }
      });
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ['class']
    });

    // Also listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateChartsTheme);
  </script>
</x-app-layout>