@extends('dashboardKasir')

@section('content')
<div class="container mt-4">
@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div id="successAlert" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

    <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card p-3 mb-3">
            <h5 class="fw-bold">Resep Obat <small class="text-muted">(Opsional)</small></h5>
            <div class="row mb-2">
                <label class="col-sm-3">Dokter :</label>
                <div class="col-sm-9">
                    <input type="text" name="dokter_resep" class="form-control" value="{{ $penjualan->dokter_resep }}">
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3">Tanggal Resep :</label>
                <div class="col-sm-9">
                    <input type="date" name="tgl_resep" class="form-control" value="{{ $penjualan->tgl_penjualan }}">
                </div>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <h5 class="fw-bold">Pembeli</h5>
            <div class="row mb-2">
                <label class="col-sm-3">Nama Pembeli :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_pembeli" class="form-control" value="{{ $penjualan->nama_pembeli }}">
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3">No Telepon :</label>
                <div class="col-sm-9">
                    <input type="text" name="telp_pembeli" class="form-control" value="{{ $penjualan->telp_pembeli }}">
                </div>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <h5 class="fw-bold">Penjualan Obat</h5>
            <div class="row mb-2">
                <label class="col-sm-3">Tanggal Transaksi :</label>
                <div class="col-sm-9">
                    <input type="date" name="tgl_penjualan" class="form-control" value="{{ $penjualan->tgl_penjualan }}">
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="{{ route('penjualan.index') }}" class="btn btn-danger mx-2">Batal</a>
                <button type="submit" class="btn btn-success mx-2">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
