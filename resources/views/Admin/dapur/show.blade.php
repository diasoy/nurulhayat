<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      Detail User Dapur
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <!-- Profile Card -->
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg mb-6">
        <div class="p-6">
          <div class="flex items-center">
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
              <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
            </div>
          </div>
        </div>
      </div>


      <!-- Schedule Table -->
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
        <div class="p-6">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Jadwal Dapur</h3>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Order ID
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Tanggal Pelaksanaan
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Jam Matang
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Tipe Aqiqah
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Gender Hewan
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Jumlah Kotakan
                  </th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                @forelse($user->dapurOrders as $order)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $order->order_id }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $order->pelaksanaan_tanggal->format('d M Y') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $order->jam_matang ? $order->jam_matang->format('H:i') : '-' }}
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                    {{ $order->menu_option }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $order->animal_gender }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $order->jumlah_kotakan }} kotak
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap
                          @switch($order->status_dapur)
                              @case('Belum Terkirim')
                                  bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                  @break
                              @case('Diproses')
                                  bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                  @break
                              @case('Terkirim')
                                  bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                  @break
                              @default
                                  bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                          @endswitch">
                      {{ $order->status_dapur ?: 'Belum Terkirim' }}
                    </span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                    Tidak ada jadwal dapur yang tersedia
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="mt-6">
        <a href="{{ route('admin.dapur.index') }}"
          class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
          Kembali
        </a>
      </div>
    </div>
  </div>
</x-app-layout>