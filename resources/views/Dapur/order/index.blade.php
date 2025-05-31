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
          <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow">
            <table class="min-w-full bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Nama Pemesan</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Pelaksanaan</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Keterangan Masak</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Pesanan Tambahan</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($orders as $order)
                <tr class="hover:bg-yellow-50 dark:hover:bg-yellow-900 transition cursor-pointer"
                  onclick="window.location='{{ route('dapur.order.show', $order->id) }}'">
                  <td class="px-6 py-4 font-mono text-yellow-600 dark:text-yellow-400">{{ $order->order_id }}</td>
                  <td class="px-6 py-4">{{ $order->pemesan_nama }}</td>
                  <td class="px-6 py-4">{{ $order->pelaksanaan_hari }} - {{ $order->pelaksanaan_tanggal }} - {{ $order->pelaksanaan_jam }}</td>
                  <td class="px-6 py-4">
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
                  <td class="px-6 py-4">{{ $order->keterangan_masak ?? '-' }}</td>
                  <td class="px-6 py-4">{{ $order->pesanan_tambahan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center py-8 text-gray-400">Belum ada order masuk.</td>
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