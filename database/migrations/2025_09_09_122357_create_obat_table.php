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
        Schema::create('obat', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_infobat')->constrained('informasiobat'); // Relasi ke tabel informasiobat
        $table->string('nama_obat');
        $table->decimal('harga_beli', 10, 2);
        $table->decimal('harga_jual', 10, 2);
        $table->integer('stok');
        $table->date('tgl_kadaluarsa');
        $table->date('tgl_masuk');
        $table->string('kode_obat')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
