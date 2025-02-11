@extends('layout-operator')
@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
          {{-- <form action="{{route('delete', $futami['id'])}}" method="POST"> --}}

              <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_history') }}">
                  <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                  </ul>
                  <div class="search-element">
                      <input class="form-control" type="date" name="tgl_inokulasi" id="tgl_inokulasi" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                      <input class="form-control" type="date" name="tgl_pengamatan" id="tgl_pengamatan" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                  </div>          
              </form>
              <a class="text-success btn" href="/operator/mikrobiologi/history" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown"class="nav-link dropdown-toggle nav-link-lg nav-link-user">
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
                        <a href="/operator/data" class="nav-link"><i class="fas fa-flask"></i><span>Analisa Kimia</span></a>
                    </li>
                    {{-- <li class="dropdown active">
                      <a href="/operator/analisakimia/history" class="nav-link"><i class="fas fa-history"></i><span>History Delete</span></a>
                    </li> --}}

                    {{-- <li class="dropdown" style="margin-top: 130%;">
                        <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                    </li> --}}





                    {{-- <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i><span>Credits</span></a></li> --}}
                </ul>
                <hr>
            </aside>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>History Analisa Kimia</h1>
                </div>

                <div class="section-body">
                    <h2 class="section-title">History Analisa Kimia</h2>

                    {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

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



                                {{-- <form action="{{route('operatorpdf')}}" method="POST" target="_blank">
                                @csrf
                                
                                <div class="button_download" style="margin-left:84%; margin-top:-4%;">
                                    <div class="col-md-7 col-lg-5">
                                    <a href="/operator/data/pdf" target="_blank">
                                        <button type="button" class="btn btn-outline-primary">
                                        <i class="fa-solid fa-file-pdf fa-2x ml-5"></i>
                                        </button>
                                    </a>
                                    </div>

                                </div>
                                </form> --}}
                            <div class="button" style="margin-left:4%; margin-top:3%;">
                                <a href="/operator/data" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                            </div>

                            <div class="card-body mt-3 shadow">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>No</th>
                                            <th>No.Dokumen</th>
                                            <th>Pemberi sampel</th>
                                            <th>Tanggal terima sampel</th>
                                            <th>Tanggal Uji</th>
                                            <th>Tanggal selesai uji</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        @forelse ($futamis as $futami)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$futami->nodokumen}}</td>
                                                <td>{{$futami->pemberi_sampel}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d F Y')}}</td>
                                                {{-- <td>
                                                    <a href="{{ route('sampel', $futami->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>
                                                </td> --}}
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center h5" colspan="8">Not Found</td>
                                                </tr>
                                        @endforelse
                                        
                                        </table>
                                        {{ $futamis->links('pagination::bootstrap-4') }}
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
