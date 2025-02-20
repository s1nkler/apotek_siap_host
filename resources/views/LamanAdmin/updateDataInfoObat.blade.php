@extends('dashboardAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary">Kelola Data Informasi Obat</h2>
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

            <form action="{{ route('infoObat.store') }}" method="POST" id="mainForm">
                @csrf
                <div class="row mb-3">
                    <label for="gol_obat" class="col-sm-3 col-form-label text-end">Golongan Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" name="gol_obat" id="gol_obat" class="form-control" placeholder="Golongan Obat" value="{{ $infoObat->gol_obat }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-3 col-form-label text-end">Deskripsi Obat :</label>
                    <div class="col-sm-6">
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi Obat" rows="3">{{ $infoObat->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('infoObat.index') }}" class="btn btn-secondary mx-2">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
