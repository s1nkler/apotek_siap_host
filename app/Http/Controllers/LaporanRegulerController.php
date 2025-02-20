<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\RincianPenjualan;

class LaporanRegulerController extends Controller
{
    public function index()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $penjualans = Penjualan::with('rincianPenjualan')
            ->whereMonth('tgl_penjualan', $currentMonth)
            ->whereYear('tgl_penjualan', $currentYear)
            ->get();

        $totalTransaksi = $penjualans->sum('total');
        $penjualanIds = $penjualans->pluck('id');

        return view('lamanpemilik.laporanreguler', compact('penjualans', 'totalTransaksi', 'penjualanIds'));
    }

    public function tampil(Request $request)
    {
        $currentYear = date('Y');

        $month = $request->input('month', date('m'));

        $penjualans = Penjualan::with('rincianPenjualan')
            ->whereMonth('tgl_penjualan', $month)
            ->whereYear('tgl_penjualan', $currentYear)
            ->get();

        $totalTransaksi = $penjualans->sum('total');
        $penjualanIds = $penjualans->pluck('id');

        return view('lamanpemilik.laporanreguler', compact('penjualans', 'totalTransaksi', 'penjualanIds'));
    }

}