<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
  public function run()
  {
    // Get supplier users through role relationship
    $supplierRole = Role::where('slug', 'supplier')->first();
    $supplierIds = $supplierRole->users()->pluck('users.id')->toArray();

    // Get dapur users through role relationship
    $dapurRole = Role::where('slug', 'dapur')->first();
    $dapurIds = $dapurRole->users()->pluck('users.id')->toArray();

    $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $typeAqiqoh = ['PLATINUM', 'ISTIMEWA', 'SUPER', 'PUAS', 'TASYAKURAN'];
    $menuOptions = ['3 Menu', '2 Menu'];
    $animalGender = ['Jantan', 'Betina'];
    $kambingPrices = [
      'PLATINUM' => [
        'Jantan' => 3980000,
        'Betina' => 3130000
      ],
      'ISTIMEWA' => [
        'Jantan' => 3630000,
        'Betina' => 2780000
      ],
      'SUPER' => [
        'Jantan' => 2850000,
        'Betina' => 2300000
      ],
      'PUAS' => [
        'Jantan' => 2700000,
        'Betina' => 2050000
      ],
      'TASYAKURAN' => [
        'Betina' => 1850000
      ]
    ];

    // Mapping jumlah kotakan
    $kotakanMapping = [
      'PLATINUM' => [
        '3 Menu' => 90,
        '2 Menu' => 180
      ],
      'ISTIMEWA' => [
        '3 Menu' => 70,
        '2 Menu' => 140
      ],
      'SUPER' => [
        '3 Menu' => 50,
        '2 Menu' => 100
      ],
      'PUAS' => [
        '3 Menu' => 40,
        '2 Menu' => 80
      ],
      'TASYAKURAN' => [
        '2 Menu' => 40
      ]
    ];

    $pesananTambahan = [
      'Tolong tambahkan sambal kecap yang banyak',
      'Mohon kuahnya dipisah',
      'Nasi putihnya tolong dibungkus terpisah',
      'Tambahan tissue dan sendok plastik',
      'Mohon dipisahkan yang pedas dan tidak pedas',
      'Tolong beri label nama di setiap kotak',
      null
    ];

    $keteranganMasak = [
      'Tidak terlalu pedas',
      'Kuah kental',
      'Daging empuk',
      'Bumbu meresap',
      'Tidak terlalu asin',
      'Standar',
      null
    ];

    // Create 50 random orders
    for ($i = 0; $i < 50; $i++) {
      // Generate random date within June 2025
      $randomDate = Carbon::createFromDate(2025, 6, rand(7, 30));

      // Generate random time between 8 AM and 8 PM
      $randomHour = str_pad(rand(8, 20), 2, '0', STR_PAD_LEFT);
      $randomMinute = str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT);

      // Generate random birth date (1-20 years ago)
      $birthDate = Carbon::now()->subYears(rand(1, 20))->subDays(rand(1, 365));

      // Generate random quantity and calculate total
      $quantity = rand(1, 5);
      $selectedType = $typeAqiqoh[array_rand($typeAqiqoh)];
      $selectedMenu = $menuOptions[array_rand($menuOptions)];
      $selectedGender = $animalGender[array_rand($animalGender)];

      // Jika TASYAKURAN, force gender ke Betina dan menu ke 2 Menu
      if ($selectedType === 'TASYAKURAN') {
        $selectedGender = 'Betina';
        $selectedMenu = '2 Menu';
      }

      // Hitung jumlah kotakan
      $jumlahKotakan = $kotakanMapping[$selectedType][$selectedMenu] ?? 0;

      // Hitung harga kambing
      $hargaKambing = $kambingPrices[$selectedType][$selectedGender] ?? 0;

      // Hitung harga kotakan (Rp 20.000 per kotak)
      $hargaKotakan = $jumlahKotakan * 20000;

      // Total harga adalah harga kambing + (harga per kotak × jumlah kotakan) × quantity
      $totalHarga = ($hargaKambing + $hargaKotakan) * $quantity;


      Order::create([
        'pemesan_nama' => fake()->name(),
        'pemesan_alamat' => fake()->address(),
        'pemesan_telepon' => fake()->phoneNumber(),
        'pemesan_handphone' => fake()->phoneNumber(),
        'pemesan_email' => fake()->unique()->safeEmail(),
        'aqiqoh_nama' => fake()->name(),
        'aqiqoh_binbinti' => fake()->name(),
        'aqiqoh_tempat_lahir' => fake()->city(),
        'aqiqoh_tanggal_lahir' => $birthDate,
        'aqiqoh_jenis_kelamin' => fake()->boolean() ? 'Laki-laki' : 'Perempuan',
        'pelaksanaan_hari' => $hari[array_rand($hari)],
        'pelaksanaan_tanggal' => $randomDate->format('d-m-Y'),
        'pelaksanaan_jam' => "{$randomHour}:{$randomMinute}",
        'pelaksanaan_alamat' => fake()->address(),
        'type_aqiqah' => $selectedType,
        'animal_gender' => $selectedGender,
        'menu_option' => $selectedMenu,
        'quantity' => $quantity,
        'jumlah_kotakan' => $jumlahKotakan * $quantity,
        'total_harga' => $totalHarga,
        'order_id' => 'ORDER-' . fake()->unique()->numerify('######'),
        'jam_matang' => $randomDate->format('d-m-Y') . " {$randomHour}:{$randomMinute}",
        'midtrans_transaction_status' => fake()->randomElement(['pending', 'settlement', 'cancel']),
        'status_order' => fake()->boolean(),
        'midtrans_payment_type' => fake()->randomElement(['bank_transfer', 'credit_card', 'gopay']),
        'midtrans_raw' => json_encode(['status' => 'success']),
        'pesanan_tambahan' => $pesananTambahan[array_rand($pesananTambahan)],
        'keterangan_masak' => $keteranganMasak[array_rand($keteranganMasak)],
        'supplier_id' => $supplierIds[array_rand($supplierIds)],
        'dapur_id' => $dapurIds[array_rand($dapurIds)],
        'created_at' => $randomDate,
        'updated_at' => $randomDate,
        'status_dapur' => fake()->randomElement(['Belum Diproses', 'Diproses', 'Terkirim']),
        'status_supplier' => fake()->randomElement(['Belum Diproses', 'Diproses', 'Terkirim']),
      ]);
    }
  }
}
