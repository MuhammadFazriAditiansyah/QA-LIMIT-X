@extends('layout-operator')
@section('content')
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    {{-- <img alt="image" src="{{asset('assets/img/admin.jpg')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;"> --}}
                    <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
                    {{-- <img class="img-profile rounded-circle" src="{{asset('assets/img/admin.jpg')}}"> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Hi, {{ Auth::user()->nama }}</div>
                    <a href="/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    
                     {{-- <a href="features-activities.html" class="dropdown-item has-icon">
                        <i class="fas fa-bolt"></i> Activities
                    </a> --}}
                    {{-- <a href="features-settings.html" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Settings
                    </a> --}}
                </div>
            </li>
        </ul>
    </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand mt-2">
                {{-- <a href="#">Futami Operator</a> --}}
                <img alt="image" src="{{asset('assets/img/futami bg.png')}}" class="rounded-medium justify-content-center" style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
            </div>
            <div class="sidebar-brand sidebar-brand-sm ">
                {{-- <a href="index.html">FO</a> --}} 
                <img alt="image" src="{{asset('assets/img/logo-futami-sidebar.png')}}" class="rounded-circle justify-content-center" style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
            </div>
            



            <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                {{-- <li class="menu-header">Dashboard</li> --}}
                <li class="dropdown">
                    <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="dropdown active">
                    <a href="/profile" class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a>
                </li>



                {{-- <li class="dropdown" style="margin-top: 130%;">
                    <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li> --}}



            </ul>
            <hr>
        </aside> 
    </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hi, {{ Auth::user()->nama }}!</h2>
            <p class="section-lead">
              Change information about yourself on this page.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">                     
                    <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle profile-widget-picture">
                    {{-- <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Posts</div>
                        <div class="profile-widget-item-value">187</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Followers</div>
                        <div class="profile-widget-item-value">6,8K</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Following</div>
                        <div class="profile-widget-item-value">2,1K</div>
                      </div>
                    </div> --}}
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">{{ Auth::user()->nama }} 
                        <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> 
                            @if(Auth::user()->jabatan == 1)
                                Operator
                            @elseif(Auth::user()->jabatan == 2)
                                Staff
                            @elseif(Auth::user()->jabatan == 3)
                                Supervisor
                            @elseif(Auth::user()->jabatan == 4)
                                Superadmin
                            @endif
                        </div>
                    </div>
                    {{ Auth::user()->nama }} adalah seorang  
                    @if(Auth::user()->jabatan == 1)
                        Operator
                    @elseif(Auth::user()->jabatan == 2)
                        Staff
                    @elseif(Auth::user()->jabatan == 3)
                        Supervisor
                    @elseif(Auth::user()->jabatan == 4)
                        Superadmin
                    @endif
                    dalam website ini.
                  </div>
                  <div class="card-footer text-center">
                    {{-- <div class="font-weight-bold mb-2">Follow Ujang On</div> --}}
                    {{-- <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-github mr-1">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-instagram">
                      <i class="fab fa-instagram"></i>
                    </a> --}}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="POST" class="needs-validation" action="{{ route('profile.post', Auth::user()->id) }}">
                        @csrf
                        @method('PATCH')
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

                        @if(Session::get('successUpdate'))
                            <div class="alert alert-success w-70">
                                {{Session::get('successUpdate')}}
                            </div>
                        @endif

                        <div class="card-header">
                        <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">                               
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input type="text" name="nama" class="form-control" value="{{$users['nama']}}" required="">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>No.Handphone</label>
                                <input type="tel" name="nohp" class="form-control" value="{{$users['nohp']}}" required="" disabled>
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{$users['email']}}" required="" disabled>
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="@if($users['jabatan'] == 1) Operator @elseif($users['jabatan'] == 2) Staff @elseif($users['jabatan'] == 3) Supervisor @elseif($users['jabatan'] == 4) Superadmin @endif" required="" disabled>
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi
                                </div>
                            </div> 
                            {{-- <div class="form-group col-md-6 col-12">
                                <label>Password</label>
                                <div class="input-group">
                                    <input id="password-input" name="password" type="password" class="form-control" value="{{ $users['password'] }}" required="">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Kolom ini harus di isi
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                            <div class="row">
                            <div class="form-group col-12">
                                <label>Alamat</label>
                                <textarea class="form-control summernote-simple" name="alamat" value="{{ $users['alamat'] }}" required="">{{ $users['alamat'] }}</textarea>
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card-footer text-right" style="margin-top:-3%;">
                            <button stype="submit" class="btn btn-primary">Simpan perubahan</button>
                            {{-- <a href="/profile/password_verify" class="btn btn-icon icon-left btn-danger" style="float: left;"><i class="far fa-user"></i> Ganti Password</a> --}}
                            <a href="/profile/password" class="btn btn-icon icon-left btn-danger" style="float: left;"><i class="far fa-user"></i> Ganti Password</a>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      {{-- <footer class="main-footer">
        <div class="footer-left">
            Futami profile
        </div>
        <div class="footer-right">
          
        </div>
      </footer> --}}
    </div>
  </div>

  

<script>
    $(document).ready(function() {
        $("#toggle-password").click(function() {
            var passwordInput = $("#password-input");
            var icon = $("#toggle-password i");
            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
</script>



@endsection

