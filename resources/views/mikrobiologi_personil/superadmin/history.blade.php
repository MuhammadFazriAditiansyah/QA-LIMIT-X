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
                        <h1>History Analisa Mikrobiologi Personil</h1>
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
                            <a href="/superadmin/mikrobiologi_personil/info" class="btn btn-danger" style="width:auto; text-align:center; ">Back</a>

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
                                    @forelse ($mikrobiologi_personil as $personil)
                                        <tr>
                                            <td>{{++$no}}</td>
                                            <td>{{$personil->nodokumen}}</td>
                                            <td>{{Carbon\Carbon::parse($personil->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                            {{-- <td>{{Carbon\Carbon::parse($personil->tgl_pengamatan)->translatedFormat('d F Y')}}</td>                                            <td>{{Carbon\Carbon::parse($personil->tanggal_uji)->translatedFormat('d F Y')}}</td> --}}
                                            <td align="center">
                                                @if($personil['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$personil['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form> --}}
                                                    Data Belum Ditandatangan

                                                @elseif($personil['statusOP'] == 1)
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($personil->user_id_OP ."_". $personil->name_id_OP)) !!}" alt="">
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($personil['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$personil['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>

                                                    <form action="/declinettd/{{$personil['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    Data Belum Ditandatangan


                                                @elseif($personil['statusST'] == 1)
                                                    {{-- {!! QrCode::size(50)->generate($personil->nodokumen) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($personil->user_id_ST ."_". $personil->name_id_ST)) !!}" alt="">

                                                @elseif($personil['statusST'] == 2)
                                                    <div class="alert alert-danger">Ditolak</div>
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($personil['statusSP'] == 0)
                                                {{-- <form action="/supervisorttd/{{$personil['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data belum ditandatangan

                                            @elseif($personil['statusSP'] == 1)
                                                {{-- {!! QrCode::size(50)->generate($personil->nodokumen) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($personil->user_id_SP ."_". $personil->name_id_SP)) !!}" alt="">

                                            @endif
                                            </td>
                                            {{-- <td>
                                                <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('superadmin_mikrobiologi_pdf', $personil->id)}}"></a>

                                                <a href="{{ route('superadmin_mikrobiologi_sampel', $personil->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
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
