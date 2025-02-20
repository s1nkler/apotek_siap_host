<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Administrasi Apotek</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

    <!-- Custom CSS-->
    <style>
        .script-text {
            font-family: 'YourScriptFont', cursive;
            font-size: 24px;
            color: #333;
        }

        nav.main-header {
            background: linear-gradient(90deg, rgba(125, 226, 154, 1) 0%, rgba(100, 200, 130, 1) 100%);
            color: #333333;
        }

        footer.main-footer {
            background: linear-gradient(90deg, rgba(125, 226, 154, 1) 0%, rgba(100, 200, 130, 1) 100%);
            color: black;
            height: auto;
            width: auto;
        }

        aside.main-sidebar {
            background: linear-gradient(90deg, rgba(125, 226, 154, 1) 0%, rgba(100, 200, 130, 1) 100%);
            color: #333333;
        }

        aside.main-sidebar a.nav-link {
            color: #f8f9fa;
        }

        aside.main-sidebar i.nav-icon {
            color: #f8f9fa;
        }

        .logo-container {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            background-color: #FFA500;
            overflow: hidden;
            position: absolute;
            left: 180px;
            top: -20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        #toast {
            position: fixed;
            z-index: 9999;
            bottom: 20px;
            right: 20px;
            border-radius: 0px;
        }

        .logo-img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 50%;
            border: 4px solid #04030f;
        }

        @media (max-width: 1000px) {
            .logo-container {
                left: 30px;
            }
        }

        .contact-info {
            margin: 5px 0;
            font-size: 10px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: blue;">
        <h6 class="modal-title fs-5" id="staticBackdropLabel" style="color: white;">Apakah ingin logout?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('actionLogout') }}" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav" style="margin-left: 5px">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars" style="color: white"></i>
                    </a>
                </li>
            </ul>
            <!-- Logo Restoran -->
            <ul class="navbar-nav mx-auto">

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item d-flex align-items-center">
                    <!-- Modal -->
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://braverplayers.org/wp-content/uploads/2022/09/blank-pfp.png" class="img-circle elevation-2"
                                alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block" style="color: black; font-weight: bold;">{{ Auth::user()->nama }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('pengguna.index') }}" class="nav-link {{ request()->is('pengguna') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Kelola Data Pengguna</p>
                            </a>
                            <a href="{{ route('supplier.index') }}" class="nav-link {{ request()->is('supplier') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>Kelola Data Suplier</p>
                            </a>
                            <a href="{{ route('infoObat.index') }}" class="nav-link {{ request()->is('info-obat') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>Kelola Data Informasi Obat</p>
                            </a>
                            <a href="{{ route('obat.index') }}" class="nav-link {{ request()->is('obat') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-pills"></i>
                                <p>Kelola Data Obat</p>
                            </a>
                        </li>
                    </ul>

                    <br>

                    <div class="form-inline">
                        <button type="button" class="btn btn-danger w-100 form-control-sidebar" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </div>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer no-print">
            <!-- Display icon on Larce Sccreen-->
            <div class="float-right d-none d-sm-inline">
                <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="d-sm-none">
                <!-- Display icon on phone-->
                <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="d-sm-block">
                <strong>&copy; {{ date('Y') }} Apotek PASTI</strong>
                <p class="contact-info">Jl. No. 10 Yogyakarta</p>
                <p class="contact-info">Daerah Istimewa Yogyakarta</p>
                <p class="contact-info">Phone: + (123) 456-7890</p>
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script>
        document.getElementById('findButtonInfoObat').addEventListener('click', function() {
            const keyword = document.getElementById('gol_obat').value;
            
            window.location.href = "{{ route('infoObat.search') }}?keyword=" + encodeURIComponent(keyword);
            
        });
    </script>
    
    <script>
        document.getElementById('findButtonSupplier').addEventListener('click', function() {
            const keyword = document.getElementById('nama_supplier').value;
            
            window.location.href = "{{ route('supplier.search') }}?keyword=" + encodeURIComponent(keyword);
        });
    </script>
    
    <script>
        document.getElementById('findButtonPengguna').addEventListener('click', function() {
            const keyword = document.getElementById('username').value;
            
            window.location.href = "{{ route('pengguna.search') }}?keyword=" + encodeURIComponent(keyword);
        });
    </script>

    <script>
        document.getElementById('findButtonObat').addEventListener('click', function() {
            const keyword = document.getElementById('nama_obat').value;
            
            window.location.href = "{{ route('obat.search') }}?keyword=" + encodeURIComponent(keyword);
        });
    </script>

</body>

</html>
