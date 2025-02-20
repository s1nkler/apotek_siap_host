<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiObat extends Model
{
    use HasFactory;

    protected $table = 'informasiobat';
    public $timestamps = false;
    protected $primaryKey = "id";

    protected $fillable = [
        'gol_obat',
        'deskripsi',
    ];

    public function obat()
    {
        return $this->hasMany(Obat::class, 'id_infobat', 'id');
    }
}
