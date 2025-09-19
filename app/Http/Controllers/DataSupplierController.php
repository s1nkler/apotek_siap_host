<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Suplier;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Session;


class DataSupplierController extends Controller
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

        $supplier = Suplier::paginate(5);

        return view('LamanAdmin.buatDataSupplier', compact('supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat_suplier' => 'required',
            'telpon_suplier' => 'required|min:11|max:13',
        ], [
            'nama_suplier.required' => 'Nama supplier wajib diisi.',
            'alamat_suplier.required' => 'Alamat supplier wajib diisi.',
            'telpon_suplier.required' => 'Telepon supplier wajib diisi.',
            'telpon_suplier.min' => 'Telepon supplier minimal 11 karakter.',
            'telpon_suplier.max' => 'Telepon supplier maksimal 13 karakter.',
        ]);

        try {
            Suplier::create($request->all());
            Session::flash('success', "Berhasil menambahkan data supplier dengan nama ({$request->nama_suplier})!");
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            Session::flash('error', 'Masukkan keyword pencarian pada field nama supplier!');
            return redirect()->back();
        }

        $supplier = Suplier::where('nama_suplier', 'LIKE', "%{$keyword}%")
                     ->paginate(5);

        return view('LamanAdmin.buatDataSupplier', compact('supplier'));
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
            $supplier = Suplier::findOrFail($id);
            return view('LamanAdmin.updateDataSupplier', compact('supplier'));
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_suplier' => 'required',
            'alamat_suplier' => 'required',
            'telpon_suplier' => 'required|min:11|max:13',
        ], [
            'nama_suplier.required' => 'Nama supplier wajib diisi.',
            'alamat_suplier.required' => 'Alamat supplier wajib diisi.',
            'telpon_suplier.required' => 'Telepon supplier wajib diisi.',
            'telpon_suplier.min' => 'Telepon supplier minimal 11 karakter.',
            'telpon_suplier.max' => 'Telepon supplier maksimal 13 karakter.',
        ]);

        try {
            $supplier = Suplier::findOrFail($id);
            $supplier->update($request->all());
            Session::flash('success', "Berhasil memperbarui data supplier dengan nama ({$supplier->nama_suplier})!");
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $supplier = Suplier::findOrFail($id);
            Session::flash('success', "Berhasil menghapus data supplier ({$supplier->nama_suplier})!");
            $supplier->delete();
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('supplier.index');
    }
}