<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
      {{ __('Detail Order Supplier') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg p-8">
        <h3 class="text-2xl font-bold mb-6 text-green-700 dark:text-green-400 flex items-center gap-2">
          <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
          </svg>
          Detail Order Masuk
        </h3>
        <ul class="mb-6 text-gray-700 dark:text-gray-100 space-y-2">
          <li><b>Order ID:</b> {{ $order->order_id }}</li>
          <li><b>Nama Pemesan:</b> {{ $order->pemesan_nama }}</li>
          <li><b>No HP:</b> {{ $order->pemesan_handphone }}</li>
          <li><b>Alamat:</b> {{ $order->pemesan_alamat }}</li>
          <li><b>Nama Anak:</b> {{ $order->aqiqoh_nama }}</li>
          <li><b>Tipe Aqiqah:</b> {{ $order->type_aqiqah }}</li>
          <li><b>Jumlah Kambing:</b> {{ $order->quantity }}</li>
          <li><b>Jumlah Kotakan:</b> {{ $order->jumlah_kotakan }}</li>
          <li><b>Keterangan Masak:</b> {{ $order->keterangan_masak ?? '-' }}</li>
          <li><b>Pesanan Tambahan:</b> {{ $order->pesanan_tambahan ?? '-' }}</li>
        </ul>
        <div class="mb-6">
          <label for="status_supplier" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
            Status Pengiriman Supplier
          </label>
          <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
            <select id="status_supplier" class="w-full md:w-1/2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 shadow-sm"
              data-order-id="{{ $order->id }}">
              <option value="Belum Diproses" {{ $order->status_supplier == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
              <option value="Diproses" {{ $order->status_supplier == 'Diproses' ? 'selected' : '' }}>Diproses</option>
              <option value="Terkirim" {{ $order->status_supplier == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
            </select>
            <button id="btn-update-status" type="button"
              class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow transition">
              Update Status
            </button>
          </div>
          <div id="status-message" class="mt-2 text-sm"></div>
        </div>
        <div class="flex justify-center mt-8">
          <a href="{{ route('supplier.orders') }}"
            class="inline-block bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded transition">
            Kembali ke Daftar Order
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('btn-update-status').addEventListener('click', function() {
      const select = document.getElementById('status_supplier');
      const orderId = select.dataset.orderId;
      const status = select.value;
      const message = document.getElementById('status-message');
      const button = this;

      select.disabled = true;
      button.disabled = true;

      message.textContent = 'Memperbarui status...';
      message.className = 'mt-2 text-sm text-gray-600';

      fetch(`/supplier/orders/${orderId}/update-status`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            status_supplier: status
          })
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            message.textContent = 'Status berhasil diupdate!';
            message.className = 'mt-2 text-sm text-green-600';

            setTimeout(() => {
              window.location.reload();
            }, 1000);
          } else {
            throw new Error('Update failed');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          message.textContent = 'Gagal mengupdate status. Silakan coba lagi.';
          message.className = 'mt-2 text-sm text-red-600';
        })
        .finally(() => {
          select.disabled = false;
          button.disabled = false;
        });
    });
  </script>
</x-app-layout>