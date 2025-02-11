@extends('layout-operator')
@section('content')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                        </li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/template/stisla/assets/img/avatar/avatar-3.png') }}"
                                class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
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
                        <img alt="image" src="{{ asset('assets/img/futami bg.png') }}"
                            class="rounded-medium justify-content-center"
                            style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm ">
                        {{-- <a href="index.html">FO</a> --}}
                        <img alt="image" src="{{ asset('assets/img/logo-futami-sidebar.png') }}"
                            class="rounded-circle justify-content-center"
                            style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
                    </div>
                    <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
                        {{-- <li class="menu-header">Dashboard</li> --}}
                        <li class="dropdown">
                            <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown active">
                            <a href="/operator/laporan_analisa_air" class="nav-link"><i class="fas fa-solid fa-water"></i><span>Laporan Analisa Air</span></a>
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
                        <h1>Tambah Laporan Analisa Air</h1>
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
                        <h2 class="section-title">Tambah Dokumen Laporan Analisa Air</h2>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card">
                                        <form action="{{ route('laporan_analisa_air.post') }}" method="POST">
                                            @csrf

                                            <div class="card-body" id="sampel">
                                                <div class="form-row sampel-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="nodokumen">No Dokumen</label>
                                                        <input type="string" name="nodokumen" class="form-control" id="nodokumen" placeholder="Masukkan No.Dokumen">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="tgl_sampling">Tanggal Sampling</label>
                                                        <input type="date" name="tgl_sampling" class="form-control" id="tgl_sampling" placeholder="Masukkan Tanggal Sampling">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label for="sampel">Nama Sampel</label>
                                                        <input type="string" name="inputSampel[0][sampel]" class="form-control" id="sampel" placeholder="Masukkan Nama Produk">
                                                    </div>
                                                    <div class="form-group col-md-1" style="margin-top: 30px;">
                                                        <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                                    </div>




                                                    {{-- <div class="borderParameter row"
                                                        style="background-color:#4CEA67; z-index:10; border-radius:10px; margin:0 10px 10px 10px;">
                                                        <div class="form-group col-md-3">
                                                            <label for="parameter">Parameter C1</label>
                                                            <select class="form-control select2" name="parameter_c1"
                                                                placeholder="-- C1 --">
                                                                <option disabled selected hidden>-- C1 --</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C2</label>
                                                            <select class="form-control select2" name="parameter_c2"
                                                                placeholder="-- C2 --">
                                                                <option disabled selected hidden>-- C2 --</option>

                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C3</label>
                                                            <select class="form-control select2" name="parameter_c3"
                                                                placeholder="-- C3 --">
                                                                <option disabled selected hidden>-- C3 --</option>

                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C4</label>
                                                            <select class="form-control select2" name="parameter_c4"
                                                                placeholder="-- C4 --">
                                                                <option disabled selected hidden>-- C4 --</option>

                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C5</label>
                                                            <select class="form-control select2" name="parameter_c5"
                                                                placeholder="-- C5 --">
                                                                <option disabled selected hidden>-- C5 --</option>

                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="borderSatuan row"
                                                        style="background-color:#fb160a; z-index:10; border-radius:10px; margin:0 10px 10px 10px;">
                                                        <div class="form-group col-md-3">
                                                            <label for="satuan">Satuan C1</label>
                                                            <select class="form-control select2" name="satuan_c1"
                                                                placeholder="-- C1 --">
                                                                <option disabled selected hidden>-- C1 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">
                                                                        {{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C2</label>
                                                            <select class="form-control select2" name="satuan_c2"
                                                                placeholder="-- C2 --">
                                                                <option disabled selected hidden>-- C2 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">
                                                                        {{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C3</label>
                                                            <select class="form-control select2" name="satuan_c3"
                                                                placeholder="-- C3 --">
                                                                <option disabled selected hidden>-- C3 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">
                                                                        {{ $satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C4</label>
                                                            <select class="form-control select2" name="satuan_c4"
                                                                placeholder="-- C4 --">
                                                                <option disabled selected hidden>-- C4 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">
                                                                        {{ $satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C5</label>
                                                            <select class="form-control select2" name="satuan_c5"
                                                                placeholder="-- C5 --">
                                                                <option disabled selected hidden>-- C5 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">
                                                                        {{ $satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="borderParameter row"
                                                        style="background-color:#4CEA67; z-index:10; border-radius:10px; margin:0 10px 10px 10px;">
                                                        <div class="form-group col-md-3">
                                                            <label for="parameter">Parameter C6</label>
                                                            <select class="form-control select2" name="parameter_c6"
                                                                placeholder="-- C6 --">
                                                                <option disabled selected hidden>-- C6 --</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C7</label>
                                                            <select class="form-control select2" name="parameter_c7"
                                                                placeholder="-- C7 --">
                                                                <option disabled selected hidden>-- C7 --</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C8</label>
                                                            <select class="form-control select2" name="parameter_c8"
                                                                placeholder="-- C8 --">
                                                                <option disabled selected hidden>-- C8 --</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C9</label>
                                                            <select class="form-control select2" name="parameter_c9"
                                                                placeholder="-- C9 --">
                                                                <option disabled selected hidden>-- C9 --</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="parameter">Parameter C10</label>
                                                            <select class="form-control select2" name="parameter_c10"
                                                                placeholder="-- C10 --">
                                                                <option disabled selected hidden>-- C10 --</option>
                                                                @foreach ($parameter as $param)
                                                                    <option value="{{ $param['parameter'] }}">
                                                                        {{ $param['parameter'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="borderSatuan row"
                                                        style="background-color:#fb160a; z-index:10; border-radius:10px; margin:0 10px 10px 10px;">
                                                        <div class="form-group col-md-3">
                                                            <label for="satuan">Satuan C6</label>
                                                            <select class="form-control select2" name="satuan_c6"
                                                                placeholder="-- C6 --">
                                                                <option disabled selected hidden>-- C6 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">
                                                                        {{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C7</label>
                                                            <select class="form-control select2" name="satuan_c7"
                                                                placeholder="-- C7 --">
                                                                <option disabled selected hidden>-- C7 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan['satuan'] }}">
                                                                        {{ $satuan['satuan'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C8</label>
                                                            <select class="form-control select2" name="satuan_c8"
                                                                placeholder="-- C8 --">
                                                                <option disabled selected hidden>-- C8 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">
                                                                        {{ $satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C9</label>
                                                            <select class="form-control select2" name="satuan_c9"
                                                                placeholder="-- C9 --">
                                                                <option disabled selected hidden>-- C9 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">
                                                                        {{ $satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="satuan">Satuan C10</label>
                                                            <select class="form-control select2" name="satuan_c10"
                                                                placeholder="-- C10 --">
                                                                <option disabled selected hidden>-- C10 --</option>
                                                                @foreach ($input_satuan as $satuan)
                                                                    <option value="{{ $satuan->satuan }}">
                                                                        {{ $satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> --}}



                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-2%;">Simpan Data</button>
                                                <a href="/operator/laporan_analisa_air" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-5%;">Back</a>
                                            </div>
                                        </form>
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
        var maxInput = 4;
        $('#addSampel').click(function(){
            if(i < maxInput){
                ++i;
                $('#sampel').append(`

                    <div class="form-row removeSampel" id="removeSampel">
                        <div class="form-group col-md-3">
                            <label for="sampel">Nama Sampel</label>
                            <input type="text" name="inputSampel[${i}][sampel]" class="form-control" id="sampel" placeholder="Masukkan Sampel">
                        </div>



                        <div class="form-group col-md-1" align="center" style="margin-top:30px;">
                            <button type="button" name="remove" id="remove" class="btn btn-danger" style=""><i class="fa-solid fa-trash"></i></button>
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




    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Parameter ...',
                allowClear: true
            })
        });
    </script>


@endsection
