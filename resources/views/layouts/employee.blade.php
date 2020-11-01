<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EmployeeManagement') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
    <link href="{{ asset('public/css/simple-sidebar.css') }}" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/assets/images/globussoftfavicon.png') }}">
    <link rel="stylesheet" href="{{url('public/assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{url('public/assets/css/style.css')}}">
    @yield('head')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading"><a href="{{ url('/home') }}"><img src="{{ url('public/assets/images/globussoftlogo.png') }}" /></a></div>
            <div class="list-group list-group-flush">
                <a href="{{ url('/home') }}" class="<?= ( Request::segment(2) == '' ? ' nav-item active' : 'nav-item'); ?> list-group-item list-group-item-action bg-light"> <i class="fas fa-fw fa-tachometer-alt" aria-hidden="true"></i> Dashboard</a>
            </div>
        </div>

        <div id="page-content-wrapper">
            <!-- Navbar -->
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>

    
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item navbarname">
                          <a class="nav-link" href="#">Hi {{Auth::user()->name }}!</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{url('employee/logout')}}">Sign Out <i class="fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
                
            </nav>

            <!-- Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

    </div>

    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
    </script>
    @yield('foot')
</body>
</html>