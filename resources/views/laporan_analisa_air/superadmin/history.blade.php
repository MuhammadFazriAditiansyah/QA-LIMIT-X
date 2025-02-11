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
        <div class="content-wrapper" style="margin-top: -42%;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>History Laporan Analisa Air</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/superadmin/laporan_analisa_air/info" class="btn btn-danger" style="width:auto; text-align:center; ">Back</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="margin-bottom:2%;">
                                <thead>
                                    <tr>
                                        <th align="center">No</th>
                                        <th align="center">No.Dokumen</th>
                                        <th align="center">Tgl. Sampling</th>
                                        <th align="center">TTD Operator</th>
                                        <th align="center">TTD Staff</th>
                                        <th align="center">TTD Supervisor</th>
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
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->generate($analisa_air->user_id_OP ."_". $analisa_air->name_id_OP)) !!}" alt="">
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
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->generate($analisa_air->user_id_ST ."_". $analisa_air->name_id_ST)) !!}" alt="">

                                                @elseif($analisa_air['statusST'] == 2)
                                                    <div class="alert alert-danger">Ditolak</div>
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
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(50)->generate($analisa_air->user_id_SP ."_". $analisa_air->name_id_SP)) !!}" alt="">

                                            @endif
                                            </td>
                                            {{-- <td>
                                                <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('superadmin_mikrobiologi_pdf', $analisa_air->id)}}"></a>

                                                <a href="{{ route('superadmin_mikrobiologi_sampel', $analisa_air->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
                                            </td> --}}
                                        </tr>
                                            @empty
                                            <tr>
                                                <td class="text-center h5" colspan="10">Not Found</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
