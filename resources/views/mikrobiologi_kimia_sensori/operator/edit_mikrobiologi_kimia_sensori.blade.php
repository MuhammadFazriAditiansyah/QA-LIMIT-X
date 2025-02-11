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
                    <a href="/operator/mikrobiologi_kimia_sensori" class="nav-link"><i class="fa-solid fa-atom"></i><span>Pemeriksaan Kimia Dan Sensori</span></a>
                </li>

              </ul>
            <hr>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data Dokumen Pemeriksaan Kimia Dan Sensori</h1>
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


            @if(Session::get('successDelete'))
                <div class="alert alert-danger w-70">
                    {{Session::get('successDelete')}}
                </div>
            @endif



            <form action="{{route('update_mikrobiologi_kimia_sensori.post', $mikrobiologi_kimia_sensori['id'])}}" method="POST">
                @csrf
                @method('PATCH')

                <div class="section-body">
                    <h2 class="section-title">Edit Data Dokumen</h2>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card">
                                    {{-- <form action="{{route('update_data_analisa_kimia', $futamis['id'])}}" method="POST">
                                        @csrf
                                        @method('PATCH') --}}

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="nodokumen">No.Dokumen</label>
                                                    {{-- <input type="text" name="nodokumen" value="{{$mikrobiologi_kimia_sensori['nodokumen']}}" class="form-control" id="inputEmail4" placeholder="Masukkan No.Dokumen (4/LAK/V1/21)" disabled> --}}
                                                    <input type="text" name="nodokumen" value="{{$mikrobiologi_kimia_sensori['nodokumen']}}" class="form-control" id="inputEmail4" placeholder="Masukkan No.Dokumen (4/LAK/V1/21)">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="tgl_produksi">Tanggal Produksi</label>
                                                    <input type="date" name="tgl_produksi" value="{{$mikrobiologi_kimia_sensori['tgl_produksi']}}" class="form-control" id="tgl_produksi" placeholder="Masukkan Tanggal Produksi">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="nama_produk">Nama Produk</label>
                                                    <input type="string" name="nama_produk" value="{{$mikrobiologi_kimia_sensori['nama_produk']}}" class="form-control" id="nama_produk" placeholder="Masukkan Nama Produk">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="jumlah_batch">Jumlah Batch</label>
                                                    <input type="string" name="jumlah_batch" value="{{$mikrobiologi_kimia_sensori['jumlah_batch']}}" class="form-control" id="jumlah_batch" placeholder="Masukkan Jumlah Batch">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input type="string" name="keterangan" value="{{ $mikrobiologi_kimia_sensori->keterangan }}" class="form-control" id="keterangan" placeholder="Masukkan Keterangan">
                                                </div>
                                            </div>
                                        
                                            <div class="borderParameter" style="padding:0 20px 0 20px;">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="parameter">Parameter C1</label>
                                                        <select class="form-control select2" name="parameter_c1" placeholder="-- C1 --">
                                                            {{-- <option disabled selected hidden>-- C1 --</option> --}}
                                                            <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c1 }}">{{ $mikrobiologi_kimia_sensori->parameter_c1 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C2</label>
                                                        <select class="form-control select2" name="parameter_c2" placeholder="-- C2 --">
                                                            {{-- <option disabled selected hidden>-- C2 --</option> --}}
                                                            <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c2 }}">{{ $mikrobiologi_kimia_sensori->parameter_c2 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C3</label>
                                                        <select class="form-control select2" name="parameter_c3" placeholder="-- C3 --">
                                                            {{-- <option disabled selected hidden>-- C3 --</option> --}}
                                                            <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c3 }}">{{ $mikrobiologi_kimia_sensori->parameter_c3 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C4</label>
                                                        <select class="form-control select2" name="parameter_c4" placeholder="-- C4 --">
                                                            {{-- <option disabled selected hidden>-- C4 --</option> --}}
                                                            <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c4 }}">{{ $mikrobiologi_kimia_sensori->parameter_c4 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C5</label>
                                                        <select class="form-control select2" name="parameter_c5" placeholder="-- C5 --">
                                                            {{-- <option disabled selected hidden>-- C5 --</option> --}}
                                                            <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c5 }}">{{ $mikrobiologi_kimia_sensori->parameter_c5 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="borderSatuan" style="padding:0 20px 0 20px;">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="satuan">Satuan C1</label>
                                                        <select class="form-control select2" name="satuan_c1" placeholder="-- C1 --">
                                                            {{-- <option disabled selected hidden>-- C1 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c1 }}">{{ $mikrobiologi_kimia_sensori->satuan_c1 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">{{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C2</label>
                                                        <select class="form-control select2" name="satuan_c2" placeholder="-- C2 --">
                                                            {{-- <option disabled selected hidden>-- C2 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c2 }}">{{ $mikrobiologi_kimia_sensori->satuan_c2 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">{{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C3</label>
                                                        <select class="form-control select2" name="satuan_c3" placeholder="-- C3 --">
                                                            {{-- <option disabled selected hidden>-- C3 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c3 }}">{{ $mikrobiologi_kimia_sensori->satuan_c3 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C4</label>
                                                        <select class="form-control select2" name="satuan_c4" placeholder="-- C4 --">
                                                            {{-- <option disabled selected hidden>-- C4 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c4 }}">{{ $mikrobiologi_kimia_sensori->satuan_c4 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C5</label>
                                                        <select class="form-control select2" name="satuan_c5" placeholder="-- C5 --">
                                                            {{-- <option disabled selected hidden>-- C5 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c5 }}">{{ $mikrobiologi_kimia_sensori->satuan_c5 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="borderParameter" style="padding:0 20px 0 20px;">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="parameter">Parameter C6</label>
                                                        <select class="form-control select2" name="parameter_c6" placeholder="-- C6 --">
                                                            {{-- <option disabled selected hidden>-- C6 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c6 }}">{{ $mikrobiologi_kimia_sensori->parameter_c6 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C7</label>
                                                        <select class="form-control select2" name="parameter_c7" placeholder="-- C7 --">
                                                            {{-- <option disabled selected hidden>-- C7 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c7 }}">{{ $mikrobiologi_kimia_sensori->parameter_c7 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C8</label>
                                                        <select class="form-control select2" name="parameter_c8" placeholder="-- C8 --">
                                                            {{-- <option disabled selected hidden>-- C8 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c8 }}">{{ $mikrobiologi_kimia_sensori->parameter_c8 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C9</label>
                                                        <select class="form-control select2" name="parameter_c9" placeholder="-- C9 --">
                                                            {{-- <option disabled selected hidden>-- C9 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c9 }}">{{ $mikrobiologi_kimia_sensori->parameter_c9 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="parameter">Parameter C10</label>
                                                        <select class="form-control select2" name="parameter_c10" placeholder="-- C10 --">
                                                            {{-- <option disabled selected hidden>-- C10 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->parameter_c10 }}">{{ $mikrobiologi_kimia_sensori->parameter_c10 }}</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="borderSatuan" style="padding:0 20px 0 20px;">
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="satuan">Satuan C6</label>
                                                        <select class="form-control select2" name="satuan_c6" placeholder="-- C6 --">
                                                            {{-- <option disabled selected hidden>-- C6 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c6 }}">{{ $mikrobiologi_kimia_sensori->satuan_c6 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">{{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C7</label>
                                                        <select class="form-control select2" name="satuan_c7" placeholder="-- C7 --">
                                                            {{-- <option disabled selected hidden>-- C7 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c7 }}">{{ $mikrobiologi_kimia_sensori->satuan_c7 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">{{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C8</label>
                                                        <select class="form-control select2" name="satuan_c8" placeholder="-- C8 --">
                                                            {{-- <option disabled selected hidden>-- C8 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c8 }}">{{ $mikrobiologi_kimia_sensori->satuan_c8 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C9</label>
                                                        <select class="form-control select2" name="satuan_c9" placeholder="-- C9 --">
                                                            {{-- <option disabled selected hidden>-- C9 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c9 }}">{{ $mikrobiologi_kimia_sensori->satuan_c9 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="satuan">Satuan C10</label>
                                                        <select class="form-control select2" name="satuan_c10" placeholder="-- C10 --">
                                                            {{-- <option disabled selected hidden>-- C10 --</option> --}}
                                                                <option selected value="{{ $mikrobiologi_kimia_sensori->satuan_c10 }}">{{ $mikrobiologi_kimia_sensori->satuan_c10 }}</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">{{ $satuan->satuan }}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Edit Data Pemeriksaan Kimia Dan Sensori</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card">
                                    <span class="d-none" style="display: none; ">{{ $i=0 }}</span>

                                    {{-- @foreach ($sampel_mikrobiologis as $sampel_mikrobiologi) --}}
                                        {{-- <span class="d-none">{{ $i++ }} </span> --}}

                                        <div class="card-body">
                                            {{-- <div class="form-row" style="margin-top:-3%;">
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="nama_objek">Nama Objek</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="jam_sampling">Jam Sampling</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="tpc">TPC(cfu/cm<sup>2</sup>)</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="yeast_mold">Yeast & Mold(cfu/cm<sup>2</sup>)</label>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="coliform">Coliform</label>
                                                </div>
                                                 <div class="form-group col-md-2" align="center">
                                                    <label for="keterangan">Keterangan</label>
                                                </div>
                                            </div> --}}

                                            @foreach ($sampel_mikrobiologi_kimia_sensori as $kimia_sensori)
                                            <span class="d-none">{{ $i++ }} </span>

                                                {{-- <div class="form-row" style="margin-top:-2%;">
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][nama_objek]" value="{{$kimia_sensori['kode_sampling']}}" class="form-control" id="area" placeholder="Masukkan nama Objek">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input type="time" name="inputSampel[{{ $i }}][jam_sampling]" value="{{$kimia_sensori['jam_sampling']}}" class="form-control" id="jam_sampling" placeholder="Masukkan Jam Sampling">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][tpc]" value="{{$kimia_sensori['tpc']}}" class="form-control" id="tpc" placeholder="Masukkan nama TPC">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][yeast_mold]" value="{{$kimia_sensori['yeast_mold']}}" class="form-control" id="yeast_mold" placeholder="Masukkan Yeast & Mold">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][coliform]" value="{{$kimia_sensori['coliform']}}" class="form-control" id="coliform" placeholder="Masukkan Coliform">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <input type="text" name="inputSampel[{{ $i }}][keterangan]" value="{{$kimia_sensori['keterangan']}}" class="form-control" id="keterangan" placeholder="Masukkan Keterangan">
                                                    </div>
                                                </div> --}}


                                                <div class="form-row" style="padding:10px;" id="Datasampel">
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="kode_sampling">Kode Sampling</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][kode_sampling]" value="{{$kimia_sensori['kode_sampling']}}" class="form-control" id="kode_sampling" placeholder="Masukkan Kode Sampling">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="waktu">Waktu</label>
                                                        <input type="time" name="inputSampel[{{ $i }}][waktu]" value="{{$kimia_sensori['waktu']}}" class="form-control" id="waktu" placeholder="Masukkan Waktu">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="exp_date">Exp Date</label>
                                                        <input type="date" name="inputSampel[{{ $i }}][exp_date]" value="{{$kimia_sensori['exp_date']}}" class="form-control" id="exp_date" placeholder="Masukkan Exp Date ">
                                                    </div>


                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c1">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c1 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c1 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c1 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c1]" value="{{$kimia_sensori['parameter_c1']}}" class="form-control" id="parameter_c1" placeholder="Parameter C1">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c2">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c2 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c2 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c2 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c2]" value="{{$kimia_sensori['parameter_c2']}}" class="form-control" id="parameter_c2" placeholder="Parameter C2">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c3">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c3 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c3 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c3 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c3]" value="{{$kimia_sensori['parameter_c3']}}" class="form-control" id="parameter_c3" placeholder="Parameter C3">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c4">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c4 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c4 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c4 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c4]" value="{{$kimia_sensori['parameter_c4']}}" class="form-control" id="parameter_c4" placeholder="Parameter C4">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c5">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c5 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c5 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c5 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c5]" value="{{$kimia_sensori['parameter_c5']}}" class="form-control" id="parameter_c5" placeholder="Parameter C5">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c6">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c6 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c6 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c6 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c6]" value="{{$kimia_sensori['parameter_c6']}}" class="form-control" id="parameter_c6" placeholder="Parameter C6">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c7">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c7 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c7 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c7 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c7]" value="{{$kimia_sensori['parameter_c7']}}" class="form-control" id="parameter_c7" placeholder="Parameter C7">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c8">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c8 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c8 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c8 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c8]" value="{{$kimia_sensori['parameter_c8']}}" class="form-control" id="parameter_c8" placeholder="Parameter C8">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c9">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c9 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c9 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c9 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c9]" value="{{$kimia_sensori['parameter_c9']}}" class="form-control" id="parameter_c9" placeholder="Parameter C9">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="parameter_c10">
                                                            {{ $mikrobiologi_kimia_sensori->parameter_c10 }}
                                                            @if ($mikrobiologi_kimia_sensori->satuan_c10 != null)
                                                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c10 }})</sup>
                                                            @endif
                                                        </label>
                                                        <input type="text" name="inputSampel[{{ $i }}][parameter_c10]" value="{{$kimia_sensori['parameter_c10']}}" class="form-control" id="parameter_c10" placeholder="Parameter C10">
                                                    </div>


                                                    {{-- <div class="form-group col-md-2" align="center">
                                                        <label for="brix"><sup>0</sup>Brix</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][brix]" value="{{$kimia_sensori['brix']}}" class="form-control" id="brix" placeholder="Masukkan Brix">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="acidity">Acidity({{ $mikrobiologi_kimia_sensori->satuan_acidity }})</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][acidity]" value="{{$kimia_sensori['acidity']}}" class="form-control" id="acidity" placeholder="Masukkan Acidity">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="ph">Ph</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][ph]" value="{{$kimia_sensori['ph']}}" class="form-control" id="ph" placeholder="Masukkan Ph">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="density">Density</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][density]" value="{{$kimia_sensori['density']}}" class="form-control" id="density" placeholder="Masukkan Density">
                                                    </div>
                                                    <div class="form-group col-md-2" align="center">
                                                        <label for="volume">Volume({{ $mikrobiologi_kimia_sensori->satuan_volume }})</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][volume]" value="{{$kimia_sensori['volume']}}" class="form-control" id="volume" placeholder="Masukkan Volume">
                                                    </div> --}}

                                                    {{-- <div class="form-group col-md-2" align="center">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input type="text" name="inputSampel[{{ $i }}][keterangan]" value="{{$kimia_sensori['keterangan']}}" class="form-control" id="keterangan" placeholder="keterangan (Optional)">
                                                    </div> --}}

                                                    {{-- <div class="form-group col-md-1" style="margin-top: 30px;">
                                                        <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                                    </div> --}}
                                                </div>
                                            @endforeach



                                        </div>
                                    {{-- @endforeach --}}
                                        {{-- <div class="card-footer">
                                            <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Simpan Data</button>
                                            <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:1%; margin-top:-5%;">Back</a>
                                        </div> --}}
                                    {{-- </form> --}}
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success" style="width:35%; text-align:center; margin-left:64%; margin-top:20px;">Simpan Data</button>
                                    <a href="/operator/mikrobiologi_kimia_sensori" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-60px;">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>




        <div class="main-content" style="margin-top:-6%;">
            <section class="section">
                <form action="{{route('sampel_mikrobiologi_kimia_sensori.post', $mikrobiologi_kimia_sensori['id'])}}" method="POST">
                    @csrf

                    <div class="section-body">
                        <h2 class="section-title">Tambah Data Pemeriksaan Kimia Dan Mesin</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card d-flex justify-content-right" style="">
                                        <div class="card-body">
                                            {{-- <form action="{{route('sampel_analisa_kimia.post', $futamis['id'])}}" method="POST">
                                                @csrf --}}

                                                <div class="card-body" id="sampel">
                                                    <div class="form-row" style="margin-top:1%;" id="sampel">
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="kode_sampling">Kode Sampling</label>
                                                            <input type="text" name="inputSampel[0][kode_sampling]" class="form-control" id="kode_sampling" placeholder="Masukkan Kode Sampling">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="waktu">Waktu</label>
                                                            <input type="time" name="inputSampel[0][waktu]" class="form-control" id="waktu" placeholder="Masukkan Waktu">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="exp_date">Exp Date</label>
                                                            <input type="date" name="inputSampel[0][exp_date]" class="form-control" id="exp_date" placeholder="Masukkan Exp Date">
                                                        </div>

                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c1">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c1 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c1 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c1 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c1]" class="form-control" id="parameter_c1" placeholder="Parameter C1">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c2">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c2 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c2 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c2 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c2]" class="form-control" id="parameter_c2" placeholder="Parameter C2">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c3">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c3 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c3 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c3 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c3]" class="form-control" id="parameter_c3" placeholder="Parameter C3">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c4">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c4 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c4 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c4 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c4]" class="form-control" id="parameter_c4" placeholder="Parameter C4">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c5">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c5 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c5 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c5 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c5]" class="form-control" id="parameter_c5" placeholder="Parameter C5">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c6">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c6 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c6 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c6 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c6]" class="form-control" id="parameter_c6" placeholder="Parameter C6">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c7">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c7 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c7 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c7 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c7]" class="form-control" id="parameter_c7" placeholder="Parameter C7">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c8">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c8 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c8 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c8 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c8]" class="form-control" id="parameter_c8" placeholder="Parameter C8">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c9">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c9 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c9 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c9 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c9]" class="form-control" id="parameter_c9" placeholder="Parameter C9">
                                                        </div>
                                                        <div class="form-group col-md-2" align="center">
                                                            <label for="parameter_c10">
                                                                {{ $mikrobiologi_kimia_sensori->parameter_c10 }}
                                                                @if ($mikrobiologi_kimia_sensori->satuan_c10 != null)
                                                                    <sup>({{ $mikrobiologi_kimia_sensori->satuan_c10 }})</sup>
                                                                @endif
                                                            </label>
                                                            <input type="text" name="inputSampel[0][parameter_c10]" class="form-control" id="parameter_c10" placeholder="Parameter C10">
                                                        </div>




                                                        {{-- <div class="form-group col-md-2" align="center">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" name="inputSampel[0][keterangan]" class="form-control" id="keterangan" placeholder="keterangan (Optional)">
                                                        </div> --}}

                                                        <div class="form-group col-md-1" style="margin-top: 30px;">
                                                            <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                              {{-- </form> --}}
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success" style="width:80%; text-align:center; margin-left:7%; margin-top:-2%;">Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
            </section>
        </div>

    </form>
    {{-- </form> --}}
</div>
</div>





{{-- Script multiple inputs yg baru --}}
<script>
    var i = 0;
    var maxInput = 15;
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`

            <div class="card-body removeSampel" id="removeSampel" style="margin-top: -5%; margin-left:-25px;">

                <div class="form-row" style="margin-top:1%; padding:10px;">
                    <div class="form-group col-md-2">
                        <label for="kode_sampling">Kode Sampling</label>
                        <input type="text" name="inputSampel[${i}][kode_sampling]" class="form-control" id="kode_sampling" placeholder="Masukkan Kode Sampling">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="waktu">Waktu</label>
                        <input type="time" name="inputSampel[${i}][waktu]" class="form-control" id="waktu" placeholder="Masukkan Waktu">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="exp_date">Exp Date</label>
                        <input type="date" name="inputSampel[${i}][exp_date]" class="form-control" id="exp_date" placeholder="Masukkan Exp Date">
                    </div>

                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c1">
                            {{ $mikrobiologi_kimia_sensori->parameter_c1 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c1 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c1 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c1]" class="form-control" id="parameter_c1" placeholder="Parameter C1">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c2">
                            {{ $mikrobiologi_kimia_sensori->parameter_c2 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c2 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c2 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c2]" class="form-control" id="parameter_c2" placeholder="Parameter C2">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c3">
                            {{ $mikrobiologi_kimia_sensori->parameter_c3 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c3 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c3 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c3]" class="form-control" id="parameter_c3" placeholder="Parameter C3">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c4">
                            {{ $mikrobiologi_kimia_sensori->parameter_c4 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c4 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c4 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c4]" class="form-control" id="parameter_c4" placeholder="Parameter C4">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c5">
                            {{ $mikrobiologi_kimia_sensori->parameter_c5 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c5 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c5 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c5]" class="form-control" id="parameter_c5" placeholder="Parameter C5">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c6">
                            {{ $mikrobiologi_kimia_sensori->parameter_c6 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c6 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c6 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c6]" class="form-control" id="parameter_c6" placeholder="Parameter C6">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c7">
                            {{ $mikrobiologi_kimia_sensori->parameter_c7 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c7 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c7 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c7]" class="form-control" id="parameter_c7" placeholder="Parameter C7">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c8">
                            {{ $mikrobiologi_kimia_sensori->parameter_c8 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c8 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c8 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c8]" class="form-control" id="parameter_c8" placeholder="Parameter C8">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c9">
                            {{ $mikrobiologi_kimia_sensori->parameter_c9 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c9 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c9 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c9]" class="form-control" id="parameter_c9" placeholder="Parameter C9">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="parameter_c10">
                            {{ $mikrobiologi_kimia_sensori->parameter_c10 }}
                            @if ($mikrobiologi_kimia_sensori->satuan_c10 != null)
                                <sup>({{ $mikrobiologi_kimia_sensori->satuan_c10 }})</sup>
                            @endif
                        </label>
                        <input type="text" name="inputSampel[${i}][parameter_c10]" class="form-control" id="parameter_c10" placeholder="Parameter C10">
                    </div>







                    <div class="form-group col-md-1" align="center" style="margin-top:30px;">
                        <button type="button" name="remove" id="remove" class="btn btn-danger" style=""><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </div>

        `);

        }else{
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
            icon: 'warning',
            title: 'Input area telah mencapai batas maksimal!'
            })
        }


    });

    $(document).on('click','#remove', function(){ //#remove name nya, dalam jquery hapus sampel kita menggunakan name nya
        // $(this).parent('div').remove();
        $(this).closest('.removeSampel').remove();
        i--;
    })
</script>






@endsection
