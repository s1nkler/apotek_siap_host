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

            <form action="{{ route('usulObat.store') }}" method="POST">
                @csrf
                <h5 class="text-primary">Usulan Pengadaan Obat</h5>
                <div class="row mb-3">
                    <label for="tanggal_transaksi" class="col-sm-4 col-form-label text-end">Tanggal Transaksi :</label>
                    <div class="col-sm-6">
                        <input type="date" id="tanggal_transaksi" name="tgl_usul" class="form-control">
                    </div>
                </div>

                <h5 class="text-primary mt-4">Detail Obat</h5>
                <div class="row mb-3">
                    <label for="kode_obat" class="col-sm-4 col-form-label text-end">Kode Obat :</label>
                    <div class="col-sm-6">
                        <select id="kode_obat" name="kode_obat" class="form-control" onchange="updateNamaObat()">
                            <option value="">Pilih Kode Obat</option>
                            @foreach($obat as $item)
                                <option value="{{ $item->kode_obat }}" data-nama="{{ $item->nama_obat }}">{{ $item->kode_obat }} - {{ $item->nama_obat }}</option>
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
                        <input type="number" id="qty" name="qty" class="form-control" placeholder="Jumlah">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="vendor" class="col-sm-4 col-form-label text-end">Vendor :</label>
                    <div class="col-sm-5">
                        <input type="text" id="vendor" name="nama_suplier" class="form-control" placeholder="Vendor">
                    </div>
                    <div class="col-sm-1">
                        <!-- <button type="button" class="btn btn-outline-secondary">🔍</button> -->
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-success mx-2">Entry</button>
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($usulanpengadaan->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Data usulan tidak ditemukan</td>
                </tr>
            @else
                @foreach ($usulanpengadaan as $usul)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $usul->kode_obat }}</td>
                        <td>{{ $usul->nama_obat }}</td>
                        <td>{{ $usul->nama_suplier }}</td>
                        <td>{{ $usul->qty }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $usul->id }}">Delete</button>
                                <a href="{{ route('usulObat.edit', $usul->id) }}" class="btn btn-warning">Update</a>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $usul->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $usul->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $usul->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus {{ $usul->nama_obat }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('usulObat.destroy', $usul->id) }}" method="POST">
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
    function updateNamaObat() {
        var select = document.getElementById('kode_obat');
        var namaObat = select.options[select.selectedIndex].getAttribute('data-nama');
        document.getElementById('nama_obat').value = namaObat;
    }
</script>
@endsection
