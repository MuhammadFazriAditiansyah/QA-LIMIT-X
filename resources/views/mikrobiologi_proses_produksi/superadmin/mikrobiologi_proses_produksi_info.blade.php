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
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h1>Data Analisa Mikrobiologi Proses Produksi</h1>
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

                            <a href="/superadmin/mikrobiologi_proses_produksi/history" class="btn btn-primary btn-sm" style="width:auto; text-align:center; float:right;"><i class="fa fa-history"></i> History</a>

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
                                    @forelse ($mikrobiologi_proses_produksi as $proses_produksi)
                                        <tr>
                                            <td align="center">{{++$no}}</td>
                                            <td>{{$proses_produksi->nodokumen}}</td>
                                            <td>{{Carbon\Carbon::parse($proses_produksi->tgl_inokulasi)->translatedFormat('d F Y')}}</td>
                                            {{-- <td>{{Carbon\Carbon::parse($proses_produksi->tgl_pengamatan)->translatedFormat('d F Y')}}</td>                         --}}
                                            <td align="center">
                                                @if($proses_produksi['statusOP'] == 0)
                                                    {{-- <form action="/operatorttd/{{$proses_produksi['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form> --}}
                                                    Data Belum Ditandatangan

                                                @elseif($proses_produksi['statusOP'] == 1)
                                                    <img style="margin:3px;" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($proses_produksi->user_id_OP ."_". $proses_produksi->name_id_OP)) !!}" alt="">
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($proses_produksi['statusST'] == 0)
                                                    {{-- <form action="/staffttd/{{$proses_produksi['id']}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-success btn">TTD</button>

                                                    </form>

                                                    <form action="/declinettd/{{$proses_produksi['id']}}" method="POST" style="margin-top:5%;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="badge badge-danger btn">Tolak</button>

                                                    </form> --}}

                                                    Data Belum Ditandatangan


                                                @elseif($proses_produksi['statusST'] == 1)
                                                    {{-- {!! QrCode::size(50)->generate($proses_produksi->nodokumen) !!} --}}
                                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($proses_produksi->user_id_ST ."_". $proses_produksi->name_id_ST)) !!}" alt="">

                                                @elseif($proses_produksi['statusST'] == 2)
                                                    <div class="alert alert-danger">Ditolak</div>
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($proses_produksi['statusSP'] == 0)
                                                {{-- <form action="/supervisorttd/{{$proses_produksi['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data belum ditandatangan

                                              @elseif($proses_produksi['statusSP'] == 1)
                                                {{-- {!! QrCode::size(50)->generate($proses_produksi->nodokumen) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($proses_produksi->user_id_SP ."_". $proses_produksi->name_id_SP)) !!}" alt="">

                                              @endif
                                            </td>
                                            <td align="center" style="justify-content:center;">
                                                <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('SA_mikrobiologi_proses_produksi_pdf', $proses_produksi->id)}}"></a>
                                                <a class="fa-solid fa-file-excel ml-1 btn" target="_blank" href="{{route('mikrobiologi_proses_produksi_excel_show', $proses_produksi->id)}}"></a>

                                                <a href="{{ route('superadmin_mikrobiologi_proses_produksi_sampel', $proses_produksi->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Sampel</a>
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

