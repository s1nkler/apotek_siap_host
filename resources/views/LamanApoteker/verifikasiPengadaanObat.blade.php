@extends('dashboardApoteker')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary">Verifikasi Usulan Pengadaan Obat</h2>
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

            <form action="{{ isset($usulan) ? route('verifikasiUsulPengadaan.update', $usulan->id) : route('verifikasiUsulPengadaan.update', '1') }}" method="POST">
                @csrf
                @method('PUT')
                <h5 class="text-primary">Verifikasi Usulan Pengadaan Obat</h5>
                <div class="row mb-3">
                    <label for="tanggal_verifikasi" class="col-sm-4 col-form-label text-end">Tanggal Verifikasi :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tanggal_verifikasi" name="tanggal_verifikasi" class="form-control">
                    </div>
                </div>

                <h5 class="text-primary mt-4">Detail Obat</h5>
                <div class="row mb-3">
                    <label for="kode_obat" class="col-sm-4 col-form-label text-end">Kode Obat :</label>
                    <div class="col-sm-6">
                        <select id="kode_obat" name="kode_obat" class="form-control" onchange="updateObatDetails()">
                            <option value="">Pilih Kode Obat</option>
                            @foreach ($usulanpengadaan as $usulan)
                                <option value="{{ $usulan->kode_obat }}" data-nama="{{ $usulan->nama_obat }}" data-qty="{{ $usulan->qty }}" data-vendor="{{ $usulan->nama_suplier }}">{{ $usulan->kode_obat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_obat" class="col-sm-4 col-form-label text-end">Nama Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" placeholder="Nama Obat" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="qty" class="col-sm-4 col-form-label text-end">Qty :</label>
                    <div class="col-sm-6">
                        <input type="number" id="qty" name="qty" class="form-control" placeholder="Jumlah" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="vendor" class="col-sm-4 col-form-label text-end">Vendor :</label>
                    <div class="col-sm-5">
                        <input type="text" id="vendor" name="nama_suplier" class="form-control" placeholder="Vendor" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="verif" class="col-sm-4 col-form-label text-end">Verifikasi :</label>
                    <div class="col-sm-6">
                        <select id="verif" name="verif" class="form-control">
                            <option value="">Pilih Verifikasi</option>
                            <option value="terima">Terima</option>
                            <option value="tolak">Tolak</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" id="verifyButton" class="btn btn-primary mx-2" disabled>Verify</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Vendor</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @if ($usulanpengadaan->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                </tr>
            @else
                @foreach ($usulanpengadaan as $index => $usulan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $usulan->kode_obat }}</td>
                        <td>{{ $usulan->nama_obat }}</td>
                        <td>{{ $usulan->nama_suplier }}</td>
                        <td>{{ $usulan->qty }}</td>
                    </tr>
                @endforeach
            @endif
                <div class="d-flex justify-content-center mt-4">
                    {{ $usulanpengadaan->links('pagination::bootstrap-4') }}
                </div>
        </tbody>
    </table>
</div>

<script>
    function updateObatDetails() {
        var select = document.getElementById('kode_obat');
        var selectedOption = select.options[select.selectedIndex];
        document.getElementById('nama_obat').value = selectedOption.getAttribute('data-nama');
        document.getElementById('qty').value = selectedOption.getAttribute('data-qty');
        document.getElementById('vendor').value = selectedOption.getAttribute('data-vendor');
    }

    function updateObatDetails() {
        var select = document.getElementById('kode_obat');
        var selectedOption = select.options[select.selectedIndex];
        document.getElementById('nama_obat').value = selectedOption.getAttribute('data-nama');
        document.getElementById('qty').value = selectedOption.getAttribute('data-qty');
        document.getElementById('vendor').value = selectedOption.getAttribute('data-vendor');
        document.getElementById('verifyButton').disabled = select.value === "";
    }
</script>
@endsection
