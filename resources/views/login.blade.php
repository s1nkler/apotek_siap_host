<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Login</title>
    <style>
        body {
            background: url('/image/background_login.png');
            background-size: cover;
            background-position: center;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            background: rgba(239, 253, 236, 0.8);
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        
        .logo-text {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            color: #2e7d32;
            text-transform: uppercase;
            font-style: italic;
        }

        .logo-text .highlight {
            color: #66bb6a;
            font-style: italic;
        }

    </style>
</head>
<body>
    <div class="container center-container">
        <div class="col-md-4 login-box">
            <h1 class="logo-text text-center">
                <a href="/" class="text-decoration-none text-reset">Apotek <span class="highlight">PASTI</span></a>
            </h1>
            <!-- <h3 class="text-center"><b>Login</b></h3> -->
            <hr>

            @if (session('error'))
            <div class="alert alert-danger">
                <b>Oops!</b> {{ session('error') }}
            </div>
            @endif

            <form method="post" action="{{route('actionLogin')}}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="username" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-success btn-block">Login</button>
                <hr>
                <!-- <p class="text-center">Belum punya akun? <a href="#">Registrasi disini</a></p> -->
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
