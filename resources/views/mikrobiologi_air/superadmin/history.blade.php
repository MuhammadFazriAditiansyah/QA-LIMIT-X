@extends('layout-admin')
@section('content')

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
                <div class="col-sm-6">
                    <h1>History Analisa Mikrobiologi Air</h1>
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
                        <a href="/superadmin/mikrobiologi/info" class="btn btn-danger" style="width:auto; text-align:center; ">Back</a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped" style="margin-bottom:2%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No.Dokumen</th>
                                    <th>Tanggal Inokulasi</th>
                                    {{-- <th>Tanggal Pengamatan</th> --}}
                                    <th>TTD Operator</th>
                                    <th>TTD Staff</th>
                                    <th>TTD Supervisor</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mikrobiologi_airs as $mikrobiologi_air)
                                    <tr>
                                        <td>{{++$no}}</td>
                                        <td>{{$mikrobiologi_air->nodokumen}}</td>
                                        <td>{{Carbon\Carbon::parse($mikrobiologi_air->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                        {{-- <td>{{Carbon\Carbon::parse($mikrobiologi_air->tgl_pengamatan)->translatedFormat('d F Y')}}</td>                                            <td>{{Carbon\Carbon::parse($mikrobiologi_air->tanggal_uji)->translatedFormat('d F Y')}}</td> --}}
                                        <td align="center">
                                            @if($mikrobiologi_air['statusOP'] == 0)
                                                {{-- <form action="/operatorttd/{{$mikrobiologi_air['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data Belum Ditandatangan

                                            @elseif($mikrobiologi_air['statusOP'] == 1)
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_air->user_id_OP ."_". $mikrobiologi_air->name_id_OP)) !!}" alt="">
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if($mikrobiologi_air['statusST'] == 0)
                                                {{-- <form action="/staffttd/{{$mikrobiologi_air['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form>

                                                <form action="/declinettd/{{$mikrobiologi_air['id']}}" method="POST" style="margin-top:5%;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                </form> --}}

                                                Data Belum Ditandatangan


                                            @elseif($mikrobiologi_air['statusST'] == 1)
                                                {{-- {!! QrCode::size(50)->generate($mikrobiologi_air->nodokumen) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_air->user_id_ST ."_". $mikrobiologi_air->name_id_ST)) !!}" alt="">

                                            @elseif($mikrobiologi_air['statusST'] == 2)
                                                <div class="alert alert-danger">Data Ditolak</div>
                                            @endif
                                        </td>
                                        <td align="center">
                                            @if($mikrobiologi_air['statusSP'] == 0)
                                            {{-- <form action="/supervisorttd/{{$mikrobiologi_air['id']}}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="badge badge-success btn">TTD</button>

                                            </form> --}}
                                            Data belum ditandatangan

                                        @elseif($mikrobiologi_air['statusSP'] == 1)
                                            {{-- {!! QrCode::size(50)->generate($mikrobiologi_air->nodokumen) !!} --}}
                                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($mikrobiologi_air->user_id_SP ."_". $mikrobiologi_air->name_id_SP)) !!}" alt="">

                                        @endif
                                        </td>
                                        {{-- <td>
                                            <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('superadmin_mikrobiologi_pdf', $mikrobiologi_air->id)}}"></a>

                                            <a href="{{ route('superadmin_mikrobiologi_sampel', $mikrobiologi_air->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
                                        </td> --}}
                                    </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center h5" colspan="8">Not Found</td>
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

