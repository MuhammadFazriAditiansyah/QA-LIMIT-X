@extends('layout-operator')
@section('content')


        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Analisa Mikrobiologi Air</h1>
                </div>

                <div class="section-body">
                    <h2 class="section-title">Analisa Mikrobiologi Air</h2>

                    {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

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




                                <div class="button" style="margin-left:4%;">
                                    {{-- <button type="submit" name="submit" id="" class="btn btn-success">Tambah Data</button> --}}
                                    {{-- <a href="/operator/tambahdata" class="btn btn-success">Tambah Data</a> --}}

                                    {{-- button create multi form --}}
                                    <a href="/operator/add_mikrobiologi" class="btn btn-success" style="margin-top: 20px;"><i class="fa fa-plus"></i> Tambah Data</a>

                                    <a href="/operator/mikrobiologi/history" class="btn btn-danger" style="width:auto; text-align:center; float:right; margin:20px;"><i class="fa fa-history"></i> History Delete</a>
                                  </div>

                                {{-- <form action="{{route('operatorpdf')}}" method="POST" target="_blank">
                                  @csrf

                                  <div class="button_download" style="margin-left:84%; margin-top:-4%;">
                                    <div class="col-md-7 col-lg-5">
                                      <a href="/operator/data/pdf" target="_blank">
                                        <button type="button" class="btn btn-outline-primary">
                                          <i class="fa-solid fa-file-pdf fa-2x ml-5"></i>
                                        </button>
                                      </a>
                                    </div>

                                  </div>
                                </form> --}}


                                <div class="card-body mt-1 shadow">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>No</th>
                                                <th>No.Dokumen</th>
                                                <th>Nama Produk</th>
                                                <th>Tgl. Inokulasi</th>
                                                {{-- <th>Tgl. Pengamatan</th> --}}
                                                <th>TTD Operator</th>
                                                <th>TTD Staff</th>
                                                <th>TTD Supervisor</th>
                                                <th>Action</th>
                                            </tr>
                                            @forelse ($mikrobiologi_airs as $mikrobiologi)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$mikrobiologi->nodokumen}}</td>
                                                    <td>{{$mikrobiologi->nama_produk}}</td>
                                                    <td>{{Carbon\Carbon::parse($mikrobiologi->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                                    {{-- <td>{{Carbon\Carbon::parse($mikrobiologi->tgl_pengamatan)->translatedFormat('d F Y')}}</td> --}}
                                                    <td align="center">
                                                      @if($mikrobiologi['statusOP'] == 0)
                                                        <form action="/operator/mikrobiologi/ttd/{{$mikrobiologi['id']}}" method="POST" class="text-center">
                                                          @csrf
                                                          @method('PATCH')

                                                            <div class="form-group col-md-1">
                                                                <input type="date" name="ttd_operator" class="form-control" style="width:120px;">
                                                            </div>

                                                          <button type="submit" class="btn btn-success btn" style="">TTD</button>
                                                        </form>


                                                      @elseif($mikrobiologi['statusOP'] == 1)
                                                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi->user_id_OP .'_'. $mikrobiologi->name_id_OP)) !!}" alt="">

                                                      @endif

                                                    </td>
                                                    <td>
                                                        @if($mikrobiologi['statusST'] == 0)
                                                            {{-- <form action="/staffttd/{{$mikrobiologi['id']}}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="badge badge-success btn">TTD</button>

                                                            </form>

                                                            <form action="/declinettd/{{$mikrobiologi['id']}}" method="POST" style="margin-top:5%;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                            </form> --}}

                                                            <p>Data Belum Ditandatangani</p>


                                                        @elseif($mikrobiologi['statusST'] == 1)
                                                            {{-- {!! QrCode::size(80)->generate($mikrobiologi->user_id_ST ."_". $mikrobiologi->name_id_ST) !!} --}}
                                                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi->user_id_ST ."_". $mikrobiologi->name_id_ST)) !!}" alt="">


                                                        @elseif($mikrobiologi['statusST'] == 2)
                                                            <div class="alert alert-danger">Data Ditolak</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($mikrobiologi['statusSP'] == 0)
                                                            {{-- <form action="/supervisor/mikrobiologi/ttd/{{$mikrobiologi['id']}}" method="POST" class="text-center">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success btn">TTD</button>
                                                            </form> --}}
                                                            <p>Data Belum Ditandatangani</p>

                                                        @elseif($mikrobiologi['statusSP'] == 1)
                                                            {{-- {!! QrCode::size(80)->generate($mikrobiologi->user_id_SP ."_". $mikrobiologi->name_id_SP) !!} --}}
                                                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi->user_id_SP ."_". $mikrobiologi->name_id_SP)) !!}" alt="">

                                                        @endif
                                                    </td>
                                                    <td align="center">
                                                        <form action="{{route('mikrobiologi_Delete', $mikrobiologi['id'])}}" method="POST">
                                                            @csrf
                                                            {{-- @method('DELETE')  --}}
                                                            @method('PATCH')

                                                            <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                            <br>
                                                            <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit_mikrobiologi', $mikrobiologi->id)}}"></a>

                                                            <br>
                                                            <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('operator_mikrobiologi_pdf', $mikrobiologi->id)}}"></a>

                                                            <a target="_blank" href="{{route('mikrobiologi_air_excel_show', $mikrobiologi->id)}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="12" height="12">
                                                                    <path d="M2.85858 2.87756L15.4293 1.08175C15.7027 1.0427 15.9559 1.23265 15.995 1.50601C15.9983 1.52943 16 1.55306 16 1.57672V22.4237C16 22.6999 15.7761 22.9237 15.5 22.9237C15.4763 22.9237 15.4527 22.922 15.4293 22.9187L2.85858 21.1229C2.36593 21.0525 2 20.6306 2 20.1329V3.86751C2 3.36986 2.36593 2.94794 2.85858 2.87756ZM17 3.00022H21C21.5523 3.00022 22 3.44793 22 4.00022V20.0002C22 20.5525 21.5523 21.0002 21 21.0002H17V3.00022ZM10.2 12.0002L13 8.00022H10.6L9 10.2859L7.39999 8.00022H5L7.8 12.0002L5 16.0002H7.39999L9 13.7145L10.6 16.0002H13L10.2 12.0002Z" fill="rgba(39,157,81,1)">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                            <br>
                                                            <a href="{{ route('mikrobiologi_sampel', $mikrobiologi->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>

                                                        </form>

                                                    </td>
                                                </tr>

                                                @empty
                                                    <tr>
                                                      <td class="text-center h5" colspan="8">Not Found</td>
                                                    </tr>
                                            @endforelse

                                          </table>
                                            {{ $mikrobiologi_airs->links('pagination::bootstrap-4') }}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

@endsection
