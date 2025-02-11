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



                            <div class="button" style="margin-left:4%;">
                                {{-- <button type="submit" name="submit" id="" class="btn btn-success">Tambah Data</button> --}}
                                {{-- <a href="/operator/tambahdata" class="btn btn-success">Tambah Data</a> --}}

                                {{-- button create multi form --}}
                                <a href="/operator/analisakimia" class="btn btn-success" style="margin-top: 20px;"><i class="fa fa-plus"></i> Tambah Data</a>

                                {{-- <a href="/operator/parameter_pengujian" class="btn btn-primary" style="margin-top: 20px;"><i class="fa fa-plus"></i> Tambah Parameter Pengujian</a> --}}

                                <a href="/operator/analisakimia/history" class="btn btn-danger" style="width:auto; text-align:center; float:right; margin:20px;"><i class="fa fa-history"></i> History Delete</a>
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
                
                


                            <div class="card-body mt-1 shadow">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>No</th>
                                            <th>No.Dokumen</th>
                                            <th>Pemberi sampel</th>
                                            {{-- <th>Parameter Pengujian</th> --}}
                                            {{-- <th>Jumlah sampel</th> --}}
                                            <th>Tanggal terima sampel</th>
                                            <th>Tanggal Uji</th>
                                            <th>Tanggal selesai uji</th>
                                            {{-- <th>Sampel</th>
                                            <th>Parameter dan Nilai Uji</th>
                                            <th>Spesifikasi</th>
                                            <th>Keterangan</th> --}}
                                            <th>TTD Operator</th>
                                            <th>TTD Staff</th>
                                            <th>TTD Supervisor</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($futamis as $futami)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$futami->nodokumen}}</td>
                                                <td>{{$futami->pemberi_sampel}}</td>
                                                {{-- <td>{{$futami->parameter_pengujian}}</td> --}}
                                                {{-- <td>{{$futami->jumlah_sampel}}</td> --}}
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d F Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d F Y')}}</td>
                                                {{-- <td>{{$futami->sampel}}</td>
                                                <td>{{$futami->parameter_nulaiuji}}</td>
                                                <td>{{$futami->spesifikasi}}</td>
                                                <td>{{$futami->keterangan}}</td> --}}
                                                <td>
                                                  @if($futami['statusOP'] == 0)
                                                    <form action="/operatorttd/{{$futami['id']}}" method="POST" class="text-center">
                                                        @csrf
                                                        @method('PATCH')


                                                        <div class="form-group col-md-1">
                                                            <input type="date" name="ttd_operator" class="form-control" placeholder="TTD Operator" style="width:120px;">
                                                        </div>

                                                        <button type="submit" class="btn btn-success btn" style="">TTD</button>
                                                    </form>


                                                  @elseif($futami['statusOP'] == 1)
                                                    {{-- {!! QrCode::size(50)->generate(Request::url('alief')) !!} --}}
                                                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->generate($futami->user_id_OP .'_'. $futami->name_id_OP)) !!}" alt=""> --}}

                                                    {!! (QrCode::size(50)->generate($futami->user_id_OP ."_". $futami->name_id_OP)) !!}

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
                                                        {!! QrCode::size(50)->generate($futami->user_id_ST ."_". $futami->name_id_ST) !!}
                                                        {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->generate($futami->user_id_ST ."_". $futami->name_id_ST)) !!}" alt=""> --}}


                                                    @elseif($futami['statusST'] == 2)
                                                        <div class="alert alert-danger">Data Ditolak</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($futami['statusSP'] == 0)
                                                    {{-- <form action="/supervisorttd/{{$futami['id']}}" method="POST" class="text-center">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn">TTD</button>
                                                    </form> --}}
                                                    <p>Data Belum Ditandatangani</p>

                                                  @elseif($futami['statusSP'] == 1)
                                                    {{-- {{$futami->statusSP}} --}}
                                                    {{-- {{ Auth::user()->id }}
                                                    {{ Auth::user()->nama }} --}}
                                                    {{-- {{ $futami->user_id_SP }} _ {{ $futami->name_id_SP }}
                                                    <br> --}}
                                                    {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->generate($futami->user_id_SP ."_". $futami->name_id_SP)) !!}" alt=""> --}}
                                                    {!! QrCode::size(50)->generate($futami->user_id_SP ."_". $futami->name_id_SP) !!}

                                                  @endif
                                                </td>
                                                <td align="center">
                                                    <form action="{{route('delete', $futami['id'])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                        <br>
                                                        <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit_data_analisa_kimia', $futami->id)}}"></a>

                                                        <br>
                                                        <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('operator_analisakimiapdf', $futami->id)}}"></a>

                                                        <a target="_blank" href="{{route('operator_analisakimia_excel_show', $futami->id)}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="12" height="12">
                                                                <path d="M2.85858 2.87756L15.4293 1.08175C15.7027 1.0427 15.9559 1.23265 15.995 1.50601C15.9983 1.52943 16 1.55306 16 1.57672V22.4237C16 22.6999 15.7761 22.9237 15.5 22.9237C15.4763 22.9237 15.4527 22.922 15.4293 22.9187L2.85858 21.1229C2.36593 21.0525 2 20.6306 2 20.1329V3.86751C2 3.36986 2.36593 2.94794 2.85858 2.87756ZM17 3.00022H21C21.5523 3.00022 22 3.44793 22 4.00022V20.0002C22 20.5525 21.5523 21.0002 21 21.0002H17V3.00022ZM10.2 12.0002L13 8.00022H10.6L9 10.2859L7.39999 8.00022H5L7.8 12.0002L5 16.0002H7.39999L9 13.7145L10.6 16.0002H13L10.2 12.0002Z" fill="rgba(39,157,81,1)">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                        <br>
                                                        <a href="{{ route('sampel', $futami->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data sampel</a>

                                                    </form>

                                                </td>
                                            </tr>

                                            @empty
                                                <tr>
                                                  <td class="text-center h5" colspan="8">Not Found</td>
                                                </tr>
                                        @endforelse

                                      </table>
                                      {{ $futamis->links('pagination::bootstrap-4') }}
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
