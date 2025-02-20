@extends('dashboardAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary">Kelola Data Pengguna</h2>
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
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="role" class="col-sm-3 col-form-label text-end">Role Pengguna :</label>
                    <div class="col-sm-6">
                        <select id="role" name="role" class="form-select">
                            <option value="">Pilih Role</option>
                            <option value="Admin" {{ $user->role == 'owner' ? 'selected' : '' }}>admin</option>
                            <option value="Admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="Pemilik" {{ $user->role == 'pemilik' ? 'selected' : '' }}>pemilik</option>
                            <option value="Kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>kasir</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label text-end">Nama Pengguna :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Pengguna" value="{{ $user->nama }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label text-end">Username :</label>
                    <div class="col-sm-6">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label text-end">Password :</label>
                    <div class="col-sm-6">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telefon" class="col-sm-3 col-form-label text-end">No Telepon :</label>
                    <div class="col-sm-6">
                        <input type="text" id="telefon" name="telefon" class="form-control" placeholder="No Telepon" value="{{ $user->telefon }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label text-end">Alamat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" value="{{ $user->alamat }}">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('pengguna.index') }}" class="btn btn-secondary mx-2">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
