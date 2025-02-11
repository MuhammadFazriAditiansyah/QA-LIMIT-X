@extends('layout-admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add User</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    {{-- <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Data User</h3>
                        </div>

                        <form>
                            <div class="col-md-12 card-body">
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div> --}}
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Data User</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('user.post') }}" method="POST">
                                    @csrf
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

                                    @if (Session::get('createUser'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('createUser') }}
                                        </div>
                                    @endif

                                    @if (Session::get('successDelete'))
                                        <div class="alert alert-danger w-70">
                                            {{ Session::get('successDelete') }}
                                        </div>
                                    @endif

                                    @if (Session::get('successUpdate'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('successUpdate') }}
                                        </div>
                                    @endif

                                    @if (Session::get('successReset'))
                                        <div class="alert alert-success w-70">
                                            {{ Session::get('successReset') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="nama" class="form-control"
                                                    placeholder="Masukkan Nama Lengkap">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No.Handphone</label>
                                                <input type="number" name="nohp" class="form-control"
                                                    placeholder="Masukkan No.Handphone">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Masukkan Email Address">
                                            </div>
                                        </div>
                                        {{-- <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="Masukkan Password">
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Pilih Jenis Jabatan</label>
                                                <select class="form-control" name="jabatan">
                                                    <option hidden>-- Pilih Jenis Jabatan --</option>

                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- textarea -->
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="alamat" rows="1"placeholder="Masukkan Alamat"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: -4%;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data User</h1>
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
                                <h3 class="card-title">DataTable User</h3>

                                <!-- Form Live Search -->
                                <div class="form-inline" style="float: right">
                                    <div class="input-group">
                                        <input type="search" name="live_search" id="live_search"
                                            class="form-control form-control-sidebar" placeholder="Search . . ."
                                            aria-label="Search">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body shadow">
                                <table id="example1" class="table table-bordered table-striped" style="margin-bottom:2%;">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>No.Handphone</th>
                                            <th>Email Address</th>
                                            {{-- <th>Password</th> --}}
                                            <th>Jabatan</th>
                                            <th>Alamat</th>
                                            {{-- <th>Status</th> --}}
                                            <th style="width:80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="alldata">
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->nohp }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    {{-- {{$user->jabatan}} --}}
                                                    @if ($user->jabatan == 1)
                                                        Operator
                                                    @elseif($user->jabatan == 2)
                                                        Staff
                                                    @elseif($user->jabatan == 3)
                                                        Supervisor
                                                    @elseif($user->jabatan == 4)
                                                        Super Admin
                                                    @endif

                                                </td>
                                                <td>{{ $user->alamat }}</td>
                                                {{-- <td>{{ isActiveUser($user->id) }}</td> --}}

                                                {{-- <td>{{ getStatus($user->id) }}</td> --}}
                                                <td align="center">
                                                    {{-- <form action="{{route('user.delete', $user['id'])}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                        <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('user.edit', $user->id)}}">

                                                    </form>
                                                    <br>
                                                    <form action="{{route('user.reset', $user['id'])}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="text-danger btn"><i class="ri-shield-keyhole-fill"></i></button>

                                                    </form> --}}

                                                    <form id="deleteForm{{ $user->id }}"
                                                        action="{{ route('user.delete', $user['id']) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger btn"><i
                                                                class="fa-solid fa-trash"></i></button>
                                                    </form>

                                                    <form id="editForm{{ $user->id }}"
                                                        action="{{ route('user.edit', $user->id) }}" method="GET">
                                                        <button class="fa-solid fa-pen-to-square text-success btn"></button>
                                                    </form>

                                                    <form id="resetForm{{ $user->id }}"
                                                        action="{{ route('user.reset', $user['id']) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="text-danger btn"><i
                                                                class="ri-shield-keyhole-fill"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tbody id="Content" class="data_live_search"></tbody>
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



    <script>
        $('#live_search').on('keyup', function() {
            $value = $(this).val();

            if ($value) {
                $('.alldata').hide();
                $('.data_live_search').show();

            } else {
                $('.alldata').show();
                $('.data_live_search').hide();
            }

            $.ajax({
                type: "GET",
                url: '{{ route('search') }}',
                data: {
                    'live_search': $value
                },
                cache: false, //disabled cache, agar tidak ada tanda tanya ketika melakukan search ajax dan editnya
                // success: function(data){
                //     console.log(data);
                //     $('#Content').html(data);
                // }
                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);

                    // Reattach form submit events
                    $('.delete-form').each(function() {
                        var formId = $(this).attr('id');
                        $('#' + formId).submit(function(event) {
                            event.preventDefault();
                            if (confirm('Are you sure you want to delete this user?')) {
                                $('#' + formId).unbind('submit').submit();
                            }
                        });
                    });

                    $('.edit-form').each(function() {
                        var formId = $(this).attr('id');
                        $('#' + formId).click(function(event) {
                            event.preventDefault();
                            window.location.href = $(this).attr('action');
                        });
                    });

                    $('.reset-form').each(function() {
                        var formId = $(this).attr('id');
                        $('#' + formId).submit(function(event) {
                            event.preventDefault();
                            if (confirm(
                                    'Are you sure you want to reset this user\'s password?'
                                    )) {
                                $('#' + formId).unbind('submit').submit();
                            }
                        });
                    });
                }

            });
        })
    </script>




@endsection
