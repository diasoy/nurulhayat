<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Detail Order #') . $order->order_id }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
        <!-- Order Info Section -->
        <div class="p-8">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Customer Details -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informasi Pemesan
              </h3>
              <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Nama</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">{{ $order->pemesan_nama }}</span>
                </div>
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Email</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">{{ $order->pemesan_email }}</span>
                </div>
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">No HP</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">{{ $order->pemesan_handphone }}</span>
                </div>
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Alamat</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">{{ $order->pemesan_alamat }}</span>
                </div>
              </div>
            </div>

            <!-- Order Details -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Detail Aqiqah
              </h3>
              <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Nama Anak</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">{{ $order->aqiqoh_nama }}</span>
                </div>
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Pelaksanaan</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">
                    {{ $order->pelaksanaan_hari }}, {{ $order->pelaksanaan_tanggal }}<br>
                    {{ $order->pelaksanaan_jam }}
                  </span>
                </div>
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Tipe Aqiqah</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">{{ $order->type_aqiqah }}</span>
                </div>
                <div class="flex justify-between border-b dark:border-gray-600 py-2">
                  <span class="text-gray-600 dark:text-gray-400">Detail Pesanan</span>
                  <span class="font-medium text-gray-900 dark:text-gray-100">
                    {{ $order->animal_gender }} ({{ $order->quantity }})<br>
                    {{ $order->jumlah_kotakan }} Kotakan
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Payment Status -->
          <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
            <div class="flex justify-between items-center">
              <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status Pembayaran</h3>
              <div class="flex items-center gap-2">
                <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                  Rp{{ number_format($order->total_harga,0,',','.') }}
                </span>
                @if($order->midtrans_transaction_status == 'settlement')
                <span class="px-3 py-1 text-sm font-semibold bg-green-100 text-green-800 rounded-full">Lunas</span>
                @elseif($order->midtrans_transaction_status == 'pending')
                <span class="px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                @else
                <span class="px-3 py-1 text-sm font-semibold bg-red-100 text-red-800 rounded-full">Gagal</span>
                @endif
              </div>
            </div>
          </div>

          <!-- Assignment Form -->
          <form method="POST" action="{{ route('admin.order.send', $order->id) }}" class="mt-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="pesanan_tambahan">
                    Pesanan Tambahan
                  </label>
                  <textarea id="pesanan_tambahan" name="pesanan_tambahan" rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ $order->pesanan_tambahan }}</textarea>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="keterangan_masak">
                    Keterangan Masak
                  </label>
                  <textarea id="keterangan_masak" name="keterangan_masak" rows="3"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ $order->keterangan_masak }}</textarea>
                </div>
              </div>

              <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="supplier_id">
                    Pilih Supplier
                  </label>
                  <select id="supplier_id" name="supplier_id"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $order->supplier_id == $supplier->id ? 'selected' : '' }}>
                      {{ $supplier->name }} ({{ $supplier->email }})
                    </option>
                    @endforeach
                  </select>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="dapur_id">
                    Pilih Dapur
                  </label>
                  <select id="dapur_id" name="dapur_id"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">-- Pilih Dapur --</option>
                    @foreach($dapurs as $dapur)
                    <option value="{{ $dapur->id }}" {{ $order->dapur_id == $dapur->id ? 'selected' : '' }}>
                      {{ $dapur->name }} ({{ $dapur->email }})
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ url('/admin/orders') }}"
                class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                Kembali
              </a>
              <button type="submit"
                class="px-6 py-2 bg-primary text-white rounded-md hover:bg-secondary transition-colors">
                Kirim ke Dapur dan Supplier
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>