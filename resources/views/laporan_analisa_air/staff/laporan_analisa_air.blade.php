@extends('layout-operator')
@section('content')


   <!-- Main Content -->
   <div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Laporan Analisa Air</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Laporan Analisa Air</h2>
            {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

            <div class="row">
                <div class="col-12">
                    <div class="card">



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

                        @if(Session::get('staffttd'))
                            <div class="alert alert-success w-70">
                                {{Session::get('staffttd')}}
                            </div>
                        @endif

                        @if(Session::get('declinettd'))
                            <div class="alert alert-danger w-70">
                                {{Session::get('declinettd')}}
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

                        <div class="card-body mt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>No.Dokumen</th>
                                        <th>Tgl. Sampling</th>
                                        <th>TTD Operator</th>
                                        <th>TTD Staff</th>
                                        <th>TTD Supervisor</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                    @forelse ($laporan_analisa_air as $analisa_air)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$analisa_air->nodokumen}}</td>
                                        <td>{{Carbon\Carbon::parse($analisa_air->tgl_sampling)->translatedFormat('d F Y')}}</td>
                                        <td align="center">
                                            @if($analisa_air['statusOP'] == 0)
                                                {{-- <form action="/operatorttd/{{$analisa_air['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data Belum Ditandatangani


                                                @elseif($analisa_air['statusOP'] == 1)
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($analisa_air->user_id_OP .'_'. $analisa_air->name_id_OP)) !!}" alt="">

                                                {{-- {!! QrCode::size(80)->generate($analisa_air->user_id_OP ."_". $analisa_air->name_id_OP) !!} --}}
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if($analisa_air['statusST'] == 0)
                                                <form action="/staff/laporan_analisa_air/ttd/{{$analisa_air['id']}}" method="POST" class="text-center">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="form-group col-md-1">
                                                        <input type="date" name="ttd_staff" class="form-control" style="width:120px;">
                                                    </div>

                                                    <button type="submit" class="btn btn-success btn">TTD</button>
                                                </form>

                                                <form action="/staff/laporan_analisa_air/declinettd/{{$analisa_air['id']}}" method="POST" style="margin-top:5%;" class="text-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn">Tolak</button>
                                                </form>


                                            @elseif($analisa_air['statusST'] == 1)
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($analisa_air->user_id_ST ."_". $analisa_air->name_id_ST)) !!}" alt="">
                                            @elseif($analisa_air['statusST'] == 2)
                                                <div class="alert alert-danger">Ditolak</div>
                                            @endif

                                        </td>
                                        <td>
                                            @if($analisa_air['statusSP'] == 0)
                                            {{-- <form action="/supervisor/laporan_analisa_air/ttd/{{$analisa_air['id']}}" method="POST" class="text-center">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn">TTD</button>
                                            </form> --}}
                                            <p>Data Belum Ditandatangani</p>

                                            @elseif($analisa_air['statusSP'] == 1)
                                                {{-- {!! QrCode::size(70)->generate($analisa_air->user_id_SP ."_". $analisa_air->name_id_SP) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($analisa_air->user_id_SP ."_". $analisa_air->name_id_SP)) !!}" alt="">
                                            @endif
                                        </td>
                                        <td align="center" style="justify-content;center;">
                                            <form action="{{route('delete', $analisa_air['id'])}}" method="POST" style="text-center">
                                                @csrf
                                                @method('DELETE')
                                                {{-- <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                <br>
                                                <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit', $analisa_air->id)}}"></a>
                                                <br>--}}

                                                {{-- <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('staff_analisakimiapdf', $analisa_air->id)}}"></a> --}}
                                                <a href="{{route('ST_laporan_analisa_air_pdf', $analisa_air->id)}}" target="_blank"><i class="fa-solid fa-file-pdf ml-1 fa-lg"></i></a>

                                                <a target="_blank" href="{{route('laporan_analisa_air_excel_show', $analisa_air->id)}}">
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
                                          <td class="text-center h5" colspan="9">Not Found</td>
                                        </tr>
                                @endforelse
                                </table>
                                {{ $laporan_analisa_air->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection


