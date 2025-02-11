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
                <h1>Tambah Data Sampel</h1>
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
                <h2 class="section-title">Tambah Data Sampel</h2> 
                <div class="row shadow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card">
                                <form action="{{route('sampel_analisa_kimia.post', $id)}}" method="POST">
                                  @csrf 

                                    <div class="card-body" id="sampel">
                                        

                                        <div class="form-row" style="margin-top:1%;">
                                            <div class="form-group col-md-3" align="center">
                                                <label for="inputEmail4">Sampel</label>
                                            </div> 
                                            <div class="form-group col-md-1" align="center">
                                                <label for="inputEmail4">{{$futamis['parameter_pengujian']}}</label>
                                            </div>
                                            <div class="form-group col-md-1" align="center">
                                                <label for="inputEmail4">{{$futamis['parameter_pengujian_c2']}}</label>
                                            </div>
                                            <div class="form-group col-md-1" align="center">
                                                <label for="inputEmail4">{{$futamis['parameter_pengujian_c3']}}</label>
                                            </div>
                                            <div class="form-group col-md-1" align="center">
                                                <label for="inputEmail4">{{$futamis['parameter_pengujian_c4']}}</label>
                                            </div>
                                            <div class="form-group col-md-2" align="center"> 
                                                <label for="inputEmail4">Spesifikasi</label>
                                            </div>
                                            <div class="form-group col-md-2" align="center">
                                                <label for="inputEmail4">Keterangan</label>
                                            </div>
                                            
                                        </div>
                                        <div class="form-row" style="margin-top:-3%;">
                                            <div class="form-group col-md-3">
                                                <input type="text" name="inputSampel[0][sampel]" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                                            </div> 
                                            <div class="form-group col-md-1">
                                                <input type="text" name="inputSampel[0][parameter_nilaiuji]" class="form-control" id="inputEmail4" placeholder=" ">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <input type="text" name="inputSampel[0][parameter_nilaiuji_c2]" class="form-control" id="inputEmail4" placeholder=" ">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <input type="text" name="inputSampel[0][parameter_nilaiuji_c3]" class="form-control" id="inputEmail4" placeholder=" ">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <input type="text" name="inputSampel[0][parameter_nilaiuji_c4]" class="form-control" id="inputEmail4" placeholder=" ">
                                            </div>
                                            <div class="form-group col-md-2"> 
                                                <textarea type="text" name="inputSampel[0][spesifikasi]" class="form-control" id="inputEmail4" placeholder="Masukkan spesifikasi (optional)"></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <textarea type="text" name="inputSampel[0][keterangan]" rows="1" class="form-control" id="inputEmail4" placeholder="Masukkan keterangan (optional)"></textarea>
                                            </div>
                                            <div class="form-group col-md-1" align="center">
                                                <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        {{-- <a href="/operator/analisakimia" class="btn btn-primary" style="width:30%; text-align:center; margin-left:1%; margin-top:-5%;">Back</a> --}}
                                        {{-- <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan data sampel</a> --}}
                                        <button type="submit" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan sampel</button>
                                        {{-- <a href="/operator/data" class="btn btn-success" style="width:30%; text-align:center; margin-left:1%; margin-top:-12%;">Selesai Simpan Data</a> --}}
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


{{-- <script>
    var i = 0;
    var maxInput = 10; 
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`        
            <div class="form-row" id="removeSampel" style="margin-top: 30px;">
                <button type="button" name="remove" id="remove" class="btn btn-danger" style="width:18%; text-align:center; margin-left:83%; margin-top:-1%;">Remove</button>
               
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Sampel</label>
                    <input type="text" name="inputSampel['+i+'][sampel]" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Parameter dan Nilai uji</label>
                    <input type="text" name="inputSampel['+i+'][parameter_nilaiuji]" class="form-control" id="inputEmail4" placeholder="Masukkan nama parameter dan nilai uji">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Spesifikasi</label>
                    <input type="text" name="inputSampel['+i+'][spesifikasi]" class="form-control" id="inputEmail4" placeholder="Masukkan spesifikasi">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Keterangan</label>
                    <input type="text" name="inputSampel['+i+'][keterangan]" class="form-control" id="inputEmail4" placeholder="Masukkan keterangan">
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
            title: 'Input sampel telah mencapai batas maksimal!'
            })
        }
        
       
    });

    $(document).on('click','#remove', function(){
        $(this).parent('div').remove(); 
        i--;
    })
</script> --}}

{{-- Script multiple input data sampel  --}}
<script>
    var i = 0;
    var maxInput = 10; 
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`  

            <div class="card-body removeSampel" id="removeSampel" style="margin-top: -2%; margin-left:-25px;">

                <div class="form-row" style="margin-top:2%;">
                    <div class="form-group col-md-3" style="width:216px;">
                        <input type="text" name="inputSampel[${i}][sampel]" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                    </div> 
                    <div class="form-group col-md-1">
                        <input type="text" name="inputSampel[${i}][parameter_nilaiuji]" class="form-control" id="inputEmail4" placeholder=" ">
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" name="inputSampel[${i}][parameter_nilaiuji_c2]" class="form-control" id="inputEmail4" placeholder=" ">
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" name="inputSampel[${i}][parameter_nilaiuji_c3]" class="form-control" id="inputEmail4" placeholder=" ">
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" name="inputSampel[${i}][parameter_nilaiuji_c4]" class="form-control" id="inputEmail4" placeholder=" ">
                    </div>
                    <div class="form-group col-md-2"> 
                        <textarea type="text" name="inputSampel[${i}][spesifikasi]" class="form-control" id="inputEmail4" placeholder="Masukkan spesifikasi (optional)"></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <textarea type="text" name="inputSampel[${i}][keterangan]" rows="1" class="form-control" id="inputEmail4" placeholder="Masukkan keterangan (opetional)"></textarea>
                    </div>
                    <div class="form-group col-md-1" align="center">
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
            title: 'Input sampel telah mencapai batas maksimal!'
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
