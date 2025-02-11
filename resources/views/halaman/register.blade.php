@extends('layout-login')
@section('content')

    <div class="card-body">
        <h4 class="title text-center mt-4">Register form</h4>
        <form class="form-box px-3" method="POST" action="{{ route('register.post') }}">
            @csrf
            @if ($errors->any())
                {{-- alert kalau tidak di isi, akan muncul alert denger  --}}
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="form-input">
                <span><i class="fa fa-user-o"></i></span>
                <input type="text" name="nama" placeholder="Nama anda" tabindex="10" required>
            </div>
            <div class="form-input">
                <span><i class="fa-solid fa-phone"></i></span>
                <input type="number" name="nohp" placeholder="No. Handphone" required>
            </div>
            <div class="form-input">
                <span><i class="fa fa-envelope-o"></i></span>
                <input type="email" name="email" placeholder="Email address" required>
            </div>
            <div class="form-input">
                <span><i class="fa fa-key"></i></span>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-input">
                <select class="form-control" name="jabatan">
                    <option hidden>-- Pilih Jenis Jabatan --</option>

                    @foreach ($roles as $role)
                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                    @endforeach

                </select>
            </div>

            <span style="margin-top:3%;">Alamat</span>
            <div class="form-input" style="margin-top:5%;">
                <textarea class="form-control" name="alamat"></textarea>
            </div>



            <div class="mb-3">
                <button type="submit" class="btn btn-block text-uppercase">
                    Register
                </button>
            </div>

            <hr class="my-4">

            <div class="text-center mb-2">
                Sudah punya account?
                <a href="/login" class="register-link">
                    Login here
                </a>
            </div>
        </form>
    </div>

@endsection
