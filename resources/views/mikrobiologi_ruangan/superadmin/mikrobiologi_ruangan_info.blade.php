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
                        <h1>Data Analisa Mikrobiologi Ruangan</h1>
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

                            <a href="/superadmin/mikrobiologi_ruangan/history" class="btn btn-primary btn-sm" style="width:auto; text-align:center; float:right;"><i class="fa fa-history"></i> History</a>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body shadow">
                            <table id="example1" class="table-responsive table-bordered table-striped" style="margin-bottom:2%;">
                                <thead>
                                    <tr>
                                        <th class="p-2">No</th>
                                        <th class="p-2">No.Dokumen</th>
                                        <th class="p-2">Tanggal Inokulasi</th>
                                        {{-- <th class="p-2">Tanggal Pengamatan</th> --}}
                                        <th class="p-2">TTD Operator</th>
                                        <th class="p-2">TTD Staff</th>
                                        <th class="p-2">TTD Supervisor</th>
                                        <th class="p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mikrobiologi_ruangan as $ruangan)
                                        <tr>
                                            <td align="center">{{++$no}}</td>
                                            <td>{{$ruangan->nodokumen}}</td>
                                            <td>{{Carbon\Carbon::parse($ruangan->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                            {{-- <td>{{Carbon\Carbon::parse($ruangan->tgl_pengamatan)->translatedFormat('d F Y')}}</td>                   --}}
                                            <td align="center">
                                                @if($ruangan['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$ruangan['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form> --}}
                                                    Data Belum Ditandatangan

                                                @elseif($ruangan['statusOP'] == 1)
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($ruangan->user_id_OP ."_". $ruangan->name_id_OP)) !!}" alt="">
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($ruangan['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$ruangan['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>

                                                    <form action="/declinettd/{{$ruangan['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    Data Belum Ditandatangan


                                                @elseif($ruangan['statusST'] == 1)
                                                    {{-- {!! QrCode::size(50)->generate($ruangan->nodokumen) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($ruangan->user_id_ST ."_". $ruangan->name_id_ST)) !!}" alt="">

                                                @elseif($ruangan['statusST'] == 2)
                                                    <div class="alert alert-danger">Ditolak</div>
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($ruangan['statusSP'] == 0)
                                                {{-- <form action="/supervisorttd/{{$ruangan['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data belum ditandatangan

                                              @elseif($ruangan['statusSP'] == 1)
                                                {{-- {!! QrCode::size(50)->generate($ruangan->nodokumen) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($ruangan->user_id_SP ."_". $ruangan->name_id_SP)) !!}" alt="">

                                              @endif
                                            </td>
                                            <td align="center" style="justify-content:center; padding-left:10px;">
                                                <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('SA_mikrobiologi_ruangan_pdf', $ruangan->id)}}"></a>
                                                <a class="fa-solid fa-file-excel ml-1 btn" target="_blank" href="{{route('mikrobiologi_ruangan_excel_show', $ruangan->id)}}"></a>

                                                <a href="{{ route('superadmin_mikrobiologi_ruangan_sampel', $ruangan->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
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

