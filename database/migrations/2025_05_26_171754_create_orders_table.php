<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Data Pemesan
            $table->string('pemesan_nama');
            $table->string('pemesan_alamat');
            $table->string('pemesan_telepon')->nullable();
            $table->string('pemesan_handphone');
            $table->string('pemesan_email');
            // Data Anak
            $table->string('aqiqoh_nama');
            $table->string('aqiqoh_binbinti');
            $table->string('aqiqoh_tempat_lahir');
            $table->date('aqiqoh_tanggal_lahir');
            $table->string('aqiqoh_jenis_kelamin');
            // Pelaksanaan
            $table->string('pelaksanaan_hari');
            $table->date('pelaksanaan_tanggal');
            $table->string('pelaksanaan_jam');
            $table->string('pelaksanaan_alamat');
            // Detail Aqiqah
            $table->string('type_aqiqah');
            $table->string('animal_gender');
            $table->string('menu_option');
            $table->integer('quantity');
            $table->integer('jumlah_kotakan');
            $table->integer('total_harga');
            // Midtrans
            $table->string('order_id')->nullable();
            $table->string('midtrans_transaction_status')->nullable();
            $table->string('midtrans_payment_type')->nullable();
            $table->string('midtrans_va_number')->nullable();
            $table->json('midtrans_raw')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
