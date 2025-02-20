<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'suplier';
    public $timestamps = false;
    protected $primaryKey = "id";

    protected $fillable = [
        'nama_suplier',
        'alamat_suplier',
        'telpon_suplier',
    ];
}
