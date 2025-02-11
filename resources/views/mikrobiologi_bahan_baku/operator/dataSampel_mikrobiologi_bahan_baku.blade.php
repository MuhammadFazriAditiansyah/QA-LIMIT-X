@extends('layout-operator')
@section('content')


    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto" method="GET" action="{{ route('data') }}">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">{{ Auth::user()->nama }}</div>
                            <a href="/profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
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
                            <a href="/operator/mikrobiologi_bahan_baku" class="nav-link"><i class="fas fa-shopping-basket"></i><span>Mikrobiologi Bahan Baku</span></a>
                        </li>
                    </ul>
                    <hr>
                </aside>
            </div>

            <!-- Main Content -->

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Data Sampel Analisa Mikrobiologi Bahan Baku</h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Data Sampel Analisa Mikrobiologi Bahan Baku</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">

                                    @if(Session::get('successAdd'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successAdd')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successDelete'))
                                        <div class="alert alert-danger w-70">
                                            {{Session::get('successDelete')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successUpdate'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successUpdate')}}
                                        </div>
                                    @endif

                                    @if(Session::get('operatorttd'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('operatorttd')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successAddSampel'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successAddSampel')}}
                                        </div>
                                    @endif



                                    <div class="button" style="margin-left:4%; margin-top:3%;">
                                        <a href="/operator/mikrobiologi_bahan_baku" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>
                                    </div>

                                    <div class="card-body mt-3 shadow">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Bahan Baku</th>
                                                    <th scope="col">TPC ({{ $mikrobiologi_bahan_baku->satuan_tpc }})</th>
                                                    <th scope="col">Yeast & Mold ({{ $mikrobiologi_bahan_baku->satuan_yeast_mold }})</th>
                                                    <th scope="col">Coliform ({{ $mikrobiologi_bahan_baku->satuan_coliform }})</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                <tr>
                                                    @forelse ($sampel_mikrobiologi_bahan_baku as $bahan_baku)
                                                        <tr id="{{ $bahan_baku->id }}">

                                                            <th scope="row">{{ ++$no }}</th>
                                                            <td>{{ $bahan_baku->nama_bahan_baku }}</td>
                                                            <td>{{ $bahan_baku->tpc }}</td>
                                                            <td>{{ $bahan_baku->yeast_mold }}</td>
                                                            <td>{{ $bahan_baku->coliform }}</td>
                                                            <td>{{ $bahan_baku->keterangan }}</td>
                                                            <td>
                                                                <form action="{{route('sampel_mikrobiologi_bahan_baku_Delete', $bahan_baku['id'])}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        @empty
                                                        <tr>
                                                            <td class="text-center h5" colspan="9">Not Found</td>
                                                        </tr>
                                                    @endforelse
                                                </tr>
                                              </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>





@endsection
