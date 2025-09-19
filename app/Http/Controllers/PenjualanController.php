<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Auth;
use Session;

class PenjualanController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'kasir') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        $penjualan = Penjualan::with('rincianPenjualan.obat')->paginate(5);

        return view('LamanKasir.buatDataPenjualan', compact('penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_penjualan' => 'required|date',
            'nama_pembeli' => 'required|string',
            'resep' => 'nullable|string',
            'dokter_resep' => 'nullable|string',
            'telp_pembeli' => 'required|string',
        ], [
            'tgl_penjualan.required' => 'Tanggal penjualan wajib diisi.',
            'nama_pembeli.required' => 'Nama pembeli wajib diisi.',
            'telp_pembeli.required' => 'Telepon pembeli wajib diisi.',
        ]);

        try {
            $penjualan = new Penjualan();
            $penjualan->tgl_penjualan = $request->tgl_penjualan;
            $penjualan->nama_pembeli = $request->nama_pembeli;
            $penjualan->resep = $request->resep;
            $penjualan->dokter_resep = $request->dokter_resep;
            $penjualan->telp_pembeli = $request->telp_pembeli;
            $penjualan->save();

            Session::flash('success', "Berhasil menambahkan data penjualan!");
            return redirect()->route('home');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('home');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'kasir') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        try {
            $penjualan = Penjualan::findOrFail($id);
            return view('LamanKasir.updateDataPenjualan', compact('penjualan'));
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_penjualan' => 'required|date',
            'nama_pembeli' => 'required|string',
            'resep' => 'nullable|string',
            'dokter_resep' => 'nullable|string',
            'telp_pembeli' => 'required|string',
        ], [
            'tgl_penjualan.required' => 'Tanggal penjualan wajib diisi.',
            'nama_pembeli.required' => 'Nama pembeli wajib diisi.',
            'telp_pembeli.required' => 'Telepon pembeli wajib diisi.',
        ]);

        try {
            $penjualan = Penjualan::findOrFail($id);
            $penjualan->update($request->all());
            Session::flash('success', "Berhasil memperbarui data penjualan!");
            return redirect()->route('penjualan.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('penjualan.index');
    }
}