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
            
            <form action="{{ route('supplier.store') }}" method="POST" id="mainForm">
                @csrf
                <div class="row mb-3">
                    <label for="nama_supplier" class="col-sm-3 col-form-label text-end">Nama Supplier :</label>
                    <div class="col-sm-6">
                        <input type="text" id="nama_supplier" name="nama_suplier" class="form-control" placeholder="Nama Supplier">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label text-end">Alamat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="alamat" name="alamat_suplier" class="form-control" placeholder="Alamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-3 col-form-label text-end">No Telepon :</label>
                    <div class="col-sm-6">
                        <input type="text" id="telp" name="telpon_suplier" class="form-control" placeholder="No Telepon">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('supplier.index') }}" class="btn btn-primary mx-2">
                        <button type="button" class="btn btn-primary">Get</button>
                    </a>
                    <button type="button" class="btn btn-secondary mx-2" id="findButtonSupplier">Find</button>
                    <button type="submit" class="btn btn-success mx-2">Entry</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Tel</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($supplier->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Data informasi supplier tidak ditemukan</td>
                </tr>
            @else
                @foreach ($supplier as $sup)
                    <tr>
                        <td>{{ $sup->id }}</td>
                        <td>{{ $sup->nama_suplier }}</td>
                        <td>{{ $sup->alamat_suplier }}</td>
                        <td>{{ $sup->telpon_suplier }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $sup->id }}">Delete</button>
                                <a href="{{ route('supplier.edit', $sup->id) }}" class="btn btn-warning">Update</a>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $sup->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $sup->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $sup->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus {{ $sup->nama_suplier }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('supplier.destroy', $sup->id) }}" method="POST">
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
                    {{ $supplier->links('pagination::bootstrap-4') }}
                </div>
            </tbody>
        </table>
    </table>
</div>
@endsection
