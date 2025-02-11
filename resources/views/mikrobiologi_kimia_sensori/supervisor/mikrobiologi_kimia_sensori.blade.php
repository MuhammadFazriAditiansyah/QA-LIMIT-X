@extends('layout-operator')
@section('content')


<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pemeriksaan Kimia Dan Sensori</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Data Pemeriksaan Kimia Dan Sensori</h2>
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
                        <div class="alert alert-danger w-70">
                            {{Session::get('successUpdate')}}
                        </div>
                        @endif

                        @if(Session::get('supervisorttd'))
                        <div class="alert alert-success w-70">
                            {{Session::get('supervisorttd')}}
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
                                        <th>Tanggal Produksi</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Batch</th>
                                        <th>TTD Operator</th>
                                        <th>TTD Staff</th>
                                        <th>TTD Qa Product Release</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($mikrobiologi_kimia_sensori as $kimia_sensori)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$kimia_sensori->nodokumen}}</td>
                                            <td>{{Carbon\Carbon::parse($kimia_sensori->tgl_produksi)->translatedFormat('d F Y')}}</td>
                                            <td>{{$kimia_sensori->nama_produk}}</td>
                                            <td>{{$kimia_sensori->jumlah_batch}}</td>
                                            <td align="center">
                                                @if($kimia_sensori['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$kimia_sensori['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form> --}}
                                                    Data Belum Ditandatangani

                                                    @elseif($kimia_sensori['statusOP'] == 1)
                                                    {{-- {!! QrCode::size(100)->generate($kimia_sensori->user_id_OP ."_". $kimia_sensori->name_id_OP) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($kimia_sensori->user_id_OP ."_". $kimia_sensori->name_id_OP)) !!}" alt="">

                                                @endif
                                            </td>
                                            <td>
                                                @if($kimia_sensori['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$kimia_sensori['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>

                                                    <form action="/declinettd/{{$kimia_sensori['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    <p>Data Belum Ditandatangani</p>


                                                @elseif($kimia_sensori['statusST'] == 1)
                                                    {{-- {!! QrCode::size(80)->generate($kimia_sensori->user_id_ST ."_". $kimia_sensori->name_id_ST) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($kimia_sensori->user_id_ST ."_". $kimia_sensori->name_id_ST)) !!}" alt="">


                                                @elseif($kimia_sensori['statusST'] == 2)
                                                    <div class="alert alert-danger">Ditolak</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($kimia_sensori['statusSP'] == 0)
                                                <form action="/supervisor/mikrobiologi_kimia_sensori/ttd/{{$kimia_sensori['id']}}" method="POST" class="text-center">
                                                    @csrf
                                                    @method('PATCH')

                                                    <div class="form-group col-md-1">
                                                        <input type="date" name="ttd_qaleader" class="form-control" style="width:120px;">
                                                    </div>

                                                    <button type="submit" class="btn btn-success btn">TTD</button>

                                                    {{-- <button type="submit" class="badge badge-success btn">TTD</button> --}}

                                                </form>


                                              @elseif($kimia_sensori['statusSP'] == 1)
                                                {{-- {!! QrCode::size(80)->generate($kimia_sensori->user_id_SP ."_". $kimia_sensori->name_id_SP) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($kimia_sensori->user_id_SP ."_". $kimia_sensori->name_id_SP)) !!}" alt="">

                                              @endif
                                            </td>
                                            <td>
                                                <form action="{{route('delete', $kimia_sensori['id'])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>
                                                    <br>
                                                    <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('edit', $kimia_sensori->id)}}"></a>
                                                    <br>--}}

                                                    {{-- <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('supervisor_analisakimiapdf', $kimia_sensori->id)}}"></a> --}}
                                                    <a href="{{route('SP_mikrobiologi_kimia_sensori_pdf', $kimia_sensori->id)}}" target="_blank"><i class="fa-solid fa-file-pdf ml-1 fa-lg"></i></a>

                                                    <a target="_blank" href="{{route('mikrobiologi_kimia_sensori_excel_show', $kimia_sensori->id)}}">
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
                                {{ $mikrobiologi_kimia_sensori->links('pagination::bootstrap-4') }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
