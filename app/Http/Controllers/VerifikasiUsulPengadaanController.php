<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UsulanPengadaan;
use Illuminate\Support\Facades\Auth;
use Session;

class VerifikasiUsulPengadaanController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'apoteker') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        $usulanpengadaan = UsulanPengadaan::paginate(5);

        return view('LamanApoteker.verifikasiPengadaanObat', compact('usulanpengadaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'nama_obat' => 'required',
            'qty' => 'required',
            'kode_obat' => 'required',
            'verif' => 'required|in:terima,tolak',
            'tanggal_verifikasi' => 'required|date'
        ], [
            'nama_suplier.required' => 'Nama suplier wajib diisi.',
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'qty.required' => 'Kuantitas wajib diisi.',
            'kode_obat.required' => 'Kode obat wajib diisi.',
            'verif.required' => 'Verifikasi wajib diisi.',
            'verif.in' => 'Verifikasi harus berisi terima atau tolak.',
            'tanggal_verifikasi.required' => 'Tanggal verifikasi wajib diisi.',
            'tanggal_verifikasi.date' => 'Tanggal verifikasi harus berupa tanggal yang valid.'
        ]);

        try {
            $usulanPengadaan = UsulanPengadaan::findOrFail($id);
            $usulanPengadaan->status = strtolower($request->verif) == 'terima' ? 'Y' : 'N';
            $usulanPengadaan->update($request->all());
            $usulanPengadaan->save();
            Session::flash('success', "Berhasil memperbarui data usulan pengadaan obat!");
            return redirect()->route('verifikasiUsulPengadaan.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('usulObat.index');
    }
}