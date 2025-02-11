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
                    <h1>Data Pemeriksaan Kimia Dan Sensori</h1>
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

                        <a href="/superadmin/mikrobiologi_kimia_sensori/info" class="btn btn-danger btn-sm" style="width:auto; text-align:center;"><i class="fa fa-house"></i> Back</a>

                        {{-- <a href="/admin/analisakimia/history" class="btn btn-primary btn-sm" style="width:10%; text-align:center; float:right;">History</a> --}}

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body shadow" style="overflow-x:auto;">
                        <table id="example1" class="table table-bordered table-striped" style="margin-bottom:2%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Sampling</th>
                                    <th>Waktu</th>
                                    <th>Exp Date</th>

                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c1 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c1 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c1 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c2 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c2 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c2 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c3 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c3 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c3 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c4 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c4 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c4 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c5 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c5 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c5 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c6 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c6 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c6 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c7 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c7 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c7 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c8 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c8 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c8 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c9 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c9 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c9 }})</sup>
                                        @endif
                                    </th>
                                    <th>
                                        {{ $mikrobiologi_kimia_sensori->parameter_c10 }}
                                        @if ($mikrobiologi_kimia_sensori->satuan_c10 != null)
                                            <sup>({{ $mikrobiologi_kimia_sensori->satuan_c10 }})</sup>
                                        @endif
                                    </th>
                                    {{-- <th>Keterangan</th> --}}
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sampel_mikrobiologi_kimia_sensori as $kimia_sensori)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $kimia_sensori->kode_sampling }}</td>
                                        <td>{{ Carbon\carbon::parse($kimia_sensori->waktu)->translatedFormat('h:i') }}</td>
                                        <td>{{ Carbon\carbon::parse($kimia_sensori->exp_date)->translatedFormat('h:i') }}</td>
                                        <td>{{ $kimia_sensori->parameter_c1 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c2 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c3 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c4 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c5 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c6 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c7 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c8 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c9 }}</td>
                                        <td>{{ $kimia_sensori->parameter_c10 }}</td>
                                        {{-- <td>{{ $kimia_sensori->keterangan }}</td> --}}
                                        {{-- <td>
                                            <a class="fa-solid fa-file-pdf ml-1 btn" target="_blank" href="{{route('superadmin_analisakimiapdf', $kimia_sensori->id)}}"></a>
                                            <a href="{{ route('mikrobiologi_sampel', $kimia_sensori->id) }}" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-table"></i> Data</a>
                                        </td> --}}
                                    </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center h5" colspan="15">Not Found</td>
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
