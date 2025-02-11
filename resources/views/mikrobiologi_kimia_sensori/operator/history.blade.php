@extends('layout-operator')
@section('content')
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                {{-- <form action="{{route('delete', $futami['id'])}}" method="POST"> --}}

                <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_kimia_sensori_history') }}">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="date" name="tgl_produksi_awal" id="tgl_produksi_awal" placeholder="Tanggal Uji" aria-label="Search" data-width="250">
                        <input class="form-control" type="date" name="tgl_produksi_akhir" id="tgl_produksi_akhir" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <a class="text-success btn" href="/operator/mikrobiologi_kimia_sensori/history" style="margin-right:24%;"><i
                        class="fa-solid fa-arrows-rotate fa-lg"></i></a>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#"
                            data-toggle="dropdown"class="nav-link dropdown-toggle nav-link-lg nav-link-user">
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
                            <a href="/operator/mikrobiologi_kimai_sensori" class="nav-link"><i
                                    class="fa-solid fa-atom"></i><span>Pemeriksaan Kimia Dan Sensori</span></a>
                        </li>




                        {{-- <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i><span>Credits</span></a></li> --}}
                    </ul>
                    <hr>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>History Analisa Pemeriksaan Kimia Dan Sensori</h1>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">History Analisa Pemeriksaan Kimia Dan Sensori</h2>

                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow">


                                    @if (Session::get('successAdd'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('successAdd') }}
                                        </div>
                                    @endif

                                    @if (Session::get('successDelete'))
                                        <div class="alert alert-danger w-70">
                                            {{ Session::get('successDelete') }}
                                        </div>
                                    @endif

                                    @if (Session::get('successUpdate'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('successUpdate') }}
                                        </div>
                                    @endif

                                    @if (Session::get('operatorttd'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('operatorttd') }}
                                        </div>
                                    @endif

                                    @if (Session::get('successAddSampel'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('successAddSampel') }}
                                        </div>
                                    @endif


                                    <div class="button" style="margin-left:4%; margin-top:3%;">
                                        <a href="/operator/mikrobiologi_kimia_sensori"
                                            class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i>
                                            Back</a>

                                    </div>

                                    <div class="card-body mt-3 shadow">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th>No</th>
                                                    <th>No.Dokumen</th>
                                                    <th>Tgl. produksi</th>
                                                    <th>Nama Produk</th>
                                                    <th>Jumlah Batch</th>
                                                </tr>
                                                @forelse ($mikrobiologi_kimia_sensori as $kimia_sensori)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $kimia_sensori->nodokumen }}</td>
                                                        <td>{{ Carbon\Carbon::parse($kimia_sensori->tgl_produksi)->translatedFormat('d F Y') }}</td>
                                                        <td>{{ $kimia_sensori->nama_produk }}</td>
                                                        <td>{{ $kimia_sensori->jumlah_batch }}</td>
                                                        {{-- <td align="center">
                                                            @if ($kimia_sensori['statusOP'] == 0)
                                                                <form action="/operator/kimia_sensori/ttd/{{$kimia_sensori['id']}}" method="POST" class="text-center">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-success btn" style="">TTD</button>
                                                                </form>


                                                            @elseif($kimia_sensori['statusOP'] == 1)
                                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($kimia_sensori->user_id_OP .'_'. $kimia_sensori->name_id_OP)) !!}" alt="">

                                                            @endif

                                                        </td> --}}
                                                        {{-- <td>
                                                            <form action="{{route('mikrobiologi_Delete', $kimia_sensori['id'])}}" method="POST">
                                                                @csrf
                                                                @method('PATCH')

                                                                <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                                <br>
                                                                <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit_mikrobiologi', $kimia_sensori->id)}}"></a>

                                                                <br>
                                                                <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('operator_mikrobiologi_pdf', $kimia_sensori->id)}}"></a>
                                                                <br>
                                                                <a href="{{ route('mikrobiologi_sampel', $kimia_sensori->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>
                                                            </form>
                                                        </td> --}}
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <td class="text-center h5" colspan="7">Not Found</td>
                                                    </tr>
                                                @endforelse


                                            </table>
                                            {{ $mikrobiologi_kimia_sensori->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            {{-- <footer class="main-footer">
              <div class="footer-left">
                  Futami Qa
              </div>
              <div class="footer-right">

              </div>
          </footer> --}}
        </div>
    </div>
@endsection
