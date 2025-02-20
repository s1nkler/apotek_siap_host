<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\InformasiObat;
use Illuminate\Support\Facades\Auth;
use Session;


class UtamaController extends Controller
{
    public function index()
    {
        $data = [
            'obat' => Obat::paginate(8),
            'infoObat' => InformasiObat::all()
        ];

        return view('utama', compact('data'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $data = [
            'obat' => Obat::where('nama_obat', 'LIKE', "%{$query}%")->paginate(8),
            'infoObat' => InformasiObat::all()
        ];

        return view('utama', compact('data'));
    }

}