<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanPengadaan extends Model
{
    use HasFactory;

    protected $table = 'usulanpengadaan';
    public $timestamps = false;
    protected $primaryKey = "id";

    protected $fillable = [
        'tgl_usul',
        'tgl_pesan',
        'total',
        'status',
        'nama_suplier',
        'nama_obat',
        'qty',
        'kode_obat',
    ];
}
