@extends('layout-login')
@section('content')

        <div class="card-body">
          <h4 class="title text-center mt-4">
            Login form
          </h4>
          <form class="form-box px-3" method="POST" action="{{route('login.auth')}}">
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


            @if(Session::get('success'))
                <div class="alert alert-success w-70">
                    {{Session::get('success')}}
                </div>
            @endif

            @if(Session::get('successLogout'))
              <div class="alert alert-success w-70">
                  {{Session::get('successLogout')}}
              </div>
            @endif

            <!-- fail, jika gagal login -->
            @if(Session::get('loginFail'))
                <div class="alert alert-danger w-70">
                    {{Session::get('loginFail')}}
                </div>
            @endif

            {{-- disesuaikan dengan halaman Middleware, sehingga harus login untuk akses perpus, tidak bisa http://127.0.0.1:8000/dashboardUser/user --}}
            @if(Session::get('notAllowed'))
                <div class="alert alert-danger w-70">
                    {{Session::get('notAllowed')}}
                </div>
            @endif





            <div class="card">
                <div class="img-left"></div>
                <div class="card-body">
                  <h2 class="title">Login Form</h2>
                  <form action="/login" method="POST">
                    <div class="form-input">
                      <span><i class="fa-solid fa-user"></i></span>
                      <input type="text" name="nohp" placeholder="Masukan UserName" required>
                    </div>
                    <div class="form-input">
                      <span><i class="fa fa-key"></i></span>
                      <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-block text-uppercase">
                        Login
                      </button>
                    </div>
                    <hr class="my-4">
                    <div class="text-center mb-2">
                      <p>Belum punya account? <a href="/register" class="register-link">Register here</a></p>
                      <a href="/" class="register-link">Kembali</a>
                    </div>
                  </form>
                </div>
              </div>
            @endsection

