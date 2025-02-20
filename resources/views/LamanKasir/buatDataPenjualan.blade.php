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
            
    <div class="card p-3 mb-3">
        <h5 class="fw-bold">Resep Obat <small class="text-muted">(Opsional)</small></h5>
        <div class="row mb-2">
            <label class="col-sm-3">Dokter :</label>
            <div class="col-sm-9">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="row">
            <label class="col-sm-3">Tanggal Resep :</label>
            <div class="col-sm-9">
                <input type="date" class="form-control">
            </div>
        </div>
    </div>

    <div class="card p-3 mb-3">
        <h5 class="fw-bold">Pembeli</h5>
        <div class="row mb-2">
            <label class="col-sm-3">Nama Pembeli :</label>
            <div class="col-sm-9">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="row">
            <label class="col-sm-3">No Telepon :</label>
            <div class="col-sm-9">
                <input type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="card p-3 mb-3">
        <h5 class="fw-bold">Penjualan Obat</h5>
        <div class="row mb-2">
            <label class="col-sm-3">Tanggal Transaksi :</label>
            <div class="col-sm-9">
                <input type="date" class="form-control">
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-warning mx-2">Kembali</a>
            <!-- <button class="btn btn-success mx-2">Simpan</button> -->
        </div>
    </div>

    <table class="table table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nama Obat</th>
                <th>Qty</th>
                <th>Harga per Item</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan as $item)
            @foreach($item->rincianPenjualan as $rincian)
            <tr class="table-warning">
                <td>{{ $rincian->id }}</td>
                <td>{{ $rincian->obat->nama_obat }}</td>
                <td>{{ $rincian->qty }}</td>
                <td>{{ $rincian->obat->harga_jual }}</td>
                <td>{{ $rincian->sub_total }}</td>
                <td>
                    <a href="{{ route('penjualan.edit', $rincian->penjualan->id) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $penjualan->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
