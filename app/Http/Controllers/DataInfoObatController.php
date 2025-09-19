<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\InformasiObat;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Session;


class DataInfoObatController extends Controller
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

        $infoobat = InformasiObat::paginate(5);

        return view('LamanAdmin.buatDataInfoObat', compact('infoobat'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'gol_obat' => 'required|unique:informasi_obats,gol_obat,' . $id,
    //         'deskripsi' => 'required',
    //     ], [
    //         'gol_obat.required' => 'Golongan obat wajib diisi.',
    //         'gol_obat.unique' => 'Golongan obat sudah ada.',
    //         'deskripsi.required' => 'Deskripsi wajib diisi.',
    //     ]);

    //     try {
    //         InformasiObat::create($request->all());
    //         Session::flash('success', "Berhasil menambahkan data informasi golongan obat ({$request->gol_obat})!");
    //         return redirect()->route('infoObat.index');
    //     } catch (\Exception $e) {
    //         Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function store(Request $request)
    {
        $request->validate([
            // The ', . $id' has been removed from this line
            'gol_obat' => 'required|unique:informasiobat,gol_obat',
            'deskripsi' => 'required',
        ], [
            'gol_obat.required' => 'Golongan obat wajib diisi.',
            'gol_obat.unique' => 'Golongan obat sudah ada.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        try {
            InformasiObat::create($request->all());
            Session::flash('success', "Berhasil menambahkan data informasi golongan obat ({$request->gol_obat})!");
            return redirect()->route('infoObat.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            Session::flash('error', 'Masukkan keyword pencarian pada field golongan obat!');
            return redirect()->back();
        }

        $infoobat = InformasiObat::where('gol_obat', 'LIKE', "%{$keyword}%")
                     ->paginate(5);

        return view('LamanAdmin.buatDataInfoObat', compact('infoobat'));
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

        try {
            $infoObat = InformasiObat::findOrFail($id);
            return view('LamanAdmin.updateDataInfoObat', compact('infoObat'));
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gol_obat' => 'required|unique:informasi_obats,gol_obat,' . $id,
            'deskripsi' => 'required',
        ], [
            'gol_obat.required' => 'Golongan obat wajib diisi.',
            'gol_obat.unique' => 'Golongan obat sudah ada.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ]);

        try {
            $infoObat = InformasiObat::findOrFail($id);
            $infoObat->update($request->all());
            Session::flash('success', "Berhasil memperbarui data informasi golongan obat ({$infoObat->gol_obat})!");
            return redirect()->route('infoObat.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('infoObat.index');
    }

    public function destroy($id)
    {
        try {
            $infoObat = InformasiObat::findOrFail($id);
            Session::flash('success', "Berhasil menghapus data informasi golongan obat ({$infoObat->gol_obat})!");
            $infoObat->delete();
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('infoObat.index');
    }
}