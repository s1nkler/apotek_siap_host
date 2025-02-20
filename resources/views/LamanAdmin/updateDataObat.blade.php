@extends('dashboardAdmin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary">Kelola Data Obat</h2>
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
            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <h5 class="text-primary">Data Obat</h5>
                <div class="row mb-3">
                    <label for="nama_obat" class="col-sm-4 col-form-label text-end">Nama Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" placeholder="Nama Obat" value="{{ $obat->nama_obat }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga_beli" class="col-sm-4 col-form-label text-end">Harga Beli :</label>
                    <div class="col-sm-6">
                        <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Harga Beli" value="{{ $obat->harga_beli }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga_jual" class="col-sm-4 col-form-label text-end">Harga Jual :</label>
                    <div class="col-sm-6">
                        <input type="number" id="harga_jual" name="harga_jual" class="form-control" placeholder="Harga Jual" value="{{ $obat->harga_jual }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-4 col-form-label text-end">Stok Tersedia :</label>
                    <div class="col-sm-6">
                        <input type="number" id="stok" name="stok" class="form-control" placeholder="Stok Tersedia" value="{{ $obat->stok }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_kadaluarsa" class="col-sm-4 col-form-label text-end">Tanggal Kadaluarsa :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tgl_kadaluarsa" name="tgl_kadaluarsa" class="form-control" value="{{ $obat->tgl_kadaluarsa }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_masuk" class="col-sm-4 col-form-label text-end">Tanggal Masuk :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control" value="{{ $obat->tgl_masuk }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_obat" class="col-sm-4 col-form-label text-end">Kode Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="kode_obat" name="kode_obat" class="form-control" placeholder="Kode Obat" value="{{ $obat->kode_obat }}">
                    </div>
                </div>

                <h5 class="text-primary mt-4">Informasi Obat</h5>
                <div class="row mb-3">
                    <label for="golongan" class="col-sm-4 col-form-label text-end">Golongan :</label>
                    <div class="col-sm-6">
                        <select id="golongan" name="golongan" class="form-select" onchange="updateDeskripsi()">
                            <option value="" disabled>Pilih Golongan</option>
                            @foreach ($infoobat as $info)
                                <option value="{{ $info->id }}" data-deskripsi="{{ $info->deskripsi }}" {{ $obat->golongan == $info->id ? 'selected' : '' }}>{{ $info->gol_obat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi_obat" class="col-sm-4 col-form-label text-end">Deskripsi Obat :</label>
                    <div class="col-sm-6">
                        <textarea id="deskripsi_obat" name="deskripsi_obat" class="form-control" rows="3" placeholder="Deskripsi Obat" readonly style="resize: none;">{{ $obat->deskripsi_obat }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('obat.index') }}" class="btn btn-danger mx-2">Batal</a>
                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function updateDeskripsi() {
        var select = document.getElementById('golongan');
        var deskripsi = select.options[select.selectedIndex].getAttribute('data-deskripsi');
        document.getElementById('deskripsi_obat').value = deskripsi;
    }
</script>
@endsection
