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
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="role" class="col-sm-3 col-form-label text-end">Role Pengguna :</label>
                    <div class="col-sm-6">
                        <select id="role" name="role" class="form-select">
                            <option value="">Pilih Role</option>
                            <option value="Admin">owner</option>
                            <option value="Admin">admin</option>
                            <option value="Pemilik">pemilik</option>
                            <option value="Kasir">kasir</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label text-end">Nama Pengguna :</label>
                    <div class="col-sm-6">
                        <input type="text" id="name" name="nama" class="form-control" placeholder="Nama Pengguna">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-3 col-form-label text-end">Username :</label>
                    <div class="col-sm-6">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
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
                        <input type="text" id="telefon" name="telefon" class="form-control" placeholder="No Telepon">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label text-end">Alamat :</label>
                    <div class="col-sm-6">
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('pengguna.index') }}" class="btn btn-primary mx-2">Get</a>
                    <button type="button" class="btn btn-secondary mx-2" id="findButtonPengguna">Find</button>
                    <button type="submit" class="btn btn-success mx-2">Entry</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No Tel</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($users->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Data pengguna tidak ditemukan</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->telefon }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">Delete</button>
                                <a href="{{ route('pengguna.edit', $user->id) }}" class="btn btn-warning">Update</a>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel-{{ $user->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus {{ $user->nama }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST">
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
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </tbody>
    </table>
</div>
@endsection
