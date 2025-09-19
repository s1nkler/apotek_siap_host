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
        Schema::create('penjualan', function (Blueprint $table) {
        $table->id();
        $table->date('tgl_penjualan');
        $table->decimal('total', 10, 2);
        $table->decimal('pajak', 10, 2);
        $table->decimal('total_bayar', 10, 2);
        $table->string('nama_pembeli')->nullable();
        $table->string('resep')->nullable();
        $table->string('dokter_resep')->nullable();
        $table->string('telp_pembeli')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
