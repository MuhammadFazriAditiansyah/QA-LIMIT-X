@extends('layout-operator')
@section('content')


  <div id="app">
      <div class="main-wrapper main-wrapper-1">
          <div class="navbar-bg"></div>
          <nav class="navbar navbar-expand-lg main-navbar">
            {{-- <form action="{{route('delete', $futami['id'])}}" method="POST"> --}}

                <form class="form-inline mr-auto" method="GET" action="{{ route('mikrobiologi_alat_mesin_history') }}">
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
                <a class="text-success btn" href="/operator/mikrobiologi_alat_mesin/history" style="margin-right:24%;"><i class="fa-solid fa-arrows-rotate fa-lg"></i></a>

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
                          <a href="/operator/mikrobiologi_alat_mesin" class="nav-link"><i class="fa-solid fa-screwdriver-wrench"></i><span>Mikrobiologi Alat Dan Mesin</span></a>
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
                      <h1>History Analisa Mikrobiologi Alat Dan Mesin</h1>
                  </div>

                  <div class="section-body">
                      <h2 class="section-title">History Analisa Mikrobiologi Alat Dan Mesin</h2>

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
                                    <a href="/operator/mikrobiologi_alat_mesin" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                                </div>

                                <div class="card-body mt-3 shadow">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>No</th>
                                                <th>No.Dokumen</th>
                                                <th>Nama Produk</th>
                                                <th>Tgl. Inokulasi</th>
                                                <th>Action</th>
                                                {{-- <th>Tgl. Pengamatan</th> --}}
                                            </tr>
                                            @forelse ($mikrobiologi_alat_mesin as $alat_mesin)
                                                  <tr>
                                                      <td>{{++$no}}</td>
                                                      <td>{{$alat_mesin->nodokumen}}</td>
                                                      <td>{{$alat_mesin->nama_produk}}</td>
                                                      <td>{{Carbon\Carbon::parse($alat_mesin->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                                      <td>
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <!-- Tombol Restore dengan Icon -->
                                                            <form action="{{ route('mikrobiologi_alat_mesin.restore', $alat_mesin->id) }}" method="POST" class="mr-2">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="bi bi-arrow-repeat"></i> Pulihkan
                                                                </button>
                                                            </form>

                                                            <!-- Tombol Hapus Permanen dengan Icon -->
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal-{{ $alat_mesin->id }}">
                                                                <i class="bi bi-trash"></i> Hapus Permanen
                                                            </button>
                                                        </div>
                                                    </td>
                                                      {{-- <td>{{Carbon\Carbon::parse($alat_mesin->tgl_pengamatan)->translatedFormat('d F Y')}}</td> --}}
                                                      {{-- <td align="center">
                                                        @if($alat_mesin['statusOP'] == 0)
                                                          <form action="/operator/alat_mesin/ttd/{{$alat_mesin['id']}}" method="POST" class="text-center">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-success btn" style="">TTD</button>
                                                          </form>


                                                        @elseif($alat_mesin['statusOP'] == 1)
                                                          <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($alat_mesin->user_id_OP .'_'. $alat_mesin->name_id_OP)) !!}" alt="">

                                                        @endif

                                                      </td> --}}
                                                      {{-- <td>
                                                          <form action="{{route('mikrobiologi_Delete', $alat_mesin['id'])}}" method="POST">
                                                              @csrf
                                                              @method('PATCH')

                                                              <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                              <br>
                                                              <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit_mikrobiologi', $alat_mesin->id)}}"></a>

                                                              <br>
                                                              <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('operator_mikrobiologi_pdf', $alat_mesin->id)}}"></a>
                                                              <br>
                                                              <a href="{{ route('mikrobiologi_sampel', $alat_mesin->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>
                                                          </form>
                                                      </td> --}}
                                                  </tr>

                                                  @empty
                                                      <tr>
                                                        <td class="text-center h5" colspan="7">Not Found</td>
                                                      </tr>
                                              @endforelse


                                          </table>
                                          {{-- {{ $mikrobiologi_alat_mesin->links('pagination::bootstrap-4') }} --}}
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

    <!-- Modal Konfirmasi -->
@foreach ($mikrobiologi_alat_mesin as $mikrobiologi)
<div class="modal fade" id="confirmDeleteModal-{{ $mikrobiologi->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel-{{ $mikrobiologi->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel-{{ $mikrobiologi->id }}">Konfirmasi Hapus Permanen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini secara permanen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('mikrobiologi_alat_mesin_delete_permanent', $mikrobiologi->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
