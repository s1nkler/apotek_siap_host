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
        Schema::create('usulanpengadaan', function (Blueprint $table) {
        $table->id();
        $table->date('tgl_usul');
        $table->date('tgl_pesan')->nullable();
        $table->decimal('total', 10, 2);
        $table->string('status');
        $table->string('nama_suplier');
        $table->string('nama_obat');
        $table->integer('qty');
        $table->string('kode_obat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulanpengadaan');
    }
};
