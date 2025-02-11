@extends('layout-operator')
@section('content')


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Data Parameter Pengujian</h1>
                    </div>






                    <div class="section-body" style="margin-top: -20px;">
                        {{-- <h2 class="section-title">Tambah Data Parameter</h2> --}}
                        <div class="row">
                            <div class="col-6">
                                <h2 class="section-title">Tambah Data Parameter</h2>

                                <div class="card shadow">
                                    {{-- ===================== alert ====================== --}}
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
                                        @if(Session::get('successAdd'))
                                            <div class="alert alert-success w-30">
                                                {{Session::get('successAdd')}}
                                            </div>
                                        @endif

                                    {{-- ===================== end alert ====================== --}}







                                    <form action="{{ route('parameter.post') }}" method="POST">
                                        @csrf

                                        <div class="card-body">
                                            <h6 for="parameter" style="text-align:center;">Parameter Uji</h6>
                                            <div class="form-row d-flex justify-content-center align-items-center">
                                                <div class="form-group col-md-12" align="center">
                                                    <input type="text" name="parameter" class="form-control" id="parameter" placeholder="Input Parameter Baru ...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="margin-top:-10px;">
                                            <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-3%;">Save</button>
                                            <a href="/operator" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-13%;">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>


        {{-- ========================================== Satuan Card =========================================== --}}
                            <div class="col-6">
                                <h2 class="section-title">Tambah Data Satuan</h2>

                                <div class="card shadow">
                                    {{-- ===================== alert ====================== --}}
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
                                        @if(Session::get('successAddSatuan'))
                                            <div class="alert alert-success w-30">
                                                {{Session::get('successAddSatuan')}}
                                            </div>
                                        @endif

                                    {{-- ===================== end alert ====================== --}}







                                    <form action="{{ route('satuan.post') }}" method="POST">
                                        @csrf

                                        <div class="card-body">
                                            <h6 for="satuan" style="text-align:center;">Satuan</h6>
                                            <div class="form-row d-flex justify-content-center align-items-center">
                                                <div class="form-group col-md-12" align="center">
                                                    <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Input Satuan Baru ...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="margin-top:-10px;">
                                            <button class="btn btn-success" style="width:30%; text-align:center; margin-left:70%; margin-top:-3%;">Save</button>
                                            <a href="/operator" class="btn btn-primary" style="width:30%; text-align:center; margin-top:-13%;">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>








                    <div class="section-body">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="section-title">Data Parameter Uji</h2>
                                <div class="card shadow">
                                    @if(Session::get('successDelete'))
                                        <div class="alert alert-danger w-70">
                                            {{Session::get('successDelete')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successUpdateParameter'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successUpdateParameter')}}
                                        </div>
                                    @endif

                                    @if(Session::get('operatorttd'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('operatorttd')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successAddSampel'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successAddSampel')}}
                                        </div>
                                    @endif





                                    <div class="card-body mt-3 shadow" style="overflow: auto; max-height:500px;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th scope="col" align="center" style="text-align:center;">No</th>
                                                    <th scope="col" align="center" style="text-align:center;">Parameter</th>
                                                    <th scope="col" align="center" style="text-align:center;">Action</th>
                                                </tr>
                                                <tr>
                                                    @forelse ($parameters as $param)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>{{ $param->parameter }}</td>
                                                            <td style="text-align:center;">
                                                                <form action="{{route('parameterDestroy', $param['id'])}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                                    <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('editParameter', $param->id)}}"></a>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                    @empty
                                                        <tr>
                                                            <td class="text-center h5" colspan="15">Not Found</td>
                                                        </tr>
                                                    @endforelse
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>




    {{-- ========================================= Data Satuan ======================================== --}}
                            <div class="col-6">
                                <h2 class="section-title">Data Satuan</h2>

                                <div class="card shadow">
                                    @if(Session::get('successDeleteSatuan'))
                                        <div class="alert alert-danger w-70">
                                            {{Session::get('successDeleteSatuan')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successUpdateSatuan'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successUpdateSatuan')}}
                                        </div>
                                    @endif

                                    @if(Session::get('operatorttd'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('operatorttd')}}
                                        </div>
                                    @endif

                                    @if(Session::get('successAddSampel'))
                                        <div class="alert alert-success w-70">
                                            {{Session::get('successAddSampel')}}
                                        </div>
                                    @endif





                                    <div class="card-body mt-3 shadow" style="overflow: auto; max-height:500px;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-md">
                                                <tr>
                                                    <th scope="col" align="center" style="text-align:center;">No</th>
                                                    <th scope="col" align="center" style="text-align:center;">Satuan</th>
                                                    <th scope="col" align="center" style="text-align:center;">Action</th>
                                                </tr>
                                                <tr>
                                                    @forelse ($satuan as $satuan)
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration }}</th>
                                                            <td>{{ $satuan->satuan }}</td>
                                                            <td style="text-align: center;">
                                                                <form action="{{route('satuanDestroy', $satuan['id'])}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="text-danger btn"><i class="fa-solid fa-trash"></i></button>

                                                                    <a class="fa-solid fa-pen-to-square text-success btn" href="{{route('editSatuan', $satuan->id)}}"></a>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                    @empty
                                                        <tr>
                                                            <td class="text-center h5" colspan="15">Not Found</td>
                                                        </tr>
                                                    @endforelse
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                </section>
            </div>




@endsection
