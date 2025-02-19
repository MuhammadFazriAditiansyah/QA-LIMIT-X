<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(239, 239, 239);
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1000px;
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .img-left img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .img-left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card-body {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .form-input {
            position: relative;
            margin-bottom: 20px;
        }

        .form-input span {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
            color: #28a745;
        }

        .form-input input {
            padding-left: 35px;
            height: 45px;
        }

        .btn {
            border-radius: 30px;
            height: 40px; /* Ubah dari 45px menjadi 35px agar lebih kecil */
            font-size: 15px; /* Perkecil ukuran font */
            padding: 5px 15px; /* Sesuaikan padding agar tetap proporsional */
        }

        .register-link {
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .hr-line {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10">
                <div class="card flex-row">
                    <!-- Bagian gambar -->
                    <div class="img-left d-none d-md-flex">
                        <img src="{{ asset('assets/img/futami.jpg') }}" alt="Logo Futami">
                    </div>

                    <!-- Bagian form -->
                    <div class="card-body">
                        <h3 class="text-center mb-3">Login</h3>
                        <form class="form-box px-3" method="POST" action="{{ route('login.auth') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(Session::get('loginFail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('loginFail') }}
                                </div>
                            @endif

                            <div class="form-input mb-4">
                                <span><i class="fa fa-user"></i></span>
                                <input type="text" name="nohp" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-input mb-4">
                                <span><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-success btn-block text-uppercase">
                                    Login
                                </button>
                            </div>

                            <hr class="hr-line">

                            <div class="text-center">
                                Belum punya akun?
                                <a href="/register" class="register-link">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
