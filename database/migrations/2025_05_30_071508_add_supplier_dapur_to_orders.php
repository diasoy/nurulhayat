<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable()->after('keterangan_masak');
            $table->unsignedBigInteger('dapur_id')->nullable()->after('supplier_id');

            $table->foreign('supplier_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('dapur_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['dapur_id']);
            $table->dropColumn(['supplier_id', 'dapur_id']);
        });
    }
};
