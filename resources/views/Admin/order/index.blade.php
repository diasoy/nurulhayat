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
          <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100 flex items-center gap-2">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            Daftar Orders
          </h3>
          <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow">
            <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nama Pemesan</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Email</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Pembayaran</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                  <td class="px-6 py-4 whitespace-nowrap font-mono text-blue-600 dark:text-blue-400">{{ $order->order_id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $order->pemesan_nama }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $order->pemesan_email }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                    $statusColor = match($order->midtrans_transaction_status) {
                    'settlement', 'capture' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                    'expire', 'cancel' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                    default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'
                    };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                      {{ ucfirst($order->midtrans_transaction_status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                    $statusClass = match($order->status_order) {
                    1 => 'text-green-600 dark:text-green-400',
                    0 => 'text-red-600 dark:text-red-400',
                    default => 'text-gray-600 dark:text-gray-400'
                    };
                    @endphp
                    <span class="{{ $statusClass }} font-semibold">
                      {{ $order->status_order == 1 ? 'Terkirim' : 'Belum Terkirim' }}
                    </span>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('admin.order.show', $order->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">DETAIL</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center py-8 text-gray-400 dark:text-gray-500">Belum ada order.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>