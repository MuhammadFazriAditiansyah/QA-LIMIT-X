@extends('layout-operator')
@section('content')


<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
                <div class="search-element">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    <div class="search-backdrop"></div>
                    <div class="search-result">
                        <div class="search-header">
                            Histories
                        </div>
                        <div class="search-item">
                            <a href="#">How to hack NASA using CSS</a>
                            <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="search-item">
                            <a href="#">Kodinger.com</a>
                            <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="search-item">
                            <a href="#">#Stisla</a>
                            <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                        </div>
                        <div class="search-header">
                            Result
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
                                oPhone S9 Limited Edition
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
                                Drone X2 New Gen-7
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
                                Headphone Blitz
                            </a>
                        </div>
                        <div class="search-header">
                            Projects
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <div class="search-icon bg-danger text-white mr-3">
                                    <i class="fas fa-code"></i>
                                </div>
                                Stisla Admin Template
                            </a>
                        </div>
                        <div class="search-item">
                            <a href="#">
                                <div class="search-icon bg-primary text-white mr-3">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                Create a new Homepage Design
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav navbar-right">
                {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                        class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Messages
                            <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Kusnaedi</b>
                                    <p>Hello, Bro!</p>
                                    <div class="time">10 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Dedik Sugiharto</b>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                    <div class="time">12 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                                    <div class="is-online"></div>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Agung Ardiansyah</b>
                                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <div class="time">12 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Ardian Rahardiansyah</b>
                                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                    <div class="time">16 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-avatar">
                                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Alfa Zulkarnain</b>
                                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                    <div class="time">Yesterday</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li> --}}
                {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                        class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Notifications
                            <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Template update is available now!
                                    <div class="time text-primary">2 Min Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                    <div class="time">10 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-success text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                    <div class="time">12 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-danger text-white">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Low disk space. Let's clean it!
                                    <div class="time">17 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Welcome to Stisla template!
                                    <div class="time">Yesterday</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li> --}}
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                  <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
                  {{-- <img alt="image" src="{{asset('assets/img/admin.jpg')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;"> --}}
                        {{-- <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->nama }}</div> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">{{ Auth::user()->nama }}</div>
                        <a href="/profile" class="dropdown-item has-icon">
                          <i class="far fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand mt-2">
              {{-- <a href="#">Futami Operator</a> --}}
              <img alt="image" src="{{asset('assets/img/futami bg.png')}}" class="rounded-medium justify-content-center" style="margin-top:5%; width:auto; height:70px; border-radius:50%;">
          </div>
          <div class="sidebar-brand sidebar-brand-sm ">
              {{-- <a href="index.html">FO</a> --}}
              <img alt="image" src="{{asset('assets/img/logo-futami-sidebar.png')}}" class="rounded-circle justify-content-center" style="margin-top:5%; width:auto; height:50px; border-radius:50%;">
          </div>
          <ul class="sidebar-menu mt-5" style="margin-top:3%; ">
            {{-- <li class="menu-header">Dashboard</li> --}}
                <li class="dropdown">
                    <a href="/operator" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="dropdown active">
                    <a href="/operator/data" class="nav-link"><i class="fas fa-table"></i><span>Data</span></a>
                </li>

                <li class="dropdown" style="margin-top: 130%;">
                    <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li>


              </ul>
            <hr>
        </aside>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Data</h1>
            </div>


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



            <div class="section-body">
                <h2 class="section-title">Form Edit Data</h2>
                {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4>Data Operator</h4>
                            </div> --}}

                            <div class="card">
                                <form action="{{route('update', $futamis['id'])}}" method="POST">
                                    @csrf
                                    @method('PATCH')


                                    <div class="card-header">
                                        <h4>Form Edit Data</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">No.Dokumen</label>
                                                <input type="text" name="nodokumen" class="form-control" value="{{$futamis['nodokumen']}}" id="inputEmail4" placeholder="Masukkan No.Dokumen (4/LAK/V1/21)">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Pemberi sampel</label>
                                                <input type="string" name="pemberi_sampel" class="form-control" value="{{$futamis['pemberi_sampel']}}" id="inputEmail4" placeholder="Masukkan nama pemberi sampel">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Parameter Pengujian</label>
                                                <input type="string" name="parameter_pengujian" class="form-control" value="{{$futamis['parameter_pengujian']}}" id="inputEmail4" placeholder="Masukkan parameter pengujian">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Jumlah sampel</label>
                                                <input type="number" name="jumlah_sampel" class="form-control" value="{{$futamis['jumlah_sampel']}}" id="inputEmail4" placeholder="Masukkan jumlah sampel">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal terima sampel</label>
                                                <input type="date" name="tanggal_terima" class="form-control" value="{{$futamis['tanggal_terima']}}" id="inputEmail4" placeholder="Masukkan tanggal terima sampel">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal uji</label>
                                                <input type="date" name="tanggal_uji" class="form-control" value="{{$futamis['tanggal_uji']}}" id="inputEmail4" placeholder="Masukkan tanggal uji">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Tanggal selesai uji</label>
                                                <input type="date" name="tanggal_selesai" class="form-control" value="{{$futamis['tanggal_selesai']}}" id="inputEmail4" placeholder="Masukkan tanggal selesai uji">
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label for="inputEmail4">Sampel</label>
                                              <input type="text" name="sampel" class="form-control" value="{{$futami_sampel_kimia['sampel']}}" id="inputEmail4" placeholder="Masukkan nama sampel">
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label for="inputEmail4">Parameter dan Nilai uji</label>
                                              <input type="text" name="parameter_nulaiuji" class="form-control" value="{{$futami_sampel_kimia['parameter_nulaiuji']}}" id="inputEmail4" placeholder="Masukkan nama parameter dan nilai uji">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Spesifikasi</label>
                                                <input type="text" name="spesifikasi" class="form-control" value="{{$futami_sampel_kimia['spesifikasi']}}" id="inputEmail4" placeholder="Masukkan spesifikasi">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control" value="{{$futami_sampel_kimia['keterangan']}}" id="inputEmail4" placeholder="Masukkan keterangan">
                                            </div>
                                            {{-- <div class="form-group col-md-6">
                                                <label for="inputPassword4">Password</label>
                                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                            </div> --}}
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress2">Address 2</label>
                                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                        </div> --}}
                                        {{-- <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity">City</label>
                                                <input type="text" class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState">State</label>
                                                <select id="inputState" class="form-control">
                                                    <option selected>Choose...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="inputZip">Zip</label>
                                                <input type="text" class="form-control" id="inputZip">
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                    Check me out
                                                </label>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-success" style="width:80%; text-align:center; margin-left:10%;">Simpan Perubahan Data</button>
                                        <a href="/operator/data" class="btn btn-primary" style="width:30%; text-align:center; margin-left:35%; margin-top:3%;">Back</a>

                                    </div>
                                </form>

                            </div>


                            {{-- <div class="card-footer text-right">
                            <nav class="d-inline-block">
                              <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                  <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                              </ul>
                            </nav>
                          </div> --}}
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                          <div class="card-header">
                            <h4>Full Width</h4>
                          </div>
                          <div class="card-body p-0">
                            <div class="table-responsive">
                              <table class="table table-striped table-md">
                                <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Created At</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                                <tr>
                                  <td>1</td>
                                  <td>Irwansyah Saputra</td>
                                  <td>2017-01-09</td>
                                  <td><div class="badge badge-success">Active</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Hasan Basri</td>
                                  <td>2017-01-09</td>
                                  <td><div class="badge badge-success">Active</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Kusnadi</td>
                                  <td>2017-01-11</td>
                                  <td><div class="badge badge-danger">Not Active</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>Rizal Fakhri</td>
                                  <td>2017-01-11</td>
                                  <td><div class="badge badge-success">Active</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td>Isnap Kiswandi</td>
                                  <td>2017-01-17</td>
                                  <td><div class="badge badge-success">Active</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <nav class="d-inline-block">
                              <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                  <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                              </ul>
                            </nav>
                          </div>
                        </div>
                      </div> --}}
                </div>
                {{-- <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4>Advanced Table</h4>
                            <div class="card-header-form">
                              <form>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search">
                                  <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div class="card-body p-0">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <tr>
                                  <th>
                                    <div class="custom-checkbox custom-control">
                                      <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                      <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                  </th>
                                  <th>Task Name</th>
                                  <th>Progress</th>
                                  <th>Members</th>
                                  <th>Due Date</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                                <tr>
                                  <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                      <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                    </div>
                                  </td>
                                  <td>Create a mobile app</td>
                                  <td class="align-middle">
                                    <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                      <div class="progress-bar bg-success" data-width="100"></div>
                                    </div>
                                  </td>
                                  <td>
                                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                  </td>
                                  <td>2018-01-20</td>
                                  <td><div class="badge badge-success">Completed</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                      <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                                    </div>
                                  </td>
                                  <td>Redesign homepage</td>
                                  <td class="align-middle">
                                    <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                      <div class="progress-bar" data-width="0"></div>
                                    </div>
                                  </td>
                                  <td>
                                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                    <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                    <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                                  </td>
                                  <td>2018-04-10</td>
                                  <td><div class="badge badge-info">Todo</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3">
                                      <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                                    </div>
                                  </td>
                                  <td>Backup database</td>
                                  <td class="align-middle">
                                    <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                      <div class="progress-bar bg-warning" data-width="70"></div>
                                    </div>
                                  </td>
                                  <td>
                                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                    <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                                  </td>
                                  <td>2018-01-29</td>
                                  <td><div class="badge badge-warning">In Progress</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                <tr>
                                  <td class="p-0 text-center">
                                    <div class="custom-checkbox custom-control">
                                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
                                      <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                                    </div>
                                  </td>
                                  <td>Input data</td>
                                  <td class="align-middle">
                                    <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                      <div class="progress-bar bg-success" data-width="100"></div>
                                    </div>
                                  </td>
                                  <td>
                                    <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                                    <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                                  </td>
                                  <td>2018-01-16</td>
                                  <td><div class="badge badge-success">Completed</div></td>
                                  <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                {{-- <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4>Sortable Table</h4>
                            <div class="card-header-action">
                              <form>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search">
                                  <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div class="card-body p-0">
                            <div class="table-responsive">
                              <table class="table table-striped" id="sortable-table">
                                <thead>
                                  <tr>
                                    <th class="text-center">
                                      <i class="fas fa-th"></i>
                                    </th>
                                    <th>Task Name</th>
                                    <th>Progress</th>
                                    <th>Members</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <div class="sort-handler">
                                        <i class="fas fa-th"></i>
                                      </div>
                                    </td>
                                    <td>Create a mobile app</td>
                                    <td class="align-middle">
                                      <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                        <div class="progress-bar bg-success" data-width="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                                    </td>
                                    <td>2018-01-20</td>
                                    <td><div class="badge badge-success">Completed</div></td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="sort-handler">
                                        <i class="fas fa-th"></i>
                                      </div>
                                    </td>
                                    <td>Redesign homepage</td>
                                    <td class="align-middle">
                                      <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                        <div class="progress-bar" data-width="0"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                                      <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                                      <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                                    </td>
                                    <td>2018-04-10</td>
                                    <td><div class="badge badge-info">Todo</div></td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="sort-handler">
                                        <i class="fas fa-th"></i>
                                      </div>
                                    </td>
                                    <td>Backup database</td>
                                    <td class="align-middle">
                                      <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                        <div class="progress-bar bg-warning" data-width="70"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                      <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                                    </td>
                                    <td>2018-01-29</td>
                                    <td><div class="badge badge-warning">In Progress</div></td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="sort-handler">
                                        <i class="fas fa-th"></i>
                                      </div>
                                    </td>
                                    <td>Input data</td>
                                    <td class="align-middle">
                                      <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                        <div class="progress-bar bg-success" data-width="100"></div>
                                      </div>
                                    </td>
                                    <td>
                                      <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                                      <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                                      <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                                      <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                                    </td>
                                    <td>2018-01-16</td>
                                    <td><div class="badge badge-success">Completed</div></td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
            </div>
        </section>
    </div>
    <footer class="main-footer">
        <div class="footer-left">
            Futami Operator
            {{-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
        </div>
        <div class="footer-right">

        </div>
    </footer>
</div>
</div>



@endsection
