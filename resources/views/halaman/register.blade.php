<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
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
            max-width: 1100px;
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
            padding: 25px 50px; /* Mengurangi padding top */
        }

        .form-input {
            position: relative;
        }

        .form-input span {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
            color: #28a745;
        }

        .form-input input,
        .form-input select,
        .form-input textarea {
            padding-left: 35px;
            height: 35px; /* Memperkecil tinggi input */
            font-size: 14px; /* Menyesuaikan ukuran font */
        }

        .form-input textarea {
            resize: none;
            height: 35px; /* Mengatur tinggi textarea */
        }

        .btn {
            border-radius: 30px;
            height: 35px; /* Ubah dari 45px menjadi 35px agar lebih kecil */
            font-size: 14px; /* Perkecil ukuran font */
            padding: 5px 15px; /* Sesuaikan padding agar tetap proporsional */
        }

        .register-link {
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        /* Optional: Menambahkan styling untuk responsif */
        @media (max-width: 767px) {
            .card {
                flex-direction: column;
            }

            .img-left {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-lg-8">
                <div class="card flex-row">
                    <!-- Bagian gambar -->
                    <div class="img-left d-none d-md-flex">
                        <img src="{{ asset('assets/img/futami.jpg') }}" alt="Logo Futami">
                    </div>

                    <!-- Bagian form -->
                    <div class="card-body">
                        <h3 class="text-center mb-4">Register</h3>
                        <form class="form-box px-3" method="POST" action="{{ route('register.post') }}">
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

                            <div class="form-input mb-3">
                                <span><i class="fa fa-user"></i></span>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="form-input mb-3">
                                <span><i class="fa fa-user-tag"></i></span>
                                <input type="text" name="nohp" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-input mb-3">
                                <span><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-input mb-3">
                                <span><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="form-input mb-3">
                                <span><i class="fa fa-briefcase"></i></span>
                                <select class="form-control" name="jabatan" required>
                                    <option hidden>-- Pilih Jenis Jabatan --</option>
                                    @foreach (['operator', 'staff'] as $role)
                                        <option value="{{ $loop->index + 1 }}">{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-input mb-3">
                                <span><i class="fa fa-map-marker-alt"></i></span>
                                <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat"></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success btn-block text-uppercase">
                                    Register
                                </button>
                            </div>

                            <hr class="hr-line"> <!-- Garis tambahan di bawah button -->

                            <div class="text-center">
                                Sudah punya akun?
                                <a href="/login" class="register-link">Login here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
