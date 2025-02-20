<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];
            
        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role == 'owner') {
                return redirect()->route('laporanReguler.index');
            } else if ($user->role == 'admin') {
                return redirect()->route('pengguna.index');
            } else if ($user->role == 'kasir') {
                return redirect()->route('home');
            } else if ($user->role == 'kepala gudang') {
                return redirect()->route('usulObat.index');
            } else if ($user->role == 'apoteker') {
                return redirect()->route('verifikasiUsulPengadaan.index');
            } else {
                return redirect()->route('home');
            }
        } else {
            Session::flash('error', 'Username atau password salah');
            return redirect('login');
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
