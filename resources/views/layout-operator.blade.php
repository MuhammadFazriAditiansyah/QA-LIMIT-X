<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Futami QC Apps</title>

    {{-- Style sendiri --}}
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.3.0/remixicon.css" integrity="sha512-0JEaZ1BDR+FsrPtq5Ap9o05MUwn8lKs2GiCcRVdOH0qDcUcCoMKi8fDVJ9gnG8VN1Mp/vuWw2sMO0SQom5th4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="{{asset('assets/img/logo-futami.jpg')}}" rel="icon" style="width: 50%; height:50%;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/template/stisla/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/template/stisla/assets/css/components.css')}}">
    <!-- Start GA -->

    {{-- script untuk select2 --}}
    <link rel="stylesheet" href="{{asset('assets/css/select2.css')}}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}




    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->

    {{-- link untuk create multi form --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- Sweet alert  --}}
    <script src="{{ asset('vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body>





    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
            @if (Str::startsWith(request()->path(), 'operator'))
                @if (
                        !Str::startsWith(request()->path(), 'operator/data') && !Str::startsWith(request()->path(), 'operator/mikrobiologi') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/produk') && !Str::startsWith(request()->path(), 'operator/analisakimia/edit/') && !Str::startsWith(request()->path(), 'operator/analisakimia/sampel/')
                        && !Str::startsWith(request()->path(), 'operator/add_mikrobiologi') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/sampel/')
                        && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk/sampel/')
                        && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk_percobaan/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk_percobaan/sampel/')

                        && !Str::startsWith(request()->path(), 'operator/laporan_analisa_air')
                        && !Str::startsWith(request()->path(), 'operator/parameter_pengujian/edit/')
                    )


                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </form>
                @endif

            @elseif (Str::startsWith(request()->path(), 'staff'))
                @if ( !Str::startsWith(request()->path(), 'staff/data') && !Str::startsWith(request()->path(), 'staff/mikrobiologi') && !Str::startsWith(request()->path(), 'staff/mikrobiologi/produk') && !Str::startsWith(request()->path(), 'operator/analisakimia/edit/') && !Str::startsWith(request()->path(), 'operator/analisakimia/sampel/')
                    && !Str::startsWith(request()->path(), 'staff/laporan_analisa_air')
                    // && !Str::startsWith(request()->path(), 'operator/add_mikrobiologi') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/sampel/')
                )


                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </form>
                @endif
            @elseif (Str::startsWith(request()->path(), 'supervisor'))
                @if (
                    !Str::startsWith(request()->path(), 'supervisor/data') && !Str::startsWith(request()->path(), 'supervisor/mikrobiologi') && !Str::startsWith(request()->path(), 'supervisor/mikrobiologi/produk') && !Str::startsWith(request()->path(), 'operator/analisakimia/edit/') && !Str::startsWith(request()->path(), 'operator/analisakimia/sampel/')
                    // && !Str::startsWith(request()->path(), 'operator/add_mikrobiologi') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/sampel/')
                )


                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                    </form>
                @endif
            @endif





                {{-- OPERATOR SEARCH --}}
                @if (request()->is('operator/data'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('data') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tanggal_uji" id="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/data" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi') }}">
                        <ul class="navbar-nav mr-3">
                          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                          <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                          <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Muali" aria-label="Search" data-width="250">
                          <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                          <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_produk'))  {{-- search option --}}
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_produk') }}">
                        <div class="search-element">
                            <select name="pencarian" class="form-control" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-color: white; border: 1px solid #ccc; border-radius: 10px; font-size: 16px; color: #333;" onchange="changeInputId(this)">
                                <option hidden>-- Pilih Pencarian --</option>
                                <option value="tgl_produk">Tanggal Produksi</option>
                                <option value="tgl_inokulasi">Tanggal Inokulasi</option>
                                {{-- <option value="tgl_pengamatan">Tanggal Pengamatan</option> --}}
                            </select>
                                <input class="form-control" style="margin-left:10px;" type="date" name="tgl_mulai" id="tanggal_produksi" placeholder="Tanggal" aria-label="Search" data-width="200">
                                <input class="form-control" type="date" name="tgl_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="200">

                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>

                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_produk" style="margin-right:10%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>
                @elseif (request()->is('operator/mikrobiologi_proses_produksi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_proses_produksi') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_proses_produksi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_produk_percobaan'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_produk_percobaan') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_produk_percobaan" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_bahan_baku'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_bahan_baku') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_bahan_baku" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_bahan_kemas'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_bahan_kemas') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_bahan_kemas" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_ruangan'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_ruangan') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl-selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_ruangan" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_personil'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_personil') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_selesai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_personil" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_alat_mesin'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_alat_mesin') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl-mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_alat_mesin" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/mikrobiologi_kimia_sensori'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_kimia_sensori') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_produksi_awal" id="tanggal_produksi_awal" placeholder="Tanggal Produksi" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_produksi_akhir" id="tanggal_produksi_akhir" placeholder="Tanggal Produksi" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/mikrobiologi_kimia_sensori" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('operator/laporan_analisa_air'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('laporan_analisa_air') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_awal" id="tanggal_awal" placeholder="Tanggal" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_akhir" id="tanggal_akhir" placeholder="Tanggal" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/operator/laporan_analisa_air" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>






                {{-- STAFF SEARCH --}}
                @elseif (request()->is('staff/data'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('datastaff') }}">
                        <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                        <input class="form-control" type="date" name="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250">
                        <input class="form-control" type="date" name="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/data" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi') }}">
                        <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                        <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai" aria-label="Search" data-width="250">
                        <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_produk'))
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_produk') }}">
                        <div class="search-element">
                            <select name="pencarian" class="form-control" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-color: white; border: 1px solid #ccc; border-radius: 10px; font-size: 16px; color: #333;" onchange="changeInputId(this)">
                                <option hidden>-- Pilih Pencarian --</option>
                                <option value="tgl_produk">Tanggal Produksi</option>
                                <option value="tgl_inokulasi">Tanggal Inokulasi</option>
                                {{-- <option value="tgl_pengamatan">Tanggal Pengamatan</option> --}}
                            </select>
                                <input class="form-control" style="margin-left:10px;" type="date" name="tgl_mulai" id="tanggal_produksi" placeholder="Tanggal" aria-label="Search" data-width="200">
                                <input class="form-control" type="date" name="tgl_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="200">

                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_produk" style="margin-right:10%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_proses_produksi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_proses_produksi') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_proses_produksi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_produk_percobaan'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_produk_percobaan') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_produk_percobaan" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_bahan_baku'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_bahan_baku') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_bahan_baku" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_bahan_kemas'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_bahan_kemas') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_bahan_kemas" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_ruangan'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_ruangan') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_ruangan" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_personil'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_personil') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_personil" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_alat_mesin'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_alat_mesin') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_alat_mesin" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/mikrobiologi_kimia_sensori'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_mikrobiologi_kimia_sensori') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_produksi_awal" id="tanggal_produksi_awal" placeholder="Tanggal Produksi" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_produksi_akhir" id="tanggal_produksi_akhir" placeholder="Tanggal Produksi" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/mikrobiologi_kimia_sensori" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('staff/laporan_analisa_air'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('staff_laporan_analisa_air') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_awal" id="tanggal_awal" placeholder="Tanggal" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_akhir" id="tanggal_akhir" placeholder="Tanggal" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/staff/laporan_analisa_air" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>





                {{-- SUPERVISOR SEARCH --}}
                @elseif (request()->is('supervisor/data'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('datasupervisor') }}">
                        <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                        <input class="form-control" type="date" name="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250">
                        <input class="form-control" type="date" name="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/data" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi') }}">
                        <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                        <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai" aria-label="Search" data-width="250">
                        <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_produk'))
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_produk') }}">
                        <div class="search-element">
                            <select name="pencarian" class="form-control" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-color: white; border: 1px solid #ccc; border-radius: 10px; font-size: 16px; color: #333;" onchange="changeInputId(this)">
                                <option hidden>-- Pilih Pencarian --</option>
                                <option value="tgl_produk">Tanggal Produksi</option>
                                <option value="tgl_inokulasi">Tanggal Inokulasi</option>
                                {{-- <option value="tgl_pengamatan">Tanggal Pengamatan</option> --}}
                            </select>
                                <input class="form-control" style="margin-left:10px;" type="date" name="tgl_mulai" id="tanggal_produksi" placeholder="Tanggal" aria-label="Search" data-width="200">
                                <input class="form-control" type="date" name="tgl_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="200">

                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_produk" style="margin-right:10%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_proses_produksi'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_proses_produksi') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_proses_produksi" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_produk_percobaan'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_produk_percobaan') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_produk_percobaan" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_bahan_baku'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_bahan_baku') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_bahan_baku" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_bahan_kemas'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_bahan_kemas') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Inokulasi" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal Pengamatan" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_bahan_kemas" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_ruangan'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_ruangan') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl-mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl-selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_ruangan" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_personil'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_personil') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_personil" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_alat_mesin'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_alat_mesin') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal mulai" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_selesai" id="tgl_selesai" placeholder="Tanggal selesai" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_alat_mesin" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                @elseif (request()->is('supervisor/mikrobiologi_kimia_sensori'))
                    <form class="form-inline mr-auto" method="GET" action="{{ route('supervisor_mikrobiologi_kimia_sensori') }}">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                        </ul>
                        <div class="search-element">
                            <input class="form-control" type="date" name="tgl_produksi_awal" id="tanggal_produksi_awal" placeholder="Tanggal Produksi" aria-label="Search" data-width="250">
                            <input class="form-control" type="date" name="tgl_produksi_akhir" id="tanggal_produksi_akhir" placeholder="Tanggal Produksi" aria-label="Search" data-width="250">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <a class="text-success btn" href="/supervisor/mikrobiologi_kimia_sensori" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>




                @endif






                <ul class="navbar-nav navbar-right">
                    @if (Str::startsWith(request()->path(), 'operator'))
                        @if (
                                !Str::startsWith(request()->path(), 'operator/mikrobiologi/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk/history') && !Str::startsWith(request()->path(), 'operator/sampelanalisakimia/') && !Str::startsWith(request()->path(), 'operator/analisakimia/edit/') && !Str::startsWith(request()->path(), 'operator/analisakimia/sampel/') && !Str::startsWith(request()->path(), 'operator/analisakimia')
                                && !Str::startsWith(request()->path(), 'operator/add_mikrobiologi') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi/sampel/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk/edit/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk/sampel/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_produk/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_proses_produksi/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_proses_produksi/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_proses_produksi/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_proses_produksi/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk_percobaan/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk_percobaan/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_produk_percobaan/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_produk_percobaan/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_bahan_baku/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_bahan_baku/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_bahan_baku/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_bahan_baku/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_bahan_kemas/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_bahan_kemas/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_bahan_kemas/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_bahan_kemas/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_ruangan/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_ruangan/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_ruangan/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_ruangan/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_personil/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_personil/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_personil/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_personil/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_alat_mesin/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_alat_mesin/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_alat_mesin/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_alat_mesin/')
                                && !Str::startsWith(request()->path(), 'operator/mikrobiologi_kimia_sensori/sampel/') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_kimia_sensori/history') && !Str::startsWith(request()->path(), 'operator/mikrobiologi_kimia_sensori/edit/') && !Str::startsWith(request()->path(), 'operator/sampel_mikrobiologi_kimia_sensori/')
                                && !Str::startsWith(request()->path(), 'operator/add_laporan_analisa_air') && !Str::startsWith(request()->path(), 'operator/laporan_analisa_air/history') && !Str::startsWith(request()->path(), 'operator/sampel_laporan_analisa_air/') && !Str::startsWith(request()->path(), 'operator/laporan_analisa_air/edit/') && !Str::startsWith(request()->path(), 'operator/laporan_analisa_air/sampel/')

                                && !Str::startsWith(request()->path(), 'operator/parameter_pengujian/edit/')
                            )


                            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
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
                            </div>
                            </li>
                        @endif
                    @elseif (Str::startsWith(request()->path(), 'staff'))
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
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
                        </div>
                        </li>
                    @elseif (Str::startsWith(request()->path(), 'supervisor'))
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
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
                        </div>
                        </li>
                    @endif


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

                    @if(Auth::user()->role_id == 1) {{-- hanya pengguna dengan role 1 yang bisa mengakses menu ini --}}
                        <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                            <li class="dropdown {{ request()->is('operator') ? 'active' : '' }}">
                                <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                            </li>

                            {{-- <li class="menu-header">Dashboard</li> --}}
                                <li class="dropdown {{request()->is('operator/data')
                                || request()->is('operator/mikrobiologi_kimia_sensori')
                                || request()->is('operator/laporan_analisa_air')
                                || request()->is('operator/parameter_pengujian') ? ' active': ''}}">

                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-flask-vial"></i> <span>Kimia</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown {{ request()->is('operator/data') || request()->is('operator/analisakimia/history') ? 'active' : '' }}">
                                            <a href="/operator/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                                        </li>

                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_kimia_sensori') || request()->is('operator/add_mikrobiologi_kimia_sensori') || (request()->is('operator/sampel_mikrobiologi_kimia_sensori/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_kimia_sensori" class="nav-link"><i class="fas fa-atom"></i><span>Pemeriksaan Kimia Dan Sensori</span></a>
                                        </li>


                                        <li class="dropdown {{ request()->is('operator/laporan_analisa_air') || request()->is('operator/add_laporan_analisa_air') || (request()->is('operator/sampel_laporan_analisa_air/*')) ? 'active' : '' }}">
                                            <a href="/operator/laporan_analisa_air" class="nav-link"><i class="fas fa-water"></i><span>Laporan Analisa Air</span></a>
                                        </li>

                                        {{-- Parameter Pengujian --}}
                                        <li class="dropdown {{ request()->is('operator/parameter_pengujian') ? 'active' : '' }}">
                                            <a href="/operator/parameter_pengujian" class="nav-link"><i class="fas fa-plus"></i><span>Parameter Pengujian</span></a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="dropdown {{ request()->is('operator/mikrobiologi')
                                    || request()->is('operator/mikrobiologi_produk')
                                    || request()->is('operator/mikrobiologi_proses_produksi')
                                    || request()->is('operator/mikrobiologi_produk_percobaan')
                                    || request()->is('operator/mikrobiologi_bahan_baku')
                                    || request()->is('operator/mikrobiologi_bahan_kemas')
                                    || request()->is('operator/mikrobiologi_ruangan')
                                    || request()->is('operator/mikrobiologi_personil')
                                    || request()->is('operator/mikrobiologi_alat_mesin')
                                ? 'active' : '' }}">


                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-microscope"></i> <span>Mikrobiologi</span></a>
                                    <ul class="dropdown-menu">
                                        {{-- Mikrobiologi Air --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi') ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                                        </li>

                                        {{-- Mikrobiologi Produk --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_produk') || request()->is('operator/add_mikrobiologi_produk') || (request()->is('operator/sampel_mikrobiologi_produk/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                                        </li>

                                        {{-- Mikrobiologi Proses Produksi --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_proses_produksi') || request()->is('operator/add_mikrobiologi_proses_produksi') || (request()->is('operator/sampel_mikrobiologi_proses_produksi/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_proses_produksi" class="nav-link"><i class="fas fa-truck-ramp-box"></i><span>Mikrobiologi Proses Produksi</span></a>
                                        </li>

                                        {{-- Mikrobiologi Produk Percobaan --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_produk_percobaan') || request()->is('operator/add_mikrobiologi_produk_percobaan') || (request()->is('operator/sampel_mikrobiologi_produk_percobaan/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_produk_percobaan" class="nav-link"><i class="fas fa-box-open"></i><span>Mikrobiologi Produk Percobaan</span></a>
                                        </li>

                                        {{-- Mikrobiologi Bahan Baku --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_bahan_baku') || request()->is('operator/add_mikrobiologi_bahan_baku') || (request()->is('operator/sampel_mikrobiologi_bahan_baku/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_bahan_baku" class="nav-link"><i class="fas fa-shopping-basket"></i><span>Mikrobiologi Bahan Baku</span></a>
                                        </li>

                                        {{-- Mikrobiologi Bahan Kemas --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_bahan_kemas') || request()->is('operator/add_mikrobiologi_bahan_kemas') || (request()->is('operator/sampel_mikrobiologi_bahan_kemas/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_bahan_kemas" class="nav-link"><i class="fas fa-bottle-droplet"></i><span>Mikrobiologi Bahan Kemas</span></a>
                                        </li>

                                        {{-- Mikrobiologi Ruangan --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_ruangan') || request()->is('operator/add_mikrobiologi_ruangan') || (request()->is('operator/sampel_mikrobiologi_ruangan/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_ruangan" class="nav-link"><i class="fas fa-house-chimney-window"></i><span>Mikrobiologi Ruangan</span></a>
                                        </li>

                                        {{-- Mikrobiologi Personil --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_personil') || request()->is('operator/add_mikrobiologi_personil') || (request()->is('operator/sampel_mikrobiologi_personil/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_personil" class="nav-link"><i class="fas fa-microscope"></i><span>Mikrobiologi Personil</span></a>
                                        </li>

                                        {{-- Mikrobiologi Alat Dan Mesin --}}
                                        <li class="dropdown {{ request()->is('operator/mikrobiologi_alat_mesin') || request()->is('operator/add_mikrobiologi_alat_mesin') || (request()->is('operator/sampel_mikrobiologi_alat_mesin/*')) ? 'active' : '' }}">
                                            <a href="/operator/mikrobiologi_alat_mesin" class="nav-link"><i class="fas fa-screwdriver-wrench"></i><span>Mikrobiologi Alat Dan Mesin</span></a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('exported.files') }}">
                                        <i class="fas fa-file-excel"></i> Daftar Export
                                    </a>
                                </li>
                        </ul>
                    @elseif (Auth::user()->role_id == 2)
                        <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                            {{-- <li class="menu-header">Dashboard</li> --}}

                                <li class="dropdown {{ request()->is('staff') ? 'active' : '' }}">
                                    <a href="/staff" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                </li>

                                <li class="dropdown {{request()->is('staff/data')
                                || request()->is('staff/laporan_analisa_air')

                                || request()->is('staff/mikrobiologi_kimia_sensori') ? ' active': ''}}">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-flask-vial"></i> <span>Kimia</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown {{ request()->is('staff/data') || request()->is('staff/analisakimia/history') ? 'active' : '' }}">
                                            <a href="/staff/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                                        </li>

                                        {{-- Mikrobiologi Kimia Dan Sensori  --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_kimia_sensori') || request()->is('staff/add_mikrobiologi_kimia_sensori') || (request()->is('staff/sampel_mikrobiologi_kimia_sensori/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_kimia_sensori" class="nav-link"><i class="fas fa-atom"></i><span>Pemeriksaan Kimia Dan Sensori</span></a>
                                        </li>

                                        <li class="dropdown {{ request()->is('staff/laporan_analisa_air') || request()->is('staff/add_laporan_analisa_air') || (request()->is('staff/sampel_laporan_analisa_air/*')) ? 'active' : '' }}">
                                            <a href="/staff/laporan_analisa_air" class="nav-link"><i class="fas fa-water"></i><span>Laporan Analisa Air</span></a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="dropdown {{ request()->is('staff/mikrobiologi')
                                    || request()->is('staff/mikrobiologi_produk')
                                    || request()->is('staff/mikrobiologi_proses_produksi')
                                    || request()->is('staff/mikrobiologi_produk_percobaan')
                                    || request()->is('staff/mikrobiologi_bahan_baku')
                                    || request()->is('staff/mikrobiologi_bahan_kemas')
                                    || request()->is('staff/mikrobiologi_ruangan')
                                    || request()->is('staff/mikrobiologi_personil')
                                    || request()->is('staff/mikrobiologi_alat_mesin')
                                ? 'active' : '' }}">

                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-microscope"></i> <span>Mikrobiologi</span></a>
                                    <ul class="dropdown-menu">
                                        {{-- Mikrobiologi Air --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi') ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                                        </li>

                                        {{-- Mikrobiologi Produk --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_produk') || request()->is('staff/add_mikrobiologi_produk') || (request()->is('staff/sampel_mikrobiologi_produk/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                                        </li>

                                        {{-- Mikrobiologi Proses Produksi --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_proses_produksi') || request()->is('staff/add_mikrobiologi_proses_produksi') || (request()->is('staff/sampel_mikrobiologi_proses_produksi/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_proses_produksi" class="nav-link"><i class="fas fa-truck-ramp-box"></i><span>Mikrobiologi Proses Produksi</span></a>
                                        </li>

                                        {{-- Mikrobiologi Produk Percobaan --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_produk_percobaan') || request()->is('staff/add_mikrobiologi_produk_percobaan') || (request()->is('staff/sampel_mikrobiologi_produk_percobaan/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_produk_percobaan" class="nav-link"><i class="fas fa-box-open"></i><span>Mikrobiologi Produk Percobaan</span></a>
                                        </li>

                                        {{-- Mikrobiologi Bahan Baku --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_bahan_baku') || request()->is('staff/add_mikrobiologi_bahan_baku') || (request()->is('staff/sampel_mikrobiologi_bahan_baku/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_bahan_baku" class="nav-link"><i class="fas fa-shopping-basket"></i><span>Mikrobiologi Bahan Baku</span></a>
                                        </li>

                                        {{-- Mikrobiologi Bahan Kemas --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_bahan_kemas') || request()->is('staff/add_mikrobiologi_bahan_kemas') || (request()->is('staff/sampel_mikrobiologi_bahan_kemas/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_bahan_kemas" class="nav-link"><i class="fas fa-bottle-droplet"></i><span>Mikrobiologi Bahan Kemas</span></a>
                                        </li>

                                        {{-- Mikrobiologi Ruangan --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_ruangan') || request()->is('staff/add_mikrobiologi_ruangan') || (request()->is('staff/sampel_mikrobiologi_ruangan/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_ruangan" class="nav-link"><i class="fas fa-house-chimney-window"></i><span>Mikrobiologi Ruangan</span></a>
                                        </li>

                                        {{-- Mikrobiologi Personil --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_personil') || request()->is('staff/add_mikrobiologi_personil') || (request()->is('staff/sampel_mikrobiologi_personil/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_personil" class="nav-link"><i class="fas fa-microscope"></i><span>Mikrobiologi Personil</span></a>
                                        </li>

                                        {{-- Mikrobiologi Alat Dan Mesin --}}
                                        <li class="dropdown {{ request()->is('staff/mikrobiologi_alat_mesin') || request()->is('staff/add_mikrobiologi_alat_mesin') || (request()->is('staff/sampel_mikrobiologi_alat_mesin/*')) ? 'active' : '' }}">
                                            <a href="/staff/mikrobiologi_alat_mesin" class="nav-link"><i class="fas fa-screwdriver-wrench"></i><span>Mikrobiologi Alat Dan Mesin</span></a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('exported.files') }}">
                                        <i class="fas fa-file-excel"></i> Daftar Export
                                    </a>
                                </li>
                        </ul>

                    @elseif (Auth::user()->role_id == 3 || Auth::user()->role_id == 5)
                        <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                            {{-- <li class="menu-header">Dashboard</li> --}}

                                <li class="dropdown {{ request()->is('supervisor') ? 'active' : '' }}">
                                    <a href="/supervisor" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                                </li>

                                <li class="dropdown {{request()->is('supervisor/data')
                                || request()->is('supervisor/laporan_analisa_air')
                                || request()->is('supervisor/mikrobiologi_kimia_sensori') ? ' active': ''}}">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-flask-vial"></i> <span>Kimia</span></a>
                                    <ul class="dropdown-menu">
                                            <li class="dropdown {{ request()->is('supervisor/data') || request()->is('supervisor/analisakimia/history') ? 'active' : '' }}">
                                                <a href="/supervisor/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                                            </li>

                                        @if (Auth::user()->role_id == 5)
                                            {{-- Mikrobiologi Kimia Dan Sensori  --}}
                                            <li class="dropdown {{ request()->is('supervisor/mikrobiologi_kimia_sensori') || request()->is('supervisor/add_mikrobiologi_kimia_sensori') || (request()->is('supervisor/sampel_mikrobiologi_kimia_sensori/*')) ? 'active' : '' }}">
                                                <a href="/supervisor/mikrobiologi_kimia_sensori" class="nav-link"><i class="fas fa-atom"></i><span>Pemeriksaan Kimia Dan Sensori</span></a>
                                            </li>
                                        @endif

                                            {{-- Laporan Analisa Air --}}
                                        <li class="dropdown {{ request()->is('supervisor/laporan_analisa_air') || request()->is('supervisor/add_laporan_analisa_air') || (request()->is('supervisor/sampel_laporan_analisa_air/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/laporan_analisa_air" class="nav-link"><i class="fas fa-water"></i><span>Laporan Analisa Air</span></a>
                                        </li>

                                    </ul>
                                </li>


                                <li class="dropdown {{ request()->is('supervisor/mikrobiologi')
                                    || request()->is('supervisor/mikrobiologi_produk')
                                    || request()->is('supervisor/mikrobiologi_proses_produksi')
                                    || request()->is('supervisor/mikrobiologi_produk_percobaan')
                                    || request()->is('supervisor/mikrobiologi_bahan_baku')
                                    || request()->is('supervisor/mikrobiologi_bahan_kemas')
                                    || request()->is('supervisor/mikrobiologi_ruangan')
                                    || request()->is('supervisor/mikrobiologi_personil')
                                    || request()->is('supervisor/mikrobiologi_alat_mesin')
                                ? 'active' : '' }}">

                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-microscope"></i> <span>Mikrobiologi</span></a>
                                    <ul class="dropdown-menu">
                                        {{-- Mikrobiologi Air --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi') ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                                        </li>

                                        {{-- Mikrobiologi Produk --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_produk') || request()->is('supervisor/add_mikrobiologi_produk') || (request()->is('supervisor/sampel_mikrobiologi_produk/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_produk" class="nav-link"><i class="fas fa-boxes-stacked"></i><span>Mikrobiologi Produk</span></a>
                                        </li>

                                        {{-- Mikrobiologi Proses Produksi --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_proses_produksi') || request()->is('supervisor/add_mikrobiologi_proses_produksi') || (request()->is('supervisor/sampel_mikrobiologi_proses_produksi/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_proses_produksi" class="nav-link"><i class="fas fa-truck-ramp-box"></i><span>Mikrobiologi Proses Produksi</span></a>
                                        </li>

                                        {{-- Mikrobiologi Produk Percobaan --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_produk_percobaan') || request()->is('supervisor/add_mikrobiologi_produk_percobaan') || (request()->is('supervisor/sampel_mikrobiologi_produk_percobaan/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_produk_percobaan" class="nav-link"><i class="fas fa-box-open"></i><span>Mikrobiologi Produk Percobaan</span></a>
                                        </li>

                                        {{-- Mikrobiologi Bahan Baku --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_bahan_baku') || request()->is('supervisor/add_mikrobiologi_bahan_baku') || (request()->is('supervisor/sampel_mikrobiologi_bahan_baku/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_bahan_baku" class="nav-link"><i class="fas fa-shopping-basket"></i><span>Mikrobiologi Bahan Baku</span></a>
                                        </li>

                                        {{-- Mikrobiologi Bahan Kemas --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_bahan_kemas') || request()->is('supervisor/add_mikrobiologi_bahan_kemas') || (request()->is('supervisor/sampel_mikrobiologi_bahan_kemas/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_bahan_kemas" class="nav-link"><i class="fas fa-bottle-droplet"></i><span>Mikrobiologi Bahan Kemas</span></a>
                                        </li>

                                        {{-- Mikrobiologi Ruangan --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_ruangan') || request()->is('supervisor/add_mikrobiologi_ruangan') || (request()->is('supervisor/sampel_mikrobiologi_ruangan/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_ruangan" class="nav-link"><i class="fas fa-house-chimney-window"></i><span>Mikrobiologi Ruangan</span></a>
                                        </li>

                                        {{-- Mikrobiologi Personil --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_personil') || request()->is('supervisor/add_mikrobiologi_personil') || (request()->is('supervisor/sampel_mikrobiologi_personil/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_personil" class="nav-link"><i class="fas fa-microscope"></i><span>Mikrobiologi Personil</span></a>
                                        </li>

                                        {{-- Mikrobiologi Alat Dan Mesin --}}
                                        <li class="dropdown {{ request()->is('supervisor/mikrobiologi_alat_mesin') || request()->is('supervisor/add_mikrobiologi_alat_mesin') || (request()->is('supervisor/sampel_mikrobiologi_alat_mesin/*')) ? 'active' : '' }}">
                                            <a href="/supervisor/mikrobiologi_alat_mesin" class="nav-link"><i class="fas fa-screwdriver-wrench"></i><span>Mikrobiologi Alat Dan Mesin</span></a>
                                        </li>


                                    </ul>
                                </li>




                        </ul>
                    @endif
                    <hr>
                </aside>
            </div>




            @yield('content')
            @include('sweetalert::alert')

            @if ($errors->has('notAllowed'))
                <script>
                    swal('Peringatan', '{{ $errors->first('notAllowed') }}', 'error');
                </script>
            @endif










            <footer class="main-footer">
                <div class="footer-left">
                    Futami QA
                    {{-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>








    <!-- General JS Scripts -->
    <script src="{{asset('assets/template/stisla/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/js/stisla.js')}}"></script>

    <script src="{{ asset('assets/template/stisla/assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/chart.min.js')}}"></script>
    <script src="{{ asset('assets/template/stisla/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/template/stisla/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{asset('assets/template/stisla/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>


    <!-- JS Libraies sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/template/stisla/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/template/stisla/assets/js/custom.js')}}"></script>




    <script>
        function changeInputId(selectOption) {
          var selectedOptionValue = selectOption.value;
          var tanggalInput = document.getElementById("tanggal_produksi");

          if (selectedOptionValue === "tanggal_produksi") {
            tanggalInput.name = "tanggal_produksi";
            tanggalInput.id = "tanggal_produksi";
            tanggalInput.placeholder = "Tanggal Produksi";
          } else if (selectedOptionValue === "tanggal_inokulasi") {
            tanggalInput.name = "tanggal_inokulasi";
            tanggalInput.id = "tanggal_inokulasi";
            tanggalInput.placeholder = "Tanggal Inokulasi";
          } else if (selectedOptionValue === "tanggal_pengamatan") {
            tanggalInput.name = "tanggal_pengamatan";
            tanggalInput.id = "tanggal_pengamatan";
            tanggalInput.placeholder = "Tanggal Pengamatan";
          }
        }
    </script>






    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        let prevPage = document.referrer; //url sebelumnya
        // let currentPage = window.location.href; //url saat ini
        let currentPage = window.location.pathname; // Mendapatkan path saat ini

        // window.addEventListener('load', function() {
        //   if (prevPage.includes('/operator/sampel_laporan_analisa_air/') && currentPage.includes('/operator/laporan_analisa_air')) {
        //     showSuccessAlert();
        //   }
        // });
        window.addEventListener('load', function() {
            if (prevPage.includes('/operator/sampel_laporan_analisa_air/') && currentPage === '/operator/laporan_analisa_air') {
                showSuccessAlert();
            }
        });

        // window.onload = function() {
        //     if (prevPage.includes('/operator/laporan_analisa_air/edit/') && currentPage.includes('/operator/laporan_analisa_air')) {
        //         showSuccessEdit();
        //     }
        // };
        window.addEventListener('load', function() {
            if (prevPage.includes('/operator/laporan_analisa_air/edit/') && currentPage === '/operator/laporan_analisa_air') {
                showSuccessEdit();
            }
        });




        // Function Alert nya
        function showSuccessAlert() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: function(toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Anda telah berhasil menambah dokumen!'
            });
        }
        function showSuccessEdit() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: function(toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Anda telah berhasil Mengedit dokumen!'
            });
        }
    </script>

    {{-- <script>
        window.onload = function() {
            var prevPage = document.referrer;
            var currentPage = window.location.href;

            if (prevPage.includes('/operator/laporan_analisa_air/edit/') && currentPage.includes('/operator/laporan_analisa_air')) {
                showSuccessEdit();
            }
        };

        function showSuccessEdit() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: function(toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Anda telah berhasil Mengedit dokumen!'
            });
        }
    </script> --}}











    {{-- <script>
        // Cek URL setelah halaman dimuat ulang

        window.onload = function() {
            // if (window.location.href.includes('/operator/laporan_analisa_air')) {
            //     showSuccessAlert();
            // }
            let currentURL = window.location.href;
            let targetURL = 'operator/sampel_laporan_analisa_air/';

            if (currentURL.startsWith(targetURL)) {
                showSuccessAlert();
            }
        }

        // Fungsi untuk menampilkan SweetAlert
        function showSuccessAlert() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

            Toast.fire({
                icon: 'success',
                title: 'Berhasil menyimpan dokumen!'
            })
        }
    </script> --}}

</html>
