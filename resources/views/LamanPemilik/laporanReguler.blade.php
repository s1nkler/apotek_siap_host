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
        <h3 class="text-center">LAPORAN PENJUALAN BULANAN</h3>
        <p class="text-center">Tanggal cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

        <!-- Form untuk memilih tahun -->
        <div class="text-center no-print">
            <form action="{{ route('laporan-reguler.tampil') }}" method="POST" class="form-inline">
                @csrf
                <label for="month" class="mr-2">Pilih Bulan:</label>
                <select name="month" id="month" class="form-control mr-2">
                    <option value="01" selected>Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
        </div>
        <p class="text-center">Bulan: {{ \Carbon\Carbon::create()->month((int)request('month'))->translatedFormat('F') }}</p>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Total Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $index => $penjualan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penjualanIds[$index] }}</td>
                        <td>{{ number_format($penjualan->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td>{{ number_format($totalTransaksi, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Button -->
        <div class="text-center no-print">
            <button onclick="window.print()" class="btn btn-primary">Print PDF</button>
        </div>

    </div>
</body>

@endsection
