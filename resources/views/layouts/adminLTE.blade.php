<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-------------------------------------------------head------------------------------------------------->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App Name -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--FivoIcon-->
    <link href="{{ asset('images/logo.png') }}" rel="icon" type="image/x-icon" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- GoogleMap -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV7YVoG2xX8sBK6db7h8PXNtU5fEvtOqA&libraries=places&callback=initialize"></script>
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('google_map.map_apikey')}}&libraries=places&callback=initialize"></script> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- ChartJS -->
    {{-- <script src="{{ asset('chart.js/Chart.min.js') }}"></script> --}}
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
</head>
<!-------------------------------------------------./head------------------------------------------------->

<!-------------------------------------------------body------------------------------------------------->
<body class="hold-transition sidebar-mini" >

    <!-------------------------------------------------wrapper------------------------------------------------->
    <div class="wrapper">

        <!-----------------------------------------adminLTE-------------------------------------------------->
        <section id="adminLTE">

            <!-----------------------------------------nav--------------------------------------------------->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Right Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user-circle mt-2"></i>
                            @if(Auth::user() != null)
                                <span>&nbsp;{{Auth::user()->name}}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="/" class="dropdown-item">
                                <i class="fas fa-home fa-fw" aria-hidden="true"></i>Home</a>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i>Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </nav>
            <!-----------------------------------------./nav--------------------------------------------------->

            <!-----------------------------------------sidebar--------------------------------------------------->
            @include('inc.sidebar')
            <!-----------------------------------------./sidebar--------------------------------------------------->

            <!-----------------------------------------content-wrapper--------------------------------------------------->
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="content">
                        <div class="container-fluid">

                            <!-------------------------------------------------messages------------------------------------------------->
                            <div class="container">
                                @include('inc.messages')
                            </div>
                            <!-------------------------------------------------./messages------------------------------------------------->

                            <!-------------------------------------------------main------------------------------------------------->
                            <main class="py-4">
                                @yield('content')
                            </main>
                            <!-------------------------------------------------./main------------------------------------------------->

                        </div>
                    </div>
                </div>
            </div>
            <!-----------------------------------------./content-wrapper--------------------------------------------------->

        </section>
        <!-----------------------------------------./adminLTE--------------------------------------------------->

        <!-----------------------------------------footer--------------------------------------------------->
        <footer class="main-footer">
            <strong class="pull-center">&copy;&nbsp;{{date('Y')}}&nbsp;{{config('app.name', 'Laravel')}}.</strong>
        </footer>
        <!-----------------------------------------./footer--------------------------------------------------->

    </div>
    <!-------------------------------------------------wrapper------------------------------------------------->


</body>
<!-------------------------------------------------./body------------------------------------------------->
</html>
