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
                    <a href="/operator/profile" class="dropdown-item has-icon">
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
                    <a href="/operator/profile" class="nav-link"><i class="fas fa-user"></i><span>Profile</span></a>
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
                <h1>Ganti Password</h1> 
              </div>
              <div class="section-body">
                <div class="row mt-sm-4 justify-content-center d-flex">
                  <div class="col-12 col-md-12 col-lg-7">
                    <div class="card shadow">
                        {{-- <form method="POST" class="needs-validation" action="{{ route('password.post', Auth::user()->id) }}">
                            @csrf
                            @method('PATCH')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
    
                            @if(Session::get('successVerify'))
                                <div class="alert alert-success w-70">
                                    {{Session::get('successVerify')}}
                                </div>
                            @endif
    


                            <div class="card-header">
                                <h4>Ganti Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">                               
                                    <div class="form-group col-md-12 col-12">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            Kolom ini harus di isi
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                            <div class="card-footer text-right" style="margin-top:-3%;">
                                <button stype="submit" class="btn btn-primary">Submit</button>
                                <a href="/profile/password_verify" class="btn btn-icon icon-left btn-danger" style="float: left;">Back</a>
                            </div>
                        </form> --}}
                        <form method="POST" class="needs-validation" action="{{ route('password.update', Auth::user()->id) }}">
                            @csrf
                            @method('PATCH')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        
                            @if(Session::get('successVerify'))
                                <div class="alert alert-success w-70">
                                    {{Session::get('successVerify')}}
                                </div>
                            @endif 
    


                            <div class="card-header">
                                <h4>Ganti Password</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">                               
                                    <div class="form-group col-md-12 col-12">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            Kolom ini harus di isi
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                            <div class="card-footer text-right" style="margin-top:-3%;">
                                <button stype="submit" class="btn btn-primary">Submit</button>
                                <a href="/profile" class="btn btn-icon icon-left btn-danger" style="float: left;">Back</a>
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


