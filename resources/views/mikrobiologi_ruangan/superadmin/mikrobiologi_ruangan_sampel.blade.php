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






                    </div><!-- /.col -->
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div> --}}
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    </div>
    <div class="content-wrapper" style="margin-top: -43%; ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Data Area Analisa Mikrobiologi Ruangan</h1>
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
                        {{-- <h3 class="card-title">Data Sampel Analisa kimia</h3> --}}
                        {{-- <br> --}}

                        <a href="/superadmin/mikrobiologi_ruangan/info" class="btn btn-danger btn-sm" style="width:auto; text-align:center;"><i class="fa fa-house"></i> Back</a>

                        {{-- <a href="/admin/analisakimia/history" class="btn btn-primary btn-sm" style="width:10%; text-align:center; float:right;">History</a> --}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body shadow">
                        <table id="example1" class="table table-bordered table-striped" style="margin-bottom:2%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Area</th>
                                    <th>TPC ({{$mikrobiologi_ruangan->satuan_tpc}})</th>
                                    <th>Yeast & Mold ({{$mikrobiologi_ruangan->satuan_yeast_mold}})</th>
                                    <th>Keterangan (Optional)</th>
                                    {{-- <th align="center">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sampel_mikrobiologi_ruangan as $ruangan)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $ruangan->area }}</td>
                                        <td>{{ $ruangan->tpc }}</td>
                                        <td>{{ $ruangan->yeast_mold }}</td>
                                        <td>{{ $ruangan->keterangan }}</td>
                                        {{-- <td>
                                            <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('superadmin_analisakimiapdf', $ruangan->id)}}"></a>
                                            <a href="{{ route('mikrobiologi_sampel', $ruangan->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
                                        </td> --}}
                                    </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center h5" colspan="5">Not Found</td>
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
