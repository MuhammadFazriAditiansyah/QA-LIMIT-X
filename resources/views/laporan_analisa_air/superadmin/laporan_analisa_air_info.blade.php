@extends('layout-admin')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                            @if(Session::get('successLogin'))
                                <div class="alert alert-success w-70">
                                    {{Session::get('successLogin')}}
                                </div>
                            @endif

                            @if(Session::get('notAllowed'))
                                <div class="alert alert-danger w-70">
                                    {{Session::get('notAllowed')}}
                                </div>
                            @endif
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

        </div>
        <div class="content-wrapper" style="margin-top: -43%;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Data Laporan Analisa Air</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid" >
                <div class="row">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Data Analisa kimia</h3> --}}
                            {{-- <br> --}}

                            {{-- <button type="button" class="btn btn-danger btn-block btn-sm"><i class="fa fa-bell"></i> Back</button> --}}
                            <a href="/admin" class="btn btn-danger btn-sm" style="width:auto; text-align:center;"><i class="fa fa-house"></i> Back</a>

                            <a href="/superadmin/laporan_analisa_air/history" class="btn btn-primary btn-sm" style="width:auto; text-align:center; float:right;"><i class="fa fa-history"></i> History</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body shadow">
                            <table id="example1" class="table-responsive table-bordered table-striped" style="margin-bottom:2%;">
                                <thead>
                                    <tr>
                                        <th class="p-2" align="center">No</th>
                                        <th class="p-2" align="center">No.Dokumen</th>
                                        <th class="p-2" align="center">Tgl. Sampling</th>
                                        <th class="p-2" align="center">TTD Operator</th>
                                        <th class="p-2" align="center">TTD Staff</th>
                                        <th class="p-2" align="center">TTD Supervisor</th>
                                        <th class="p-2" style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan_analisa_air as $analisa_air)
                                        <tr>
                                            <td align="center">{{$loop->iteration}}</td>
                                            <td align="center">{{$analisa_air->nodokumen}}</td>
                                            <td align="center">{{Carbon\Carbon::parse($analisa_air->tgl_sampling)->translatedFormat('d F Y')}}</td>
                                            <td align="center">
                                                @if($analisa_air['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$analisa_air['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form> --}}
                                                    Data Belum Ditandatangan

                                                @elseif($analisa_air['statusOP'] == 1)
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($analisa_air->user_id_OP ."_". $analisa_air->name_id_OP)) !!}" alt="">
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($analisa_air['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$analisa_air['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>

                                                    <form action="/declinettd/{{$analisa_air['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    Data Belum Ditandatangan


                                                @elseif($analisa_air['statusST'] == 1)
                                                    {{-- {!! QrCode::size(50)->generate($analisa_air->nodokumen) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($analisa_air->user_id_ST ."_". $analisa_air->name_id_ST)) !!}" alt="">

                                                @elseif($analisa_air['statusST'] == 2)
                                                    <div class="alert alert-danger" style="width: 100px;">Ditolak</div>
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($analisa_air['statusSP'] == 0)
                                                {{-- <form action="/supervisorttd/{{$analisa_air['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data belum ditandatangan

                                              @elseif($analisa_air['statusSP'] == 1)
                                                {{-- {!! QrCode::size(50)->generate($analisa_air->nodokumen) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($analisa_air->user_id_SP ."_". $analisa_air->name_id_SP)) !!}" alt="">

                                              @endif
                                            </td>
                                            <td align="center" style="justify-content:center; padding-left:10px;">
                                                <div class="d-flex">
                                                    <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('SA_laporan_analisa_air_pdf', $analisa_air->id)}}"></a>
                                                    <a class="fa-solid fa-file-excel ml-1 btn" target="_blank" href="{{route('laporan_analisa_air_excel_show', $analisa_air->id)}}"></a>
                                                </div>

                                                <a href="{{ route('superadmin_laporan_analisa_air_sampel', $analisa_air->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
                                            </td>
                                        </tr>
                                            @empty
                                            <tr>
                                                <td class="text-center h5" colspan="8">Not Found</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- <a href="/admin" class="btn btn-danger" style="width:20%; text-align:center; margin-left:78%; margin-top:3%;">Back</a> --}}
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
@endsection

