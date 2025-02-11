@extends('layout-operator')
@section('content')


        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                    {{-- <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">Layout</a></div>
                        <div class="breadcrumb-item">Default Layout</div>
                    </div> --}}
                </div>

                
                    {{-- disesuaikan dengan halaman Middleware, sehingga harus login untuk akses perpus, tidak bisa http://127.0.0.1:8000/dashboardUser/user --}}
                    @if(Session::get('notAllowed'))
                        <div class="alert alert-danger w-70">
                            {{Session::get('notAllowed')}} 
                        </div>
                    @endif
                    
                    @if(Session::get('successLogin'))
                        <div class="alert alert-success w-70">
                            {{Session::get('successLogin')}} 
                        </div>
                    @endif

                    {{-- disesuaikan dengan halaman Middleware, sehingga harus login untuk akses perpus, tidak bisa http://127.0.0.1:8000/dashboardUser/user --}}
                    @if(Session::get('notAllowed'))
                        <div class="alert alert-danger w-70">
                            {{Session::get('notAllowed')}} 
                        </div>
                    @endif


                <div class="section-body">
                    <h2 class="section-title">Hi' {{ Auth::user()->nama }} </h2>
                    {{-- <p class="section-lead">This page is just an example for you to create your own page.</p> --}}
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4>{{ Auth::user()->nama }}</h4>
                        </div> --}}

                        <div class="card-body">
                            <p>Hallo,  
                                {{ Auth::user()->nama }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

@endsection
