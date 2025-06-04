<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
      {{ __('Detail Order #') . $order->order_id }}
    </h2>
  </x-slot>

  <div x-data="{ show: @if(session('success')) true @else false @endif }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3000)"
    class="fixed top-4 right-4 z-50">
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg">
      <div class="flex items-center">
        <div class="py-1">
          <svg class="w-6 h-6 mr-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div>
          <p class="font-bold">Sukses!</p>
          <p>{{ session('success') }}</p>
        </div>
        <div class="ml-auto pl-3">
          <div class="-mx-1.5 -my-1.5">
            <button @click="show = false" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none">
              <span class="sr-only">Dismiss</span>
              <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg">
        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
          <div class="font-bold">Terjadi kesalahan:</div>
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('admin.order.send', $order->id) }}" class="p-8">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Customer Details -->
            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
              <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informasi Pemesan
              </h3>
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
                  <input type="text" name="pemesan_nama" value="{{ $order->pemesan_nama }}"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                  <input type="email" name="pemesan_email" value="{{ $order->pemesan_email }}"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No HP</label>
                  <input type="text" name="pemesan_handphone" value="{{ $order->pemesan_handphone }}"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                  <textarea name="pemesan_alamat" rows="3"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">{{ $order->pemesan_alamat }}</textarea>
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
              <div class="space-y-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Anak</label>
                  <input type="text" name="aqiqoh_nama" value="{{ $order->aqiqoh_nama }}"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bin/Binti</label>
                    <input type="text" name="aqiqoh_binbinti" value="{{ $order->aqiqoh_binbinti }}"
                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
                    <select name="aqiqoh_jenis_kelamin"
                      class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                      <option value="Laki-laki" {{ $order->aqiqoh_jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="Perempuan" {{ $order->aqiqoh_jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tempat Lahir</label>
                  <input type="text" name="aqiqoh_tempat_lahir" value="{{ $order->aqiqoh_tempat_lahir }}"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                  <input type="date" name="aqiqoh_tanggal_lahir" value="{{ $order->aqiqoh_tanggal_lahir }}"
                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                </div>
              </div>
            </div>
          </div>

          <!-- Pelaksanaan Details -->
          <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Detail Pelaksanaan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Hari</label>
                <select name="pelaksanaan_hari"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                  @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                  <option value="{{ $hari }}" {{ $order->pelaksanaan_hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                <input type="date"
                  name="pelaksanaan_tanggal"
                  value="{{ $order->pelaksanaan_tanggal ? $order->pelaksanaan_tanggal->format('Y-m-d') : '' }}"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jam</label>
                <input type="time" name="pelaksanaan_jam" value="{{ $order->pelaksanaan_jam }}"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
              </div>
            </div>
            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat Pelaksanaan</label>
              <textarea name="pelaksanaan_alamat" rows="3"
                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">{{ $order->pelaksanaan_alamat }}</textarea>
            </div>
          </div>

          <!-- Package Details -->
          <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Detail Paket</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe Aqiqah</label>
                <select name="animal_gender" id="animal_gender"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                  <option value="Betina" {{ $order->animal_gender == 'Betina' ? 'selected' : '' }}>Betina</option>
                  <option value="Jantan" {{ $order->animal_gender == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Paket Aqiqah</label>
                <select name="type_aqiqah" id="type_aqiqah"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                  <option value="PLATINUM" {{ $order->type_aqiqah == 'PLATINUM' ? 'selected' : '' }}>PLATINUM</option>
                  <option value="ISTIMEWA" {{ $order->type_aqiqah == 'ISTIMEWA' ? 'selected' : '' }}>ISTIMEWA</option>
                  <option value="SUPER" {{ $order->type_aqiqah == 'SUPER' ? 'selected' : '' }}>SUPER</option>
                  <option value="PUAS" {{ $order->type_aqiqah == 'PUAS' ? 'selected' : '' }}>PUAS</option>
                  <option value="TASYAKURAN" {{ $order->type_aqiqah == 'TASYAKURAN' ? 'selected' : '' }}>TASYAKURAN</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilihan Menu</label>
                <div class="space-y-2 mt-2">
                  <div class="flex items-center">
                    <input type="radio" id="menu2" name="menu_option" value="2 Menu"
                      {{ $order->menu_option == '2 Menu' ? 'checked' : '' }}
                      class="h-4 w-4 text-primary border-gray-300 focus:ring-primary">
                    <label for="menu2" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      2 Menu
                      <span class="text-xs text-gray-500">(Lebih banyak porsi)</span>
                    </label>
                  </div>
                  <div class="flex items-center">
                    <input type="radio" id="menu3" name="menu_option" value="3 Menu"
                      {{ $order->menu_option == '3 Menu' ? 'checked' : '' }}
                      class="h-4 w-4 text-primary border-gray-300 focus:ring-primary"
                      {{ $order->type_aqiqah == 'TASYAKURAN' ? 'disabled' : '' }}>
                    <label for="menu3" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                      3 Menu
                      <span class="text-xs text-gray-500">(Lebih beragam)</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Kotakan</label>
              <input type="number" name="jumlah_kotakan" id="jumlah_kotakan" value="{{ $order->jumlah_kotakan }}"
                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300" readonly>
            </div>
          </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
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
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Tentukan Jam Matang
            </label>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1" for="matang_tanggal">
                  Tanggal
                </label>
                <input type="date"
                  id="matang_tanggal"
                  name="matang_tanggal"
                  value="{{ $order->jam_matang ? $order->jam_matang->format('Y-m-d') : '' }}"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                  min="{{ date('Y-m-d') }}">
              </div>
              <div>
                <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1" for="matang_jam">
                  Jam
                </label>
                <input type="time"
                  id="matang_jam"
                  name="matang_jam"
                  value="{{ $order->jam_matang ? $order->jam_matang->format('H:i') : '' }}"
                  class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
              </div>
            </div>
          </div>
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
        <a href="{{ route('admin.order.index') }}"
          class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
          Kembali
        </a>
        <button type="submit"
          class="px-6 py-2 bg-primary text-white rounded-md hover:bg-secondary transition-colors">
          Simpan Perubahan
        </button>
      </div>
      </form>
    </div>
  </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const typeSelect = document.getElementById('type_aqiqah');
      const menu2Radio = document.getElementById('menu2');
      const menu3Radio = document.getElementById('menu3');
      const kotakanInput = document.getElementById('jumlah_kotakan');

      // Mapping for package combinations
      const packageMap = {
        'PLATINUM': {
          '2 Menu': 180,
          '3 Menu': 90
        },
        'ISTIMEWA': {
          '2 Menu': 140,
          '3 Menu': 70
        },
        'SUPER': {
          '2 Menu': 100,
          '3 Menu': 50
        },
        'PUAS': {
          '2 Menu': 80,
          '3 Menu': 40
        },
        'TASYAKURAN': {
          '2 Menu ': 80
        }
      };

      // Function to update kotakan based on selections
      function updateKotakan() {
        const selectedType = typeSelect.value;
        const selectedMenu = document.querySelector('input[name="menu_option"]:checked')?.value;

        // Handle TASYAKURAN special case
        if (selectedType === 'TASYAKURAN') {
          menu2Radio.checked = true;
          menu3Radio.disabled = true;
          kotakanInput.value = packageMap[selectedType]['2'];
        } else {
          menu3Radio.disabled = false;

          if (selectedType && selectedMenu) {
            kotakanInput.value = packageMap[selectedType][selectedMenu] || '';
          }
        }
      }

      // Add event listeners
      typeSelect.addEventListener('change', updateKotakan);
      menu2Radio.addEventListener('change', updateKotakan);
      menu3Radio.addEventListener('change', updateKotakan);

      // Initial update
      updateKotakan();
    });
  </script>
</x-app-layout>