<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status_dapur')->default('Belum Diproses')->after('dapur_id');
            $table->string('status_supplier')->default('Belum Diproses')->after('status_dapur');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['status_dapur', 'status_supplier']);
        });
    }
};
