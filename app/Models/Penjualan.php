<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    public $timestamps = false;
    protected $primaryKey = "id";

    protected $fillable = [
        'tgl_penjualan',
        'total',
        'pajak',
        'total_bayar',
        'nama_pembeli',
        'resep',
        'dokter_resep',
        'telp_pembeli',
    ];

    public function rincianPenjualan()
    {
        return $this->hasMany(RincianPenjualan::class, 'id_penjualan', 'id');
    }
}
