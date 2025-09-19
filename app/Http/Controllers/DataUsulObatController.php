<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UsulanPengadaan;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Session;

class DataUsulObatController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'kepala gudang') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        $usulanpengadaan = UsulanPengadaan::paginate(5);
        $obat = Obat::all();

        return view('LamanKepalaGudang.buatPengadaanObat', compact('usulanpengadaan', 'obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_usul' => 'required',
            'nama_suplier' => 'required',
            'nama_obat' => 'required',
            'qty' => 'required',
            'kode_obat' => 'required',
        ], [
            'tgl_usul.required' => 'Tanggal usul wajib diisi.',
            'nama_suplier.required' => 'Nama suplier wajib diisi.',
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'qty.required' => 'Kuantitas wajib diisi.',
            'kode_obat.required' => 'Kode obat wajib diisi.',
        ]);

        try {
            $data = $request->all();
            $data['total'] = 100;
            $data['status'] = '';
            $data['tgl_pesan'] = now();

            UsulanPengadaan::create($data);
            Session::flash('success', "Berhasil menambahkan data usulan pengadaan obat!");
            return redirect()->route('usulObat.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            Session::flash('error', 'Masukkan keyword pencarian pada field nama obat!');
            return redirect()->back();
        }

        $usulanpengadaan = UsulanPengadaan::where('nama_obat', 'LIKE', "%{$keyword}%")
                     ->paginate(5);

        return view('LamanKepalaGudang.buatPengadaanObat', compact('usulanpengadaan'));
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'kepala gudang') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        $obat = Obat::all();

        try {
            $usulanPengadaan = UsulanPengadaan::findOrFail($id);
            return view('LamanKepalaGudang.updatePengadaanObat', compact('usulanPengadaan', 'obat'));
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_usul' => 'required',
            'nama_suplier' => 'required',
            'nama_obat' => 'required',
            'qty' => 'required',
            'kode_obat' => 'required',
        ], [
            'tgl_usul.required' => 'Tanggal usul wajib diisi.',
            'nama_suplier.required' => 'Nama suplier wajib diisi.',
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'qty.required' => 'Kuantitas wajib diisi.',
            'kode_obat.required' => 'Kode obat wajib diisi.',
        ]);

        try {
            $usulanPengadaan = UsulanPengadaan::findOrFail($id);
            $usulanPengadaan->update($request->all());
            Session::flash('success', "Berhasil memperbarui data usulan pengadaan obat!");
            return redirect()->route('usulObat.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('usulObat.index');
    }

    public function destroy($id)
    {
        try {
            $usulanPengadaan = UsulanPengadaan::findOrFail($id);
            $usulanPengadaan->delete();
            Session::flash('success', "Berhasil menghapus data usulan pengadaan obat!");
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('usulObat.index');
    }
}