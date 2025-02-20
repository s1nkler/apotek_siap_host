@extends('dashboardAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary">Kelola Data Supplier</h2>
    <div class="card border-primary mt-3">
        <div class="card-header bg-primary text-white">
            <h4 class="text-center mb-0">Apotik PASTI</h4>
        </div>
        <div class="card-body">
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
                {{session('message')}}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" id="mainForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nama_supplier" class="col-sm-3 col-form-label text-end">Nama Supplier :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama_supplier" name="nama_suplier" class="form-control" placeholder="Nama Supplier" value="{{ $supplier->nama_suplier }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label text-end">Alamat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="alamat" name="alamat_suplier" class="form-control" placeholder="Alamat" value="{{ $supplier->alamat_suplier }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-3 col-form-label text-end">No Telepon :</label>
                    <div class="col-sm-6">
                        <input type="text" id="telp" name="telpon_suplier" class="form-control" placeholder="No Telepon" value="{{ $supplier->telpon_suplier }}">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary mx-2">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
