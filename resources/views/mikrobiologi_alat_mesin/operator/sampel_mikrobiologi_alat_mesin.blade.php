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
                    <a href="/operator/mikrobiologi_alat_mesin" class="nav-link"><i class="fas fa-screwdriver-wrench"></i><span>Mikrobiologi Alat Dan Mesin</span></a>
                </li>

              </ul>
            <hr>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Mikrobiologi Alat Dan Mesin</h1>
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
                <h2 class="section-title">Tambah Data Mikrobiologi Alat Dan Mesin</h2>
                <div class="row shadow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card">
                                <form action="{{route('sampel_mikrobiologi_alat_mesin', $id)}}" method="POST">
                                  @csrf

                                    <div class="form-row" style="margin-top:1%;">
                                        <div class="form-group col-md-2" align="center">
                                            <label for="nama_objek">Nama Objek</label>
                                        </div>
                                        <div class="form-group col-md-2" align="center">
                                            <label for="jam_sampling">Jam Sampling</label>
                                        </div>
                                        <div class="form-group col-md-1" align="center">
                                            {{-- <label for="tpc">TPC (cfu/cm<sup>2</sup>)</label> --}}
                                            <label for="tpc">TPC ({{ $mikrobiologi_alat_mesin->satuan_tpc }})</label>
                                        </div>
                                        <div class="form-group col-md-2" align="center">
                                            {{-- <label for="yeast_mold">Yeast & Mold (cfu/cm<sup>2</sup>)</label> --}}
                                            <label for="yeast_mold">Yeast & Mold ({{ $mikrobiologi_alat_mesin->satuan_yeast_mold }})</label>
                                        </div>
                                        <div class="form-group col-md-2" align="center">
                                            <label for="coliform">Coliform ({{ $mikrobiologi_alat_mesin->satuan_coliform }})</label>
                                        </div>
                                        <div class="form-group col-md-2" align="center">
                                            <label for="keterangan">Keterangan</label>
                                        </div>
                                    </div>
                                    <div class="card-body" id="sampel">
                                        <div class="form-row" style="margin-top:-3%;">
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][nama_objek]" class="form-control" id="nama_objek" placeholder="Masukkan Nama Objek">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input type="time" name="inputSampel[0][jam_sampling]" class="form-control" id="jam_sampling" placeholder="Masukkan Jam Sampling">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <input type="text" name="inputSampel[0][tpc]" class="form-control" id="tpc" placeholder="TPC">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][yeast_mold]" class="form-control" id="yeast_mold" placeholder="Masukkan Yeast & Mold">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][coliform]" class="form-control" id="coliform" placeholder="Coliform">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <input type="text" name="inputSampel[0][keterangan]" class="form-control" id="keterangan" placeholder="keterangan (Optional)">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <button type="button" name="addSampel" id="addSampel" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" style="width:30%; text-align:center; margin-left:70%; margin-top:-9%;">Simpan sampel</button>
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


{{-- Script multiple input data sampel  --}}
<script>
    var i = 0;
    var maxInput = 28;
    $('#addSampel').click(function(){
        if(i < maxInput){
            ++i;
            $('#sampel').append(`

            <div class="card-body removeSampel" id="removeSampel" style="margin-top: -5%; margin-left:-25px;">

                <div class="form-row" style="margin-top:1%;">
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][nama_objek]" class="form-control" id="nama_objek" placeholder="Masukkan Nama Objek">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="time" name="inputSampel[${i}][jam_sampling]" class="form-control" id="jam_sampling" placeholder="Masukkan Jam Sampling">
                    </div>
                    <div class="form-group col-md-1">
                        <input type="text" name="inputSampel[${i}][tpc]" class="form-control" id="tpc" placeholder="Masukkan TPC">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][yeast_mold]" class="form-control" id="yeast_mold" placeholder="Masukkan Yeast & Mold">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][coliform]" class="form-control" id="coliform" placeholder="Coliform">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="inputSampel[${i}][keterangan]" class="form-control" id="keterangan" placeholder="Keterangan (optional)">
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
