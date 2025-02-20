<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\InformasiObat;
use Illuminate\Support\Facades\Auth;
use Session;

class DataObatController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'admin') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        $obats = Obat::paginate(5);
        $infoobat = InformasiObat::all();

        return view('LamanAdmin.buatDataObat', compact('obats', 'infoobat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'tgl_kadaluarsa' => 'required|date',
            'tgl_masuk' => 'required|date',
            'kode_obat' => 'required|unique:obat,kode_obat',
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.numeric' => 'Harga jual harus berupa angka.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'tgl_kadaluarsa.required' => 'Tanggal kadaluarsa wajib diisi.',
            'tgl_kadaluarsa.date' => 'Tanggal kadaluarsa harus berupa tanggal.',
            'tgl_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tgl_masuk.date' => 'Tanggal masuk harus berupa tanggal.',
            'kode_obat.required' => 'Kode obat wajib diisi.',
            'kode_obat.unique' => 'Kode obat sudah digunakan.',
        ]);

        try {
            $obat = new Obat($request->all());
            //$obat->save();

            Session::flash('success', "Berhasil menambahkan data obat dengan nama ({$request->nama_obat})!");
            return redirect()->route('obat.index');
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

        $obats = Obat::where('nama_obat', 'LIKE', "%{$keyword}%")
                     ->paginate(5);

        return view('LamanAdmin.buatDataObat', compact('obats'));
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            Session::flash('error', 'Anda harus login terlebih dahulu!');
            return redirect('login');
        }

        if (Auth::user()->role != 'admin') {
            Session::flash('error', 'Anda tidak memiliki otorisasi untuk mengakses halaman tersebut!');
            return redirect()->back();
        }

        $infoobat = InformasiObat::all();

        try {
            $obat = Obat::findOrFail($id);
            return view('LamanAdmin.updateDataObat', compact('obat', 'infoobat'));
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'tgl_kadaluarsa' => 'required|date',
            'tgl_masuk' => 'required|date',
            'kode_obat' => 'required|unique:obat,kode_obat,' . $id,
        ], [
            'nama_obat.required' => 'Nama obat wajib diisi.',
            'harga_beli.required' => 'Harga beli wajib diisi.',
            'harga_beli.numeric' => 'Harga beli harus berupa angka.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.numeric' => 'Harga jual harus berupa angka.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'tgl_kadaluarsa.required' => 'Tanggal kadaluarsa wajib diisi.',
            'tgl_kadaluarsa.date' => 'Tanggal kadaluarsa harus berupa tanggal.',
            'tgl_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tgl_masuk.date' => 'Tanggal masuk harus berupa tanggal.',
            'kode_obat.required' => 'Kode obat wajib diisi.',
            'kode_obat.unique' => 'Kode obat sudah digunakan.',
        ]);

        try {
            $obat = Obat::findOrFail($id);
            $obat->nama_obat = $request->nama_obat;
            $obat->harga_beli = $request->harga_beli;
            $obat->harga_jual = $request->harga_jual;
            $obat->stok = $request->stok;
            $obat->tgl_kadaluarsa = $request->tgl_kadaluarsa;
            $obat->tgl_masuk = $request->tgl_masuk;
            $obat->kode_obat = $request->kode_obat;
            //$obat->save();

            Session::flash('success', "Berhasil memperbarui data obat dengan nama ({$obat->nama_obat})!");
            return redirect()->route('obat.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $obat = Obat::findOrFail($id);
            //$obat->delete();
            Session::flash('success', "Berhasil menghapus data obat ({$obat->nama_obat})!");
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('obat.index');
    }
}