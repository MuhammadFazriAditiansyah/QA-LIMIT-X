@extends('layout-admin')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ganti Password</h1>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <section class="content mt-3">
                <div class="container-fluid">
                    <center>
                        <div class="col justify-content-center">
                            <!-- left column -->
                            <div class="col-md-6" style="width: auto;">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" class="needs-validation" action="{{ route('superadmin_password.update', Auth::user()->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    @if ($errors->any())
                                        {{-- alert kalau tidak di isi, akan muncul alert denger  --}}
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if(Session::get('successUpdate'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successUpdate')}}
                                        </div>
                                    @endif


                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <!-- text input -->
                                                <div class="form-group">
                                                    <label>Password Update</label>
                                                    <input type="text" name="password" class="form-control" required="">
                                                    <div class="invalid-feedback">
                                                        Kolom ini harus di isi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                                        <a href="/superadmin/profile" class="btn btn-danger float-left">Kembali</a>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                            </div>
                            <!--/.col (right) -->
                        </div>
                    </center>
                <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.col -->
            {{-- </div> --}}
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
