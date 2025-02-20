<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianPenjualan extends Model
{
    use HasFactory;

    protected $table = 'rincianpenjualan';
    public $timestamps = false;
    protected $primaryKey = "id";

    protected $fillable = [
        'id_obat',
        'id_penjualan',
        'qty',
        'sub_total',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id');
    }
}
