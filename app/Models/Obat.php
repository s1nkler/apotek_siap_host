<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    public $timestamps = false;
    protected $primaryKey = "id";

    protected $fillable = [
        'id_infobat',
        'nama_obat',
        'harga_beli',
        'harga_jual',
        'stok',
        'tgl_kadaluarsa',
        'tgl_masuk',
        'kode_obat',
    ];

    public function informasiObat()
    {
        return $this->belongsTo(InformasiObat::class, 'id_infobat', 'id');
    }

    public function rincianPenjualan()
    {
        return $this->hasMany(RincianPenjualan::class, 'id_obat', 'id');
    }
}
