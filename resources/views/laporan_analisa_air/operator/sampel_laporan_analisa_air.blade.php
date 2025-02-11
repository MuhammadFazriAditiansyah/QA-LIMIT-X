@extends('layout-operator')
@section('content')
@include('sweetalert::alert')



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
                    <a href="/operator/laporan_analisa_air" class="nav-link"><i class="fas fa-water"></i><span>Laporan Analisa Air</span></a>
                </li>

              </ul>
            <hr>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Pemeriksaan Kimia Dan Sensori</h1>
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

            @if(Session::get('successAdd'))
                <div class="alert alert-success w-70">
                    {{Session::get('successAdd')}}
                </div>
            @endif

            @if(Session::get('successAddSampel'))
                <div class="alert alert-success w-70">
                    {{Session::get('successAddSampel')}}
                </div>
            @endif



            <div class="section-body">
                <h2 class="section-title">Tambah Data Pemeriksaan Kimia Dan Sensori</h2>
                <div class="row shadow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card">






                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Pilih Sampel Yang Akan di Isi</h4>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($sampel_null as $sampel)
                                                <a href="/operator/sampel_laporan_analisa_air/{{ $laporan_analisa_air->id }}/{{$sampel->id}}" class="btn btn-primary m-1">{{ $sampel->sampel }}</a>
                                            @endforeach
                                        </div>
                                        <div class="card-body">
                                            @foreach ($data_laporan_analisa_air as $data)
                                                <a href="/operator/sampel_laporan_analisa_air/{{ $laporan_analisa_air->id }}/{{$data->id}}" class="btn btn-primary m-1">{{ $data->sampel }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                <div class="button" align="center">
                                    <a id="alertTambahDokumen" href="/operator/laporan_analisa_air" class="btn btn-success" style="width:90%;">Simpan Data Sampel</a>
                                    {{-- <a href="/operator/laporan_analisa_air" class="btn btn-success" style="width:90%;">Simpan Perubahan</a> --}}
                                </div>




                                {{-- <form action="{{route('sampel_laporan_analisa_air', $id)}}" method="POST">
                                  @csrf

                                    <div class="form-row" style="margin-top:1%; padding:10px;" id="sampel">
                                        <div class="form-group col-md-4" align="center">
                                            <label for="pengujian">Pengujian</label>
                                            <input type="text" name="pengujian" class="form-control" id="pengujian" placeholder="Masukkan Pengujian">
                                        </div>
                                        <div class="form-group col-md-2" align="center">
                                            <label for="shift_1">Shift 1</label>
                                            <input type="text" name="shift_1" class="form-control" id="shift_1" placeholder="Masukkan shift 1">
                                        </div>
                                        <div class="form-group col-md-2" align="center">
                                            <label for="shift_2">Shift 2</label>
                                            <input type="text" name="shift_2" class="form-control" id="shift_2" placeholder="Masukkan shift 2">
                                        </div>
                                        <div class="form-group col-md-4" align="center">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan keterangan">
                                        </div>





                                        <div class="form-group col-md-1" style="margin-top: 30px;">
                                            <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan sampel</button>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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






{{-- Script multiple input data sampel  --}}
{{-- <script>
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
                        <input type="time" name="inputSampel[${i}][exp_date]" class="form-control" id="exp_date" placeholder="Masukkan Exp Date">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="penampakan">Penampakan</label>
                        <input type="text" name="inputSampel[${i}][penampakan]" class="form-control" id="penampakan" placeholder="Masukkan Penampakan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="endapan">Endapan</label>
                        <input type="text" name="inputSampel[${i}][endapan]" class="form-control" id="endapan" placeholder="Masukkan Endapan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="warna">Warna</label>
                        <input type="text" name="inputSampel[${i}][warna]" class="form-control" id="warna" placeholder="Masukkan Warna">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="rasa">Rasa</label>
                        <input type="text" name="inputSampel[${i}][rasa]" class="form-control" id="rasa" placeholder="Masukkan Rasa">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="aroma">Aroma</label>
                        <input type="text" name="inputSampel[${i}][aroma]" class="form-control" id="aroma" placeholder="Masukkan Aroma">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="brix">Brix</label>
                        <input type="text" name="inputSampel[${i}][brix]" class="form-control" id="brix" placeholder="Masukkan Brix">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="acidity">Acidity</label>
                        <input type="text" name="inputSampel[${i}][acidity]" class="form-control" id="acidity" placeholder="Masukkan Acidity">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="ph">Ph</label>
                        <input type="text" name="inputSampel[${i}][ph]" class="form-control" id="ph" placeholder="Masukkan Ph">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="density">Density</label>
                        <input type="text" name="inputSampel[${i}][density]" class="form-control" id="density" placeholder="Masukkan Density">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="volume">Volume</label>
                        <input type="text" name="inputSampel[${i}][volume]" class="form-control" id="volume" placeholder="Masukkan Volume">
                    </div>

                    <div class="form-group col-md-1" align="center" style="margin-top:30px;">
                        <button type="button" name="remove" id="remove" class="btn btn-danger" style=""><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </div>
























              <div class="form-group col-md-2">
                        <label for="penampakan">Penampakan</label>
                        <input type="text" name="inputSampel[${i}][penampakan]" class="form-control" id="penampakan" placeholder="Masukkan Penampakan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="endapan">Endapan</label>
                        <input type="text" name="inputSampel[${i}][endapan]" class="form-control" id="endapan" placeholder="Masukkan Endapan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="warna">Warna</label>
                        <input type="text" name="inputSampel[${i}][warna]" class="form-control" id="warna" placeholder="Masukkan Warna">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="rasa">Rasa</label>
                        <input type="text" name="inputSampel[${i}][rasa]" class="form-control" id="rasa" placeholder="Masukkan Rasa">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="aroma">Aroma</label>
                        <input type="text" name="inputSampel[${i}][aroma]" class="form-control" id="aroma" placeholder="Masukkan Aroma">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="brix"><sup>0</sup>Brix</label>

                        <select class="form-control" name="inputSampel[${i}][brix]">
                            <option hidden>-- Brix --</option>

                            @foreach ($parameter as $param)
                                <option value="{{ $param['brix'] }}">{{ $param['brix'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="acidity">Acidity ({{ $mikrobiologi_kimia_sensori->satuan_acidity }})</label>
                        <select class="form-control" name="inputSampel[${i}][acidity]">
                            <option hidden>-- Acidity --</option>

                            @foreach ($parameter as $param)
                                <option value="{{ $param['acidity'] }}">{{ $param['acidity'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="ph">pH</label>
                        <select class="form-control" name="inputSampel[${i}][ph]">
                            <option hidden>-- pH --</option>

                            @foreach ($parameter as $param)
                                <option value="{{ $param['ph'] }}">{{ $param['ph'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="density">Density</label>
                        <select class="form-control" name="inputSampel[${i}][density]">
                            <option hidden>-- Density --</option>

                            @foreach ($parameter as $param)
                                <option value="{{ $param['density'] }}">{{ $param['density'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <label for="volume">volume ({{ $mikrobiologi_kimia_sensori->satuan_volume }})</label>
                        <select class="form-control" name="inputSampel[${i}][volume]">
                            <option hidden>-- Volume --</option>

                            @foreach ($parameter as $param)
                                <option value="{{ $param['volume'] }}">{{ $param['volume'] }}</option>
                            @endforeach

                        </select>
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
</script> --}}



@endsection
