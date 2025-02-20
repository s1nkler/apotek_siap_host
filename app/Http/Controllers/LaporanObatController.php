<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\RincianPenjualan;
use App\Models\InformasiObat;

class LaporanObatController extends Controller
{
    public function index()
    {
        $topObat = RincianPenjualan::select('id_obat', \DB::raw('count(*) as total'))
            ->groupBy('id_obat')
            ->orderBy('total', 'desc')
            ->take(20)
            ->get();

        $obatDetails = Obat::with('informasiObat')
            ->whereIn('id', $topObat->pluck('id_obat'))
            ->get();

        return view('lamanpemilik.laporanobat', compact('obatDetails'));
    }

}