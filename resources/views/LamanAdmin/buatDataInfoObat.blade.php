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
                    {{ session('message') }}
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
                        <input type="text" name="gol_obat" id="gol_obat" class="form-control" placeholder="Golongan Obat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-3 col-form-label text-end">Deskripsi Obat :</label>
                    <div class="col-sm-6">
                        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi Obat" rows="3"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('infoObat.index') }}" class="btn btn-primary mx-2">
                        <button type="button" class="btn btn-primary">Get</button>
                    </a>
                    <button type="button" class="btn btn-secondary mx-2" id="findButtonInfoObat">Find</button>
                    <button type="submit" class="btn btn-success mx-2">Entry</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Golongan Obat</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($infoobat->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">Data informasi obat tidak ditemukan</td>
                </tr>
            @else
                @foreach ($infoobat as $obat)
                    <tr id="obat-{{ $obat->id }}">
                        <td>{{ $obat->id }}</td>
                        <td>{{ $obat->gol_obat }}</td>
                        <td>{{ $obat->deskripsi }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $obat->id }}">Delete</button>
                                <a href="{{ route('infoObat.edit', $obat->id) }}" class="btn btn-warning">Update</a>
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
                                    Apakah Anda yakin ingin menghapus {{ $obat->gol_obat }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('infoObat.destroy', $obat->id) }}" method="POST">
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
            <div class="d-flex justify-content-center mt-4">
                {{ $infoobat->links('pagination::bootstrap-4') }}
            </div>
        </tbody>
    </table>
</div>
@endsection
