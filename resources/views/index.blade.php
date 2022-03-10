<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-------------------------------------------------head------------------------------------------------->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--FivoIcon-->
    <link href="{{ asset('images/logo.png') }}" rel="icon" type="image/x-icon" />
    <!-- App name -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<!-------------------------------------------------./head------------------------------------------------->

<!-------------------------------------------------body------------------------------------------------->
<body>

    <!-------------------------------------------------home------------------------------------------------->
    <div id="home">

        <!-----------------------------------------hero--------------------------------------------------->
        <div id="hero">

            <nav class="navbar navbar-expand-md navbar-dark bg-transparent shadow-none">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" height="45" width="45"/>
                        <span class="text-white logo">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white active" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#services">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#footer">Contact</a>
                            </li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="btn btn-warning my-2 my-sm-0 mr-2">{{ __('LOGIN') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    {{-- <li class="nav-item">
                                        <a href="{{ route('register') }}" class="btn btn-outline-warning my-2 my-sm-0">{{ __('REGISTER') }}</a>
                                    </li> --}}
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('welcome')}}">Get Started</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pt-5 pb-5">

                <div class="container">

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 mt-5">
                            <div class="text-center text-white mb-5 mt-5">
                                <h2><strong>{{config('app.name', 'Laravel')}}</strong></h2>
                                <p><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis a purus quis accumsan!</span></p>
                                <a href="{{route('welcome')}}" class="btn btn-outline-warning px-5 py-2 mt-3">Get Started</a>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>

            </div>

        </div>
        <!-----------------------------------------./hero--------------------------------------------------->


        <!-----------------------------------------services--------------------------------------------------->
        <div id="services">

            <div class="container pt-5 pb-1">
                <h2 class="mb-4"><strong>Services</strong></h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-person-booth fa-4x" aria-hidden="true"></i>
                            <h3><strong>General Physiotherapy</strong></h3>
                        </div>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Ut sagittis a purus quis accumsan. Suspendisse quis nulla
                            suscipit, pellentesque ipsum ut, mollis enim. Proin luctus
                            elit vel tincidunt ultricies. Morbi suscipit, ex sed interdum
                            dignissim, arcu velit aliquet purus, dapibus volutpat dui elit
                            eu ipsum. Nullam sit amet volutpat mauris, non feugiat nibh. </p>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-blog fa-4x" aria-hidden="true"></i>
                            <h3><strong>Back & Neck Pain</strong></h3>
                        </div>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Ut sagittis a purus quis accumsan. Suspendisse quis nulla
                            suscipit, pellentesque ipsum ut, mollis enim. Proin luctus
                            elit vel tincidunt ultricies. Morbi suscipit, ex sed interdum
                            dignissim, arcu velit aliquet purus, dapibus volutpat dui elit
                            eu ipsum. Nullam sit amet volutpat mauris, non feugiat nibh. </p>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-running fa-4x" aria-hidden="true"></i>
                            <h3><strong>Sports Injuries</strong></h3>
                        </div>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Ut sagittis a purus quis accumsan. Suspendisse quis nulla
                            suscipit, pellentesque ipsum ut, mollis enim. Proin luctus
                            elit vel tincidunt ultricies. Morbi suscipit, ex sed interdum
                            dignissim, arcu velit aliquet purus, dapibus volutpat dui elit
                            eu ipsum. Nullam sit amet volutpat mauris, non feugiat nibh. </p>
                    </div>
                </div>
            </div>

        </div>
        <!-----------------------------------------./services--------------------------------------------------->



        <!-------------------------------------------------advert------------------------------------------------->
        <section id="advert">
            <div class="container pb-5 pt-1">

                <div class="bg-success-warning w-100 mt-5 p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="pl-2">
                            <h3 class="text-center text-white"><strong>TO BOOK AN APPOINTMENT, CALL +254(0)753 000 888</strong></h3>
                        </div>
                        <div class="pr-2">

                            <a href="#" class="btn btn-success btn-sm text-nowrap">Read More</a>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-------------------------------------------------./advert------------------------------------------------->


        <!-------------------------------------------------goToFunction------------------------------------------------->
        <button class="btn btn-primary rounded-circle" onclick="goToFunction()" id="goToTopBtn" title="Go to top">
            <i class="fas fa-chevron-up"></i>
        </button>
        <!-------------------------------------------------./goToFunction------------------------------------------------->


    </div>
    <!-------------------------------------------------./home------------------------------------------------->


    <!-- footer -->
    @include('inc.footer')

    <!-------------------------------------------------goToTopBtn------------------------------------------------->
    <script>
        //Get the button:
        mybutton = document.getElementById("goToTopBtn");
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        function goToFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
    <!-------------------------------------------------./goToTopBtn------------------------------------------------->


</body>
<!-------------------------------------------------./body------------------------------------------------->


</html>
