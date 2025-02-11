@extends('layout-admin')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>History Analisa Kimia</h1>
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
                        <h3 class="card-title">Data Analisa kimia</h3>
                        <a href="/admin/info" class="btn btn-danger" style="width:20%; text-align:center; margin-left:78%; margin-top:-3%;">Back</a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped" style="margin-bottom:2%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No.Dokumen</th>
                                    <th>Pemberi sampel</th>
                                    <th>Tanggal terima sampel</th>
                                    <th>Tanggal selesai uji</th>
                                    <th>TTD Operator</th>
                                    <th>TTD Staff</th>
                                    <th>TTD Supervisor</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($futamis as $futami)
                                    <tr>
                                        <td>{{++$no}}</td>
                                        <td>{{$futami->nodokumen}}</td>
                                        <td>{{$futami->pemberi_sampel}}</td>
                                        <td>{{Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d F Y')}}</td>
                                        {{-- <td>{{Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d F Y')}}</td> --}}
                                        <td>{{Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d F Y')}}</td>
                                        <td>
                                            @if($futami['statusOP'] == 0)
                                                {{-- <form action="/operatorttd/{{$futami['id']}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="badge badge-success btn">TTD</button>

                                                </form> --}}
                                                Data Belum Ditandatangan
                                            
                                            @elseif($futami['statusOP'] == 1)
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($futami->user_id_OP ."_". $futami->name_id_OP)) !!}" alt="">
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
                                                
                                                Data Belum Ditandatangan


                                            @elseif($futami['statusST'] == 1)
                                                {{-- {!! QrCode::size(50)->generate($futami->nodokumen) !!} --}}
                                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($futami->user_id_ST ."_". $futami->name_id_ST)) !!}" alt="">

                                            @elseif($futami['statusST'] == 2)
                                                <div class="alert alert-danger">Data Ditolak</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($futami['statusSP'] == 0)
                                            {{-- <form action="/supervisorttd/{{$futami['id']}}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="badge badge-success btn">TTD</button>

                                            </form> --}}
                                            Data belum ditandatangan 

                                        @elseif($futami['statusSP'] == 1)
                                            {{-- {!! QrCode::size(50)->generate($futami->nodokumen) !!} --}}
                                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(80)->generate($futami->user_id_SP ."_". $futami->name_id_SP)) !!}" alt="">

                                        @endif
                                        </td>
                                        <td>
                                            <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('analisakimiapdf', $futami->id)}}"></a>
                                        </td>
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