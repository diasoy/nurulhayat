<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
      {{ __('Order Supplier') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
        <div class="p-6">
          <h3 class="text-2xl font-bold mb-6 text-green-700 dark:text-green-400 flex items-center gap-2">
            <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Tipe Aqiqah</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Tipe Kambing</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Menu</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Dapur</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($orders as $order)
                <tr class="hover:bg-green-50 dark:hover:bg-green-900 transition cursor-pointer"
                  onclick="window.location='{{ route('supplier.order.show', $order->id) }}'">
                  <td class="px-6 py-4 font-mono text-green-600 dark:text-green-400">{{ $order->order_id }}</td>
                  <td class="px-6 py-4">{{ $order->pemesan_nama }}</td>
                  <td class="px-6 py-4">{{ $order->pelaksanaan_hari }} - {{ $order->pelaksanaan_tanggal }} - {{ $order->pelaksanaan_jam }}</td>
                  <td class="px-6 py-4">{{ $order->type_aqiqah }}</td>
                  <td class="px-6 py-4">{{ $order->animal_gender }}</td>
                  <td class="px-6 py-4">{{ $order->menu_option }}</td>
                  <td class="px-6 py-4">
                    {{ $order->dapur ? $order->dapur->name : '-' }}
                  </td>
                  <td class="px-6 py-4">{{ $order->status_supplier}}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center py-8 text-gray-400">Belum ada order masuk.</td>
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