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
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
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
                    <a href="/operator/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa kimia</span></a>
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
                <h1>Tambah Data Dokumen</h1>
            </div>


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



            <div class="section-body">
                <h2 class="section-title">Tambah Data Dokumen</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>Data Operator</h4>
                            </div> --}}

                            <div class="card">
                                <form action="{{route('data_analisa_kimia.post')}}" method="POST">
                                  @csrf
                                    <div class="card-body">
                                        <div class="form-row">
                                            {{-- <div class="form-group col-md-6">
                                                <label for="inputEmail4">No.Dokumen</label>
                                                <input type="text" name="nodokumen" class="form-control" id="inputEmail4" placeholder="Masukkan No.Dokumen (4/LAK/V1/21)">
                                            </div> --}}
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Pemberi sampel</label>
                                                <input type="string" name="pemberi_sampel" class="form-control" id="inputEmail4" placeholder="Masukkan nama pemberi sampel">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Jumlah sampel</label>
                                                <input type="number" name="jumlah_sampel" class="form-control" id="inputEmail4" placeholder="Masukkan jumlah sampel">
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Parameter Pengujian C1</label>
                                                <input type="string" name="parameter_pengujian" class="form-control" id="inputEmail4" placeholder="Parameter pengujian C1 (optional)">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Parameter Pengujian C2</label>
                                                <input type="string" name="parameter_pengujian_c2" class="form-control" id="inputEmail4" placeholder="Parameter pengujian C2 (optional)">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Parameter Pengujian C3</label>
                                                <input type="string" name="parameter_pengujian_c3" class="form-control" id="inputEmail4" placeholder="Parameter pengujian C3 (optional)">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputEmail4">Parameter Pengujian C4</label>
                                                <input type="string" name="parameter_pengujian_c4" class="form-control" id="inputEmail4" placeholder="Parameter pengujian C4 (optional)">
                                            </div>
                                            
                                           
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal terima sampel</label>
                                                <input type="date" name="tanggal_terima" class="form-control" id="inputEmail4" placeholder="Masukkan tanggal terima sampel">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal uji</label>
                                                <input type="date" name="tanggal_uji" class="form-control" id="inputEmail4" placeholder="Masukkan tanggal uji">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal selesai uji</label>
                                                <input type="date" name="tanggal_selesai" class="form-control" id="inputEmail4" placeholder="Masukkan tanggal selesai uji">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                      <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Simpan Data</button>
                                      <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:1%; margin-top:-5%;">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="footer-left">
            Futami Operator
            {{-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
        </div>
        <div class="footer-right">

        </div>
    </footer>
</div>
</div>



@endsection
