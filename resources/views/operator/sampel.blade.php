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
                            <a href="/operator/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="/operator/analisakimia/history" class="nav-link"><i class="fas fa-history"></i><span>History Delete</span></a>
                        </li> --}}

                        {{-- <li class="dropdown" style="margin-top: 130%;">
                            <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                        </li> --}}
                    </ul>
                    <hr>
                </aside>
            </div>

            <!-- Main Content -->


            {{-- <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Data Sampel Analisa Kimia</h1>
                    </div>
                    <div class="section-body"> 
                        <h2 class="section-title">Data Sampel Analisa Kimia</h2>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="button" style="margin-left:4%; margin-top:-1%;">
                                    </div>
                                    <div class="card-body mt-3">
                                        <div class="table-responsive">
                                            <div class="card-body shadow">
                                                <a href="/operator/data" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                                                <table class="table table-hover shadow mt-3">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Sampel</th>
                                                        <th scope="col">Parameter dan Nilai Uji_C1</th>
                                                        <th scope="col">Parameter dan Nilai Uji_C2</th>
                                                        <th scope="col">Parameter dan Nilai Uji_C3</th>
                                                        <th scope="col">Parameter dan Nilai Uji_C4</th>
                                                        <th scope="col">Spesifikasi</th>
                                                        <th scope="col">Keterangan</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($futami_sampel_kimia as $sampel)
                                                            <tr id="{{ $sampel->id }}">

                                                                <th scope="row">{{ ++$no }}</th>
                                                                <td>{{ $sampel->sampel }}</td>
                                                                <td>{{ $sampel->parameter_nilaiuji }}</td>
                                                                <td>{{ $sampel->parameter_nilaiuji_c2 }}</td>
                                                                <td>{{ $sampel->parameter_nilaiuji_c3 }}</td>
                                                                <td>{{ $sampel->parameter_nilaiuji_c4 }}</td>
                                                                <td>{{ $sampel->spesifikasi }}</td>
                                                                <td>{{ $sampel->keterangan }}</td>
                                                                <td>
                                                                    <form action="{{route('sampelDelete', $sampel['id'])}}" method="POST">
                                                                        @csrf 
                                                                        @method('DELETE') 
                                                                        <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                                    </form> 
                                                                </td>
                                                            </tr>

                                                            @empty
                                                            <tr>
                                                                <td class="text-center h5" colspan="6">Not Found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div> --}}





            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Data Sampel Analisa Kimia</h1>
                    </div>
                    <div class="section-body">
                        <h2 class="section-title">Data Sampel Analisa Kimia</h2>
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
                                        {{-- <a href="/operator/analisakimia" class="btn btn-success" style="margin-left: ;">Tambah Data</a> --}}
                                        {{-- <a href="#" class="btn btn-icon icon-left btn-danger" id="deleteAllSelectRecord" style="align-content: flex-end; align-items:end;"><i class="fas fa-trash"></i> Hapus sampel all</a> --}}
                                        <a href="/operator/data" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                                    </div>
        
                                    <div class="card-body mt-3 shadow">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th scope="col" rowspan="2" align="center" style="vertical-align:middle; text-align:center;">No</th>
                                                    <th scope="col" rowspan="2" align="center" style="vertical-align: middle; text-align:center;">Sampel</th>
                                                    <th scope="col" colspan="4" align="center" style="text-align:center;">Parameter dan Nilai Uji</th>
                                                    <th scope="col" rowspan="2" align="center" style="vertical-align: middle; text-align: center;">Spesifikasi</th>
                                                    <th scope="col" rowspan="2" align="center" style="vertical-align: middle; text-align: center;">Keterangan</th>
                                                    <th scope="col" rowspan="2" align="center" style="vertical-align: middle; text-align: center;">Action</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">{{$futamis['parameter_pengujian']}}</th>
                                                    <th scope="col">{{$futamis['parameter_pengujian_c2']}}</th>
                                                    <th scope="col">{{$futamis['parameter_pengujian_c3']}}</th>
                                                    <th scope="col">{{$futamis['parameter_pengujian_c4']}}</th>
                                                </tr>
                                                <tr>
                                                    @forelse ($futami_sampel_kimia as $sampel)
                                                        <tr id="{{ $sampel->id }}">
                                                            <th scope="row">{{ ++$no }}</th>
                                                            <td>{{ $sampel->sampel }}</td>
                                                            <td>{{ $sampel->parameter_nilaiuji }}</td>
                                                            <td>{{ $sampel->parameter_nilaiuji_c2 }}</td>
                                                            <td>{{ $sampel->parameter_nilaiuji_c3 }}</td>
                                                            <td>{{ $sampel->parameter_nilaiuji_c4 }}</td>
                                                            <td>{{ $sampel->spesifikasi }}</td>
                                                            <td>{{ $sampel->keterangan }}</td>
                                                            <td>
                                                                <form action="{{route('sampelDelete', $sampel['id'])}}" method="POST">
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
            <footer class="main-footer">
                <div class="footer-left">
                    Futami Operator
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>



{{-- Script untuk melakukan select all dengan checkbox --}}
<script>
    $(function(sampel) {
        $("#chkCheckAll").click(function() { //#chkCheckAll ini adalah id dari checkbox yang ada dalam th atas di luar foreach 
            $(".CheckBoxSampel").prop('checked', $(this).prop('checked')); //.CheckBoxSampel ini adalah class dari dalam foreach nya 
        });

        // $("#deleteAllSelectRecord").click(function(sampel){
        //     sampel.preventDefault();
        //     var allsampels = [];

        //     $("input:checkbox[name=sampels]:checked").each(function(){
        //         allsampels.push($(this).val());
        //     });

        //     $.ajax({
        //         url:"",
        //         type:"DELETE",
        //         data:{
        //             _token:$("input[name=_token]").val(),
        //             sampels: allsampels
        //         },
        //         success: function(response){
        //             $.each(allsampels, function(key,val){
        //                 $("#sampels")
        //             });
        //         }
        //     }); 
        // });
    });
</script>




    {{-- Script input tabel form untuk tambah data sampel (multiple inputs)  --}}
<script>
    var i = 0;
    var maxInput = 10; 
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`        
            <div class="form-row removeSampel" id="removeSampel" style="margin-top: 30px;">
                <button type="button" name="remove" id="remove" class="btn btn-danger" style="width:18%; text-align:center; margin-left:83%; margin-top:-1%;">Remove</button>
               
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Sampel</label>
                    <input type="text" name="inputSampel[${i}][sampel]" class="form-control" id="inputEmail4" placeholder="Masukkan nama sampel">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Parameter dan Nilai uji</label>
                    <input type="text" name="inputSampel[${i}][parameter_nilaiuji]" class="form-control" id="inputEmail4" placeholder="Masukkan nama parameter dan nilai uji">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Spesifikasi</label>
                    <input type="text" name="inputSampel[${i}][spesifikasi]" class="form-control" id="inputEmail4" placeholder="Masukkan spesifikasi">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Keterangan</label>
                    <input type="text" name="inputSampel[${i}][keterangan]" class="form-control" id="inputEmail4" placeholder="Masukkan keterangan">
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

    $(document).on('click','.remove', function(){
        $(this).closest('.removeSampel').remove(); 
        i--;
    })
</script>



@endsection
