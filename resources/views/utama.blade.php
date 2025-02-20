<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek PASTI - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/image/background_login.png');
            background-size: cover;
            background-position: center;
        }
        .card {
            margin: 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .highlight-green {
            color: green;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #f8f9fa;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('image/logoApotek_utama.png') }}" alt="Logo" style="height: 40px;">
                <span class="highlight-green">Apotek PASTI</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        @if(Auth::check() && Auth::user()->role == 'kasir')
                            <a class="btn btn-outline-primary" href="{{ route('penjualan.index') }}">
                                <i class="bi bi-cart"></i> Penjualan
                            </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(Auth::check())
                            <a class="btn btn-danger" href="{{ route('actionLogout') }}">Logout</a>
                        @else
                            <a class="btn btn-success" href="{{ route('login') }}">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(Auth::check())
            <h2 class="text-center my-5" style="font-family: 'Poppins', sans-serif;">Hi, <span class="highlight-green">{{ Auth::user()->nama }}!</span></h2>
        @endif
        <h1 class="text-center my-5" style="font-family: 'Dancing Script', cursive;">Selamat Datang di <span class="highlight-green">Apotek PASTI</span></h1>
        
        <div class="row mb-4">
            <div class="col-md-12">
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
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-{{ Auth::check() && Auth::user()->role == 'kasir' ? '8' : '12' }}">
                <div class="p-4" style="background-color: #f0f0f0; border: 1px solid #ddd; border-radius: 5px;">
                    <form class="d-flex" method="GET" action="{{ route('utama.search') }}">
                        <input class="form-control me-2" type="search" placeholder="Masukkan nama obat yang anda inginkan..." aria-label="Search" name="query">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <div class="row">
                        @if($data['obat']->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                Tidak ada data obat yang ditemukan.
                            </div>
                        @endif

                        @foreach($data['obat'] as $obat)
                            <div class="col-md-{{ Auth::check() && Auth::user()->role == 'kasir' ? '5' : '3' }} d-flex align-items-stretch">
                                <div class="card w-100">
                                    <img src="{{ asset('image/obat_utama.png') }}" class="card-img-top" alt="Obat {{ $obat->nama_obat }}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $obat->nama_obat }}</h5>
                                        <p class="card-text">Golongan: {{ $obat->informasiObat->gol_obat }}.</p>
                                        <p class="card-text">Stok: {{ $obat->stok }}.</p>
                                        <p class="card-text" style="display: none;">Golongan: {{ $obat->informasiObat->deskripsi }}</p>
                                        <div class="d-flex justify-content-between mt-auto">
                                            <button class="btn btn-primary me-2" id="obat-{{ $obat->id }}">Detail</button>
                                            @if(Auth::check() && Auth::user()->role == 'kasir')
                                                <button class="btn btn-success add-to-cart" data-id="{{ $obat->id }}" data-name="{{ $obat->nama_obat }}" data-price="{{ $obat->harga_jual }}">Tambah ke Keranjang</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel">Detail Obat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Nama Obat:</strong> <span id="detailNama"></span></p>
                                            <p><strong>Golongan:</strong> <span id="detailGolongan"></span></p>
                                            <p><strong>Stok:</strong> <span id="detailStok"></span></p>
                                            <p><strong>Deskripsi:</strong> <span id="detailDeskripsi"></span></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <div class="d-flex justify-content-center mt-4">
                            {{ $data['obat']->links('pagination::bootstrap-4') }}
                        </div>
                        
                    </div>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->role == 'kasir')
                <!-- Keranjang Belanja -->
                <div class="col-md-4">
                    <form method="POST" action="{{ route('penjualan.store') }}">
                        @csrf
                        <div class="card p-3 mb-3">
                            <h5 class="fw-bold">Resep Obat <small class="text-muted">(Opsional)</small></h5>
                            <div class="row mb-2">
                                <label class="col-sm-3">Dokter :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="dokter_resep" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3">Tanggal Resep :</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_resep" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card p-3 mb-3">
                            <h5 class="fw-bold">Pembeli</h5>
                            <div class="row mb-2">
                                <label class="col-sm-3">Nama Pembeli :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_pembeli" class="form-control" id="nama_pembeli" required>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3">No Telepon :</label>
                                <div class="col-sm-9">
                                    <input type="text" name="telp_pembeli" class="form-control" id="telp_pembeli" required>
                                </div>
                            </div>
                        </div>

                        <div class="card p-3 mb-3">
                            <h5 class="fw-bold">Penjualan Obat</h5>
                            <div class="row mb-2">
                                <label class="col-sm-3">Tanggal Transaksi :</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_penjualan" class="form-control" id="tgl_penjualan" required>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-primary text-white text-center">Keranjang Belanja</div>
                            <div class="card-body">
                                <ul id="cart-items" class="list-group"></ul>
                                <h5 class="mt-3">Subtotal: Rp <span id="cart-total">0</span></h5>
                                <button type="submit" class="btn btn-success w-100 mt-3" id="checkout-btn">Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".btn-primary").forEach(function (button) {
                button.addEventListener("click", function () {
                    const id = this.id.split("-")[1];
                    
                    const cardBody = this.closest(".card-body");
                    const namaObat = cardBody.querySelector(".card-title").textContent;
                    const golongan = cardBody.querySelector(".card-text:nth-child(2)").textContent.split(": ")[1];
                    const stok = cardBody.querySelector(".card-text:nth-child(3)").textContent.split(": ")[1];
                    
                    const deskripsi = cardBody.querySelector(".card-text:nth-child(4)").textContent.split(": ")[1];

                    document.getElementById("detailNama").textContent = namaObat;
                    document.getElementById("detailGolongan").textContent = golongan;
                    document.getElementById("detailStok").textContent = stok;
                    document.getElementById("detailDeskripsi").textContent = deskripsi;

                    // modal
                    const detailModal = new bootstrap.Modal(document.getElementById("detailModal"));
                    detailModal.show();
                });
            });
        });

        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        function updateCart() {
            const cartList = document.getElementById("cart-items");
            const cartTotal = document.getElementById("cart-total");
            cartList.innerHTML = "";
            let total = 0;

            cart.forEach((item, index) => {
                const li = document.createElement("li");
                li.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");
                li.innerHTML = `${item.name} (x${item.quantity}) - Rp ${item.price * item.quantity}
                    <div>
                        <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">-</button>
                        <button class="btn btn-sm btn-success" onclick="increaseQuantity(${index})">+</button>
                    </div>`;
                cartList.appendChild(li);
                total += item.price * item.quantity;
            });

            cartTotal.textContent = total;
            localStorage.setItem("cart", JSON.stringify(cart));
        }

        function addToCart(id, name, price) {
            let found = cart.find(item => item.id === id);
            if (found) {
                found.quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            updateCart();
        }

        document.addEventListener("DOMContentLoaded", function () {
            const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));

            @if(session('error'))
                document.getElementById("errorMessage").innerText = "{{ session('error') }}";
                errorModal.show();
            @endif
        });

        function removeFromCart(index) {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
            } else {
                cart.splice(index, 1);
            }
            updateCart();
        }

        function increaseQuantity(index) {
            cart[index].quantity++;
            updateCart();
        }

        document.querySelectorAll(".add-to-cart").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");
                const price = parseFloat(this.getAttribute("data-price"));
                addToCart(id, name, price);
            });
        });

        document.getElementById("checkout-btn").addEventListener("click", function (event) {
            event.preventDefault();
            const namaPembeli = document.getElementById("nama_pembeli").value;
            const telpPembeli = document.getElementById("telp_pembeli").value;
            const tglPenjualan = document.getElementById("tgl_penjualan").value;

            if (namaPembeli && telpPembeli && tglPenjualan) {
                const checkoutModal = new bootstrap.Modal(document.getElementById("checkoutModal"));
                checkoutModal.show();
                cart = [];
                updateCart();
            } else {
                const errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            }
        });

        updateCart();
    </script>

    <!-- Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
                    <p class="mt-3">Terima kasih telah berbelanja di Apotek PASTI!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Peringatan!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="errorMessage">Isikan data yang bersifat wajib!.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
