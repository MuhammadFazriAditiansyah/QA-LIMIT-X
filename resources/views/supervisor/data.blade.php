@extends('layout-operator')
@section('content')


 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Analisa Kimia</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Analisa Kimia</h2>
            {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">


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

                        @if(Session::get('successDelete'))
                        <div class="alert alert-danger w-70">
                            {{Session::get('successDelete')}}
                        </div>
                        @endif

                        @if(Session::get('successUpdate'))
                        <div class="alert alert-danger w-70">
                            {{Session::get('successUpdate')}}
                        </div>
                        @endif

                        @if(Session::get('supervisorttd'))
                        <div class="alert alert-success w-70">
                            {{Session::get('supervisorttd')}}
                        </div>
                        @endif



                        <div class="card-body mt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>No.Dokumen</th>
                                        <th>Pemberi sampel</th>
                                        {{-- <th>Parameter Pengujian</th>
                                        <th>Jumlah sampel</th> --}}
                                        <th>Tanggal terima sampel</th>
                                        <th>Tanggal Uji</th>
                                        <th>Tanggal selesai uji</th>
                                        {{-- <th>Sampel</th>
                                        <th>Parameter dan Nilai Uji</th>
                                        <th>Spesifikasi</th>
                                        <th>Keterangan</th> --}}
                                        <th>Tanda Tangan Operator</th>
                                        <th>Tanda Tangan Staff</th>
                                        <th>Tanda Tangan Supervisor</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($futamis as $futami)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$futami->nodokumen}}</td>
                                            <td>{{$futami->pemberi_sampel}}</td>
                                            {{-- <td>{{$futami->parameter_pengujian}}</td>
                                            <td>{{$futami->jumlah_sampel}}</td> --}}
                                            <td>{{$futami->tanggal_terima}}</td>
                                            <td>{{$futami->tanggal_uji}}</td>
                                            <td>{{$futami->tanggal_selesai}}</td>
                                            {{-- <td>{{$futami->sampel}}</td>
                                            <td>{{$futami->parameter_nulaiuji}}</td>
                                            <td>{{$futami->spesifikasi}}</td>
                                            <td>{{$futami->keterangan}}</td> --}}
                                            <td>
                                                @if($futami['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$futami['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form> --}}
                                                    Data Belum Ditandatangani

                                                    @elseif($futami['statusOP'] == 1)
                                                    {{-- {{$futami->statusOP}} --}}
                                                    {{-- {{ Auth::user()->id }}
                                                    {{ Auth::user()->nama }} --}}
                                                    {{-- {{ $futami->user_id_OP }} _ {{ $futami->name_id_OP }}
                                                    <br> --}}

                                                    {!! QrCode::size(80)->generate($futami->user_id_OP ."_". $futami->name_id_OP) !!}
                                                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($futami->user_id_OP ."_". $futami->name_id_OP)) !!}" alt=""> --}}

                                                @endif
                                            </td>
                                            <td>
                                                @if($futami['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$futami['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>

                                                    <form action="/declinettd/{{$futami['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    <p>Data Belum Ditandatangani</p>


                                                @elseif($futami['statusST'] == 1)
                                                    {{-- {{$futami->statusST}} --}}
                                                    {{-- {{ Auth::user()->id }}
                                                    {{ Auth::user()->nama }} --}}
                                                    {{-- {{ $futami->user_id_OP }} _ {{ $futami->name_id_ST }}
                                                    <br> --}}
                                                    {!! QrCode::size(80)->generate($futami->user_id_ST ."_". $futami->name_id_ST) !!}
                                                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($futami->user_id_ST ."_". $futami->name_id_ST)) !!}" alt=""> --}}


                                                @elseif($futami['statusST'] == 2)
                                                    <div class="alert alert-danger">Data Ditolak</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($futami['statusSP'] == 0)
                                                    @if (Auth::user()->role_id == 3)
                                                        <form action="/supervisorttd/{{$futami['id']}}" method="POST" class="text-center">
                                                            @csrf
                                                            @method('PATCH')

                                                            <div class="form-group col-md-1">
                                                                <input type="date" name="ttd_supervisor" class="form-control" style="width:120px;">
                                                            </div>

                                                            <button type="submit" class="btn btn-success btn">TTD</button>
                                                        </form>
                                                    @else
                                                        <p>Data belum ditandatangani</p>
                                                    @endif


                                              @elseif($futami['statusSP'] == 1)
                                                {{-- {{$futami->statusSP}} --}}
                                                {{-- {{ Auth::user()->id }}
                                                {{ Auth::user()->nama }} --}}
                                                {{-- {{ $futami->user_id_SP }} _ {{ $futami->name_id_SP }}
                                                <br> --}}
                                                {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($futami->user_id_SP ."_". $futami->name_id_SP)) !!}" alt=""> --}}
                                                {!! QrCode::size(80)->generate($futami->user_id_SP ."_". $futami->name_id_SP) !!}

                                              @endif
                                            </td>
                                            <td>
                                                <form action="{{route('delete', $futami['id'])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                    <br>
                                                    <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit', $futami->id)}}"></a>
                                                    <br>--}}

                                                    {{-- <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('supervisor_analisakimiapdf', $futami->id)}}"></a> --}}
                                                    <a href="{{route('supervisor_analisakimiapdf', $futami->id)}}" target="_blank"><i class="fa-solid fa-file-pdf ml-1 fa-lg"></i></a>

                                                    <a target="_blank" href="{{route('supervisor_analisakimia_excel_show', $futami->id)}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
                                                            <path d="M2.85858 2.87756L15.4293 1.08175C15.7027 1.0427 15.9559 1.23265 15.995 1.50601C15.9983 1.52943 16 1.55306 16 1.57672V22.4237C16 22.6999 15.7761 22.9237 15.5 22.9237C15.4763 22.9237 15.4527 22.922 15.4293 22.9187L2.85858 21.1229C2.36593 21.0525 2 20.6306 2 20.1329V3.86751C2 3.36986 2.36593 2.94794 2.85858 2.87756ZM17 3.00022H21C21.5523 3.00022 22 3.44793 22 4.00022V20.0002C22 20.5525 21.5523 21.0002 21 21.0002H17V3.00022ZM10.2 12.0002L13 8.00022H10.6L9 10.2859L7.39999 8.00022H5L7.8 12.0002L5 16.0002H7.39999L9 13.7145L10.6 16.0002H13L10.2 12.0002Z" fill="rgba(39,157,81,1)">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>

                                        @empty
                                            <tr>
                                                <td class="text-center h5" colspan="10" align="center">Not Found</td>
                                            </tr>
                                    @endforelse
                                </table>
                                {{ $futamis->links('pagination::bootstrap-4') }}

                            </div>
                        </div>
                        {{-- <div class="card-footer text-right">
                        <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                        </nav>
                    </div> --}}
                    </div>
                </div>
                {{-- <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                    <div class="card-header">
                        <h4>Full Width</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Irwansyah Saputra</td>
                            <td>2017-01-09</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>2</td>
                            <td>Hasan Basri</td>
                            <td>2017-01-09</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td>Kusnadi</td>
                            <td>2017-01-11</td>
                            <td><div class="badge badge-danger">Not Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>4</td>
                            <td>Rizal Fakhri</td>
                            <td>2017-01-11</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>5</td>
                            <td>Isnap Kiswandi</td>
                            <td>2017-01-17</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                        </nav>
                    </div>
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                        <form>
                            <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                            <th>
                                <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                            </th>
                            <th>Task Name</th>
                            <th>Progress</th>
                            <th>Members</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                            <tr>
                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                            </td>
                            <td>
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                            </td>
                            <td>2018-01-20</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                <div class="progress-bar" data-width="0"></div>
                                </div>
                            </td>
                            <td>
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                            </td>
                            <td>2018-04-10</td>
                            <td><div class="badge badge-info">Todo</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3">
                                <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                <div class="progress-bar bg-warning" data-width="70"></div>
                                </div>
                            </td>
                            <td>
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                            </td>
                            <td>2018-01-29</td>
                            <td><div class="badge badge-warning">In Progress</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td class="p-0 text-center">
                                <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
                                <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                            </td>
                            <td>
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                            </td>
                            <td>2018-01-16</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div> --}}
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Sortable Table</h4>
                        <div class="card-header-action">
                        <form>
                            <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped" id="sortable-table">
                            <thead>
                            <tr>
                                <th class="text-center">
                                <i class="fas fa-th"></i>
                                </th>
                                <th>Task Name</th>
                                <th>Progress</th>
                                <th>Members</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                </div>
                                </td>
                                <td>Create a mobile app</td>
                                <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                    <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                                </td>
                                <td>
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                </td>
                                <td>2018-01-20</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                                <td>
                                <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                </div>
                                </td>
                                <td>Redesign homepage</td>
                                <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                    <div class="progress-bar" data-width="0"></div>
                                </div>
                                </td>
                                <td>
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                                </td>
                                <td>2018-04-10</td>
                                <td><div class="badge badge-info">Todo</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                                <td>
                                <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                </div>
                                </td>
                                <td>Backup database</td>
                                <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                    <div class="progress-bar bg-warning" data-width="70"></div>
                                </div>
                                </td>
                                <td>
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                                </td>
                                <td>2018-01-29</td>
                                <td><div class="badge badge-warning">In Progress</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                                <td>
                                <div class="sort-handler">
                                    <i class="fas fa-th"></i>
                                </div>
                                </td>
                                <td>Input data</td>
                                <td class="align-middle">
                                <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                    <div class="progress-bar bg-success" data-width="100"></div>
                                </div>
                                </td>
                                <td>
                                <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                                <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                                </td>
                                <td>2018-01-16</td>
                                <td><div class="badge badge-success">Completed</div></td>
                                <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div> --}}
        </div>
    </section>
</div>

@endsection
