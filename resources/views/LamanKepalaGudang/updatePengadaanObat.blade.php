@extends('dashboardKepalaGudang')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary">Usulan Pengadaan Obat</h2>
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

            <form action="{{ route('usulObat.update', $usulanPengadaan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <h5 class="text-primary">Usulan Pengadaan Obat</h5>
                <div class="row mb-3">
                    <label for="tanggal_transaksi" class="col-sm-4 col-form-label text-end">Tanggal Transaksi :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tanggal_transaksi" name="tgl_usul" class="form-control" value="{{ $usulanPengadaan->tgl_usul }}">
                    </div>
                </div>

                <h5 class="text-primary mt-4">Detail Obat</h5>
                <div class="row mb-3">
                    <label for="kode_obat" class="col-sm-4 col-form-label text-end">Kode Obat :</label>
                    <div class="col-sm-6">
                        <select id="kode_obat" name="kode_obat" class="form-control" onchange="updateNamaObat()">
                            <option value="">Pilih Kode Obat</option>
                            @foreach($obat as $item)
                                <option value="{{ $item->kode_obat }}" data-nama="{{ $item->nama_obat }}" {{ $item->kode_obat == $usulanPengadaan->kode_obat ? 'selected' : '' }}>{{ $item->kode_obat }} - {{ $item->nama_obat }}</option>
                            @endforeach
                            @if(!$obat->contains('kode_obat', $usulanPengadaan->kode_obat))
                                <option value="{{ $usulanPengadaan->kode_obat }}" data-nama="{{ $usulanPengadaan->nama_obat }}" selected>{{ $usulanPengadaan->kode_obat }} - {{ $usulanPengadaan->nama_obat }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_obat" class="col-sm-4 col-form-label text-end">Nama Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" placeholder="Nama Obat" value="{{ $usulanPengadaan->nama_obat }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="qty" class="col-sm-4 col-form-label text-end">Qty :</label>
                    <div class="col-sm-6">
                        <input type="number" id="qty" name="qty" class="form-control" placeholder="Jumlah" value="{{ $usulanPengadaan->qty }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="vendor" class="col-sm-4 col-form-label text-end">Vendor :</label>
                    <div class="col-sm-5">
                        <input type="text" id="vendor" name="nama_suplier" class="form-control" placeholder="Vendor" value="{{ $usulanPengadaan->nama_suplier }}">
                    </div>
                    <div class="col-sm-1">
                        <!-- <button type="button" class="btn btn-outline-secondary">🔍</button> -->
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('usulObat.index') }}" class="btn btn-secondary mx-2">
                        <button type="button" class="btn btn-secondary">Batal</button>
                    </a>
                    <button type="submit" class="btn btn-success mx-2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateNamaObat() {
        var select = document.getElementById('kode_obat');
        var namaObat = select.options[select.selectedIndex].getAttribute('data-nama');
        document.getElementById('nama_obat').value = namaObat;
    }
</script>
@endsection
