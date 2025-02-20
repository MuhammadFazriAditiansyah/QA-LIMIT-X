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
                    <h1>Data: {{$sampel_null->sampel}}</h1>
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

                            <a href="/superadmin/laporan_analisa_air/sampel/{{ $id }}" class="btn btn-danger btn-sm"style="width:auto; text-align:center;"><i class="fa fa-house"></i> Back</a>

                            {{-- <a href="/admin/analisakimia/history" class="btn btn-primary btn-sm" style="width:10%; text-align:center; float:right;">History</a> --}}

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body shadow" style="overflow-x:auto;">
                            <table class="table table-striped">
                                <tr>
                                    <td style="font-weight: bold;">Pengujian</td>
                                    <td style="font-weight: bold;">Shift 1</td>
                                    <td style="font-weight: bold;">Shift 2</td>
                                    <td style="font-weight: bold;">Keterangan</td>
                                </tr>
                                @forelse ($sampel_laporan_analisa_air as $sampel)
                                    <tr>
                                        <td>{{ $sampel->pengujian }}</td>
                                        <td>{{ $sampel->shift_1 }}</td>
                                        <td>{{ $sampel->shift_2 }}</td>
                                        <td>{{ $sampel->keterangan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" align="center">Data Not found</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>

                </div>



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
