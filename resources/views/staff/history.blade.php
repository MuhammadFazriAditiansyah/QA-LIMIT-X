@extends('layout-operator')
@section('content')


  <div id="app">
      <div class="main-wrapper main-wrapper-1">
          <div class="navbar-bg"></div>
          <nav class="navbar navbar-expand-lg main-navbar">
            {{-- <form action="{{route('delete', $futami['id'])}}" method="POST"> --}}

                <form class="form-inline mr-auto" method="GET" action="{{ route('staff_analisakimia_history') }}">
                    <ul class="navbar-nav mr-3">
                      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                      <input class="form-control" type="date" name="tanggal_uji" id="tanggal_uji" placeholder="Tanggal Uji" aria-label="Search" data-width="250"> 
                      <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai" placeholder="Tanggal Selesai Uji" aria-label="Search" data-width="250">
                      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
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
                  <li class="dropdown"><a href="#" data-toggle="dropdown"
                          class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                          <img alt="image" src="{{asset('assets/template/stisla/assets/img/avatar/avatar-3.png')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;">
                          {{-- <img alt="image" src="{{asset('assets/img/admin.jpg')}}" class="rounded-circle mr-1" style="width:40px; height:40px; border-radius:50%;"> --}}
                          {{-- <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->nama }} </div> --}}
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
                          <a href="/staff" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                      </li>
                      <li class="dropdown">
                          <a href="/staff/data" class="nav-link"><i class="fas fa-flask"></i><span>Data Analisa Kimia</span></a>
                      </li>
                      <li class="dropdown active">
                        <a href="/staff/analisakimia/history" class="nav-link"><i class="fas fa-history"></i><span>History Delete</span></a>
                      </li>

                      {{-- Mikrobiologi Air --}}
                    <li class="dropdown">
                        <a href="/operator/mikrobiologi" class="nav-link"><i class="fas fa-bacterium"></i><span>Mikrobiologi Air</span></a>
                    </li>

                      {{-- <li class="dropdown" style="margin-top: 130%;">
                          <a href="/logout" class="nav-link text-danger"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                      </li> --}}

  




                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                              <span>Components</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="components-article.html">Article</a></li>
                              <li><a class="nav-link beep beep-sidebar" href="components-avatar.html">Avatar</a></li>
                              <li><a class="nav-link" href="components-chat-box.html">Chat Box</a></li>
                              <li><a class="nav-link beep beep-sidebar" href="components-empty-state.html">Empty State</a></li>
                              <li><a class="nav-link" href="components-gallery.html">Gallery</a></li>
                              <li><a class="nav-link beep beep-sidebar" href="components-hero.html">Hero</a></li>
                              <li><a class="nav-link" href="components-multiple-upload.html">Multiple Upload</a></li>
                              <li><a class="nav-link beep beep-sidebar" href="components-pricing.html">Pricing</a></li>
                              <li><a class="nav-link" href="components-statistic.html">Statistic</a></li>
                              <li><a class="nav-link" href="components-tab.html">Tab</a></li>
                              <li><a class="nav-link" href="components-table.html">Table</a></li>
                              <li><a class="nav-link" href="components-user.html">User</a></li>
                              <li><a class="nav-link beep beep-sidebar" href="components-wizard.html">Wizard</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Forms</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
                              <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
                              <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google
                                  Maps</span></a>
                          <ul class="dropdown-menu">
                              <li><a href="gmaps-advanced-route.html">Advanced Route</a></li>
                              <li><a href="gmaps-draggable-marker.html">Draggable Marker</a></li>
                              <li><a href="gmaps-geocoding.html">Geocoding</a></li>
                              <li><a href="gmaps-geolocation.html">Geolocation</a></li>
                              <li><a href="gmaps-marker.html">Marker</a></li>
                              <li><a href="gmaps-multiple-marker.html">Multiple Marker</a></li>
                              <li><a href="gmaps-route.html">Route</a></li>
                              <li><a href="gmaps-simple.html">Simple</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="modules-calendar.html">Calendar</a></li>
                              <li><a class="nav-link" href="modules-chartjs.html">ChartJS</a></li>
                              <li><a class="nav-link" href="modules-datatables.html">DataTables</a></li>
                              <li><a class="nav-link" href="modules-flag.html">Flag</a></li>
                              <li><a class="nav-link" href="modules-font-awesome.html">Font Awesome</a></li>
                              <li><a class="nav-link" href="modules-ion-icons.html">Ion Icons</a></li>
                              <li><a class="nav-link" href="modules-owl-carousel.html">Owl Carousel</a></li>
                              <li><a class="nav-link" href="modules-sparkline.html">Sparkline</a></li>
                              <li><a class="nav-link" href="modules-sweet-alert.html">Sweet Alert</a></li>
                              <li><a class="nav-link" href="modules-toastr.html">Toastr</a></li>
                              <li><a class="nav-link" href="modules-vector-map.html">Vector Map</a></li>
                              <li><a class="nav-link" href="modules-weather-icon.html">Weather Icon</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="menu-header">Pages</li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                          <ul class="dropdown-menu">
                              <li><a href="auth-forgot-password.html">Forgot Password</a></li>
                              <li><a href="auth-login.html">Login</a></li>
                              <li><a href="auth-register.html">Register</a></li>
                              <li><a href="auth-reset-password.html">Reset Password</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                              <span>Errors</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="errors-503.html">503</a></li>
                              <li><a class="nav-link" href="errors-403.html">403</a></li>
                              <li><a class="nav-link" href="errors-404.html">404</a></li>
                              <li><a class="nav-link" href="errors-500.html">500</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i>
                              <span>Features</span></a>
                          <ul class="dropdown-menu">
                              <li><a class="nav-link" href="features-activities.html">Activities</a></li>
                              <li><a class="nav-link" href="features-post-create.html">Post Create</a></li>
                              <li><a class="nav-link" href="features-posts.html">Posts</a></li>
                              <li><a class="nav-link" href="features-profile.html">Profile</a></li>
                              <li><a class="nav-link" href="features-settings.html">Settings</a></li>
                              <li><a class="nav-link" href="features-setting-detail.html">Setting Detail</a></li>
                              <li><a class="nav-link" href="features-tickets.html">Tickets</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li class="dropdown">
                          <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i>
                              <span>Utilities</span></a>
                          <ul class="dropdown-menu">
                              <li><a href="utilities-contact.html">Contact</a></li>
                              <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
                              <li><a href="utilities-subscribe.html">Subscribe</a></li>
                          </ul>
                      </li> --}}
                      {{-- <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i><span>Credits</span></a></li> --}}
                  </ul>
                  <hr>
              </aside>
          </div>

          <!-- Main Content -->
          <div class="main-content">
              <section class="section">
                  <div class="section-header">
                      <h1>History Analisa Kimia</h1>
                  </div>

                  <div class="section-body">
                      <h2 class="section-title">History Analisa Kimia</h2>

                      {{-- <p class="section-lead">Example of some Bootstrap table components.</p> --}}

                      <div class="row">
                          <div class="col-12">
                              <div class="card shadow">
                                  

                                  @if(Session::get('successAdd'))
                                      <div class="alert alert-success w-70">
                                          {{Session::get('successAdd')}} 
                                      </div>
                                  @endif

                                  @if(Session::get('successDelete'))
                                      <div class="alert alert-danger w-70">
                                          {{Session::get('successDelete')}} 
                                      </div>
                                  @endif

                                  @if(Session::get('successUpdate'))
                                      <div class="alert alert-success w-70">
                                          {{Session::get('successUpdate')}} 
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



                                  {{-- <form action="{{route('operatorpdf')}}" method="POST" target="_blank">
                                    @csrf
                                    
                                    <div class="button_download" style="margin-left:84%; margin-top:-4%;">
                                      <div class="col-md-7 col-lg-5">
                                        <a href="/operator/data/pdf" target="_blank">
                                          <button type="button" class="btn btn-outline-primary">
                                            <i class="fa-solid fa-file-pdf fa-2x ml-5"></i>
                                          </button>
                                        </a>
                                      </div>
    
                                    </div>
                                  </form> --}}
                                <div class="button" style="margin-left:4%; margin-top:3%;">
                                    <a href="/staff/data" class="btn btn-icon icon-left btn-primary"><i class="fa-solid fa-house"></i> Back</a>

                                </div>
      
                                  <div class="card-body mt-3 shadow">
                                      <div class="table-responsive">
                                          <table class="table table-bordered table-md">
                                              <tr>
                                                  <th>No</th>
                                                  <th>No.Dokumen</th>
                                                  <th>Pemberi sampel</th>
                                                  <th>Tanggal terima sampel</th>
                                                  <th>Tanggal Uji</th>
                                                  <th>Tanggal selesai uji</th>
                                              </tr>
                                              @forelse ($futamis as $futami)
                                                  <tr>
                                                      <td>{{$no++}}</td>
                                                      <td>{{$futami->nodokumen}}</td>
                                                      <td>{{$futami->pemberi_sampel}}</td>
                                                      <td>{{Carbon\Carbon::parse($futami->tanggal_terima)->translatedFormat('d F Y')}}</td>
                                                      <td>{{Carbon\Carbon::parse($futami->tanggal_uji)->translatedFormat('d F Y')}}</td>
                                                      <td>{{Carbon\Carbon::parse($futami->tanggal_selesai)->translatedFormat('d F Y')}}</td>
                                                  </tr>

                                                  @empty
                                                      <tr>
                                                        <td class="text-center h5" colspan="8">Not Found</td>
                                                      </tr>
                                              @endforelse
                                              
                                            </table>
                                            {{ $futamis->links('pagination::bootstrap-4') }}
                                          </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
          </div>
        
      </div>
  </div>



@endsection
