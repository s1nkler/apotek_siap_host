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
            <form action="{{ route('obat.store') }}" method="POST">
                @csrf
                <h5 class="text-primary">Data Obat</h5>
                <div class="row mb-3">
                    <label for="nama_obat" class="col-sm-4 col-form-label text-end">Nama Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" placeholder="Nama Obat" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga_beli" class="col-sm-4 col-form-label text-end">Harga Beli :</label>
                    <div class="col-sm-6">
                        <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Harga Beli">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga_jual" class="col-sm-4 col-form-label text-end">Harga Jual :</label>
                    <div class="col-sm-6">
                        <input type="number" id="harga_jual" name="harga_jual" class="form-control" placeholder="Harga Jual">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-4 col-form-label text-end">Stok Tersedia :</label>
                    <div class="col-sm-6">
                        <input type="number" id="stok" name="stok" class="form-control" placeholder="Stok Tersedia">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_kadaluarsa" class="col-sm-4 col-form-label text-end">Tanggal Kadaluarsa :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tgl_kadaluarsa" name="tgl_kadaluarsa" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_masuk" class="col-sm-4 col-form-label text-end">Tanggal Masuk :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kode_obat" class="col-sm-4 col-form-label text-end">Kode Obat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="kode_obat" name="kode_obat" class="form-control" placeholder="Kode Obat">
                    </div>
                </div>

                <h5 class="text-primary mt-4">Informasi Obat</h5>
                <div class="row mb-3">
                    <label for="golongan" class="col-sm-4 col-form-label text-end">Golongan :</label>
                    <div class="col-sm-6">
                        <select id="id_infobat" name="id_infobat" class="form-select" onchange="updateDeskripsi()">
                            <option value="" disabled selected>Pilih Golongan</option>
                            @foreach ($infoobat as $info)
                                <option value="{{ $info->id }}" data-deskripsi="{{ $info->deskripsi }}">{{ $info->gol_obat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi_obat" class="col-sm-4 col-form-label text-end">Deskripsi Obat :</label>
                    <div class="col-sm-6">
                        <textarea id="deskripsi_obat" name="deskripsi_obat" class="form-control" rows="3" placeholder="Deskripsi Obat" readonly style="resize: none;"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('obat.index') }}" class="btn btn-primary mx-2">Get</a>
                    <button type="button" class="btn btn-secondary mx-2" id="findButtonObat">Find</button>
                    <button type="submit" class="btn btn-success mx-2">Entry</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Nama Obat</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($obats->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Data obat tidak ditemukan</td>
                </tr>
            @else
                @foreach ($obats as $obat)
                    <tr>
                        <td>{{ $obat->id }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->harga_beli }}</td>
                        <td>{{ $obat->harga_jual }}</td>
                        <td>{{ $obat->stok }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $obat->id }}">Delete</button>
                                <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning">Update</a>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $obat->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $obat->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $obat->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus {{ $obat->nama_obat }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    function updateDeskripsi() {
        var select = document.getElementById('id_infobat');
        var deskripsi = select.options[select.selectedIndex].getAttribute('data-deskripsi');
        document.getElementById('deskripsi_obat').value = deskripsi;
    }
</script>
@endsection
