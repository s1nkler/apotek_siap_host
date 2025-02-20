<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Session;

class DataPenggunaController extends Controller
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

        $users = User::paginate(5);

        return view('LamanAdmin.buatDataPengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:user,username',
            'password' => 'required|min:8',
            'telefon' => 'required|min:11|max:13',
            'alamat' => 'required',
            'role' => 'required',
        ], [
            'nama.required' => 'Nama pengguna wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'telfon.required' => 'Telepon wajib diisi.',
            'telefon.min' => 'Telepon minimal 11 karakter.',
            'telfon.max' => 'Telepon maksimal 13 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'role.required' => 'Role wajib diisi.',
        ]);

        try {
            $user = new User($request->all());
            $user->password = bcrypt($request->password);
            //$user->save();

            Session::flash('success', "Berhasil menambahkan data pengguna dengan nama ({$request->nama})!");
            return redirect()->route('pengguna.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            Session::flash('error', 'Masukkan keyword pencarian pada field username!');
            return redirect()->back();
        }

        $users = User::where('username', 'LIKE', "%{$keyword}%")
                     ->paginate(5);

        return view('LamanAdmin.buatDataPengguna', compact('users'));
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
            $user = User::findOrFail($id);
            return view('LamanAdmin.updateDataPengguna', compact('user'));
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:user,username,' . $id,
            'password' => 'nullable|min:8',
            'telefon' => 'required|min:11|max:13',
            'alamat' => 'required',
            'role' => 'required',
        ], [
            'nama.required' => 'Nama pengguna wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'telfon.required' => 'Telepon wajib diisi.',
            'telefon.min' => 'Telepon minimal 11 karakter.',
            'telfon.max' => 'Telepon maksimal 13 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'role.required' => 'Role wajib diisi.',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->nama = $request->nama;
            $user->username = $request->username;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->telfon = $request->telfon;
            $user->alamat = $request->alamat;
            //$user->save();

            Session::flash('success', "Berhasil memperbarui data pengguna dengan nama ({$user->nama})!");
            return redirect()->route('pengguna.index');
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            //$user->delete();
            Session::flash('success', "Berhasil menghapus data pengguna ({$user->nama})!");
        } catch (\Exception $e) {
            Session::flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }

        return redirect()->route('pengguna.index');
    }
}