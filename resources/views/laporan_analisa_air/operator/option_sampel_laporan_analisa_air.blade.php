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
                    <a href="/operator/mikrobiologi_kimia_sensori" class="nav-link"><i class="fas fa-atom"></i><span>Pemeriksaan Kimia Dan Sensori</span></a>
                </li>

              </ul>
            <hr>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Sampel Laporan Analisa Air</h1>
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
                {{-- <h2 class="section-title">Tambah Data Sampel {{$data_laporan_analisa_air->sampel}}</h2> --}}
                <h2 class="section-title">Tambah Data Sampel {{$sampel_null->sampel}}</h2>
                <div class="row shadow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card">
                                {{-- <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Pilih Sampel Yang Akan di Isi</h4>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                @foreach ($data_laporan_analisa_air as $data)
                                                    <a href="/operator/sampel_laporan_analisa_air/{{ $laporan_analisa_air->id }}/{{$data->id}}" class="btn btn-primary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">{{ $data->sampel }}</a>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div> --}}


                                @if ($sampel_id > 8)
                                    <form action="{{route('sampel_laporan_analisa_air.post', ['id'=>$id, 'sampel_id'=>$sampel_id])}}" method="POST">
                                        @csrf
          
                                        <div class="form-row" style="margin-top:1%; padding:10px;" id="sampel">
                                            <div class="form-group col-md-4" align="center">
                                                <label for="pengujian">Pengujian</label>
                                                <select class="form-control select2" name="inputSampel[0][pengujian]" placeholder="-- C1 --">
                                                    <option disabled selected hidden>-- Pengujian --</option>
                                                    @foreach ($parameter as $param)
                                                        <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2" align="center">
                                                <label for="shift_1">Shift 1</label>
                                                <input type="text" name="inputSampel[0][shift_1]" class="form-control" id="shift_1" placeholder="Masukkan shift 1">
                                            </div>
                                            <div class="form-group col-md-2" align="center">
                                                <label for="shift_2">Shift 2</label>
                                                <input type="text" name="inputSampel[0][shift_2]" class="form-control" id="shift_2" placeholder="Masukkan shift 2">
                                            </div>
                                            <div class="form-group col-md-3" align="center">
                                                <label for="keterangan">Keterangan</label>
                                                <input type="text" name="inputSampel[0][keterangan]" class="form-control" id="keterangan" placeholder="Masukkan keterangan">
                                            </div>
            
            
            
            
            
                                            <div class="form-group col-md-1" style="margin-top: 30px;">
                                                <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
            
                                        <div class="card-footer">
                                            <a href="#" onclick="goBack()" class="btn btn-icon icon-left btn-danger"><i class="fas fa-arrow-left"></i> Back</a>
                                            <button type="submit" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan sampel</button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{route('sampel_laporan_analisa_air.post', ['id'=>$id, 'sampel_id'=>$sampel_id])}}" method="POST">
                                        @csrf
                                    
                                        @foreach ($pengujian as $key => $sampel)    
                                            <div class="form-row" style="margin-top:1%; padding:10px;" id="sampel">
                                                <div class="form-group col-md-4" align="center">
                                                    <label for="pengujian">Pengujian</label>
                                                    <select class="form-control select2" name="inputSampel[{{ $key }}][pengujian]" placeholder="-- C1 --">
                                                        <option selected value="{{ $sampel->pengujian }}">{{ $sampel->pengujian }}</option>
                                                        @foreach ($parameter as $param)
                                                            <option value="{{ $param['id'] }}">{{ $param['parameter'] }}</option>
                                                        @endforeach                                                   
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="shift_1">Shift 1</label>
                                                    <input type="text" name="inputSampel[{{ $key }}][shift_1]" class="form-control" id="shift_1" placeholder="Masukkan shift 1">
                                                </div>
                                                <div class="form-group col-md-2" align="center">
                                                    <label for="shift_2">Shift 2</label>
                                                    <input type="text" name="inputSampel[{{ $key }}][shift_2]" class="form-control" id="shift_2" placeholder="Masukkan shift 2">
                                                </div>
                                                <div class="form-group col-md-4" align="center">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input type="text" name="inputSampel[{{ $key }}][keterangan]" class="form-control" id="keterangan" placeholder="Masukkan keterangan">
                                                </div>
                                            </div>
                                        @endforeach
                                            
                                        <div class="card-footer">
                                            <a href="#" onclick="goBack()" class="btn btn-icon icon-left btn-danger"><i class="fas fa-arrow-left"></i> Back</a>
                                            <button type="submit" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan sampel</button>
                                        </div>
                                    </form>
                                @endif
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Pengujian ...',
            allowClear: true
        })
    });
</script>






{{-- Script multiple inputs yg baru --}}
<script>
    var i = 0;
    var maxInput = 6;
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;


            $('#sampel').append(`
                <div class="card-body removeSampel" id="removeSampel${i}" style="margin-left:-25px;">
                    <div class="form-row" style="margin-top:-5%; padding:10px;" align="center">
                        <div class="form-group col-md-4">
                        <select class="form-control select2" name="inputSampel[${i}][pengujian]" placeholder="-- C1 --">
                            <option disabled selected hidden>-- Pengujian --</option>
                            @foreach ($parameter as $param)
                                <option value="{{ $param['parameter'] }}">{{ $param['parameter'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <input type="text" name="inputSampel[${i}][shift_1]" class="form-control" id="shift_1" placeholder="Masukkan shift 1">
                    </div>
                    <div class="form-group col-md-2" align="center">
                        <input type="text" name="inputSampel[${i}][shift_2]" class="form-control" id="shift_2" placeholder="Masukkan shift 2">
                    </div>
                    <div class="form-group col-md-3" align="center">
                        <input type="text" name="inputSampel[${i}][keterangan]" class="form-control" id="keterangan" placeholder="Masukkan keterangan">
                    </div>


                    <div class="form-group col-md-1" align="center">
                        <button type="button" name="remove" id="remove" class="btn btn-danger" style=""><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </div>

        `);
            $(`#removeSampel${i} .select2`).select2();
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





<script>
    function goBack() {
        window.history.back();
    }
</script>


@endsection
