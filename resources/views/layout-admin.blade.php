<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Futami</title>
    <link rel="stylesheet" href="{{asset('assets/css/live-search.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/img/futami bg.png') }}" type="image/x-icon">

    {{-- script untuk search ajax --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/template/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/template/plugins/summernote/summernote-bs4.min.css')}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            {{-- <img class="animation__shake" src="{{asset('assets/template/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60"> --}}
            <img class="animation__shake" src="{{asset('assets/img/futami bg.png')}}" alt="AdminLTELogo" height="120" width="120">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/admin" class="brand-link">
                <img src="{{asset('assets/template/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                {{-- <img src="{{asset('assets/img/futami bg.png')}}" alt="AdminLTE Logo" class="brand-image img-circle-left" style="margin-left:-1%;"> --}}
                <span class="brand-text font-weight-light">Super Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <img alt="image" src="{{asset('assets/img/avatar_admin.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">

                    <div class="info">
                        <a href="/admin" class="d-block">{{ Auth::user()->nama }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    @if (Auth::user()->role_id == 4)
                        {{-- <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                                <li class="dropdown {{ request()->is('supervisor') ? 'active' : '' }}">
                                    <a href="/supervisor" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                </li>
                        </ul>  --}}

                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                {{-- <a href="/admin" class="nav-link {{ request()->is('admin*') || request()->is('superadmin*') && !request()->is('admin/adduser') ? 'active' : '' }}"> --}}
                                {{-- Request nya dalam kurung agar semua yang ada di admin/superadmin akan active kecuali nya maka akan berjalan  --}}
                                <a href="/admin" class="nav-link {{ (request()->is('admin*') || request()->is('superadmin*')) && !request()->is('admin/adduser') && !request()->is('superadmin/profile') && !request()->is('superadmin/profile/password') && !request()->is('admin/adduser/edit/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="/admin/role" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Tambah Role
                                    </p>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="/admin/adduser" class="nav-link {{ request()->is('admin/adduser') ? 'active' : '' }} || {{ request()->is('admin/adduser/edit/*') ? 'active' : '' }}">
                                    <i class="nav-icon fa-solid fa-user-plus"></i><p>Users</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/superadmin/profile" class="nav-link {{ request()->is('superadmin/profile') ? 'active' : '' }} || {{ request()->is('superadmin/profile/password') ? 'active' : '' }}">
                                    <i class="nav-icon fa-regular fa-user"></i><p>Profile</p>
                                </a>
                            </li>

                            {{-- <li class="dropdown" style="margin-top: 70%;">
                                <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                            </li> --}}
                            <li class="nav-item" style="margin-top:70%;">
                                <a href="/logout" class="nav-link text-danger">
                                    <i class="fas fa-sign-out-alt"></i><p>Logout</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')
        @include('sweetalert::alert')

        @if ($errors->has('notAllowed'))
            <script>
                swal('Peringatan', '{{ $errors->first('notAllowed') }}', 'error');
            </script>
        @endif



        {{-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
              <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
          </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('assets/template/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('assets/template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('assets/template/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('assets/template/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('assets/template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('assets/template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('assets/template/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/template/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('assets/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/template/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('assets/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/template/dist/js/adminlte.js')}}"></script>


    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('assets/template/dist/js/demo.js')}}"></script> --}}


    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('assets/template/dist/js/pages/dashboard.js')}}"></script>

    {{-- script untuk search ajax --}}

</body>

</html>
