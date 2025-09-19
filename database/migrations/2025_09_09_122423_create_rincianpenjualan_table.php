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
        Schema::create('rincianpenjualan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_obat')->constrained('obat'); // Relasi ke tabel obat
        $table->foreignId('id_penjualan')->constrained('penjualan'); // Relasi ke tabel penjualan
        $table->integer('qty');
        $table->decimal('sub_total', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincianpenjualan');
    }
};
