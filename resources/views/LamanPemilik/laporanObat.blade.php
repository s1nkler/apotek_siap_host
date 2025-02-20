@extends('dashboardPemilik')

@section('content')
<style>
    body {
        background-color: #F9F9F7;
    }

    .btn-tambah-resep:hover {
        transform: scale(1.1);
        background-color: white;
        color: #198754;
        border-radius: 2px solid #198754;
        transition: transform 0.3s ease;
    }

    .btn-primary:hover {
        transform: scale(1.1);
        background-color: white;
        color: #0d6efd;
        border-radius: 2px solid #0d6efd;
        transition: transform 0.3s ease;
    }

    .btn-danger:hover {
        transform: scale(1.1);
        background-color: white;
        color: #dc3545;
        border-radius: 2px solid #dc3545;
        transition: transform 0.3s ease;
    }

    @media print {
        .no-print {
            display: none;
        }
    }
</style>

<body>
    <div class="container">
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
        <h2 class="text-center mt-3">Apotik PASTI</h2>
        <p class="text-center">Jl. No. 10 Yogyakarta</p>
        <h3 class="text-center">LAPORAN 20 OBAT PALING DIBUTUHKAN</h3>
        <!-- <p class="text-center">Tahun : {{ \Carbon\Carbon::now()->translatedFormat(' Y ') }}</p> -->
        <p class="text-center">Tanggal data ditarik: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p class="text-center">Tanggal cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

        <!-- Form untuk memilih tahun -->
        <div class="text-center no-print">
        <div class="text-center no-print">
        </div>
        </div>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Golongan Obat</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obatDetails as $index => $obat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->informasiObat->gol_obat }}</td>
                        <td>{{ $obat->stok }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

        <!-- Button -->
        <div class="text-center no-print">
            <button onclick="window.print()" class="btn btn-primary">Print PDF</button>
        </div>

    </div>
</body>

@endsection
