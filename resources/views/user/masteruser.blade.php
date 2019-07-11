<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>s
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Styles -->
    @yield('head_styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <style>
        .help-block {
            color: red;
        }

        .error {
            color: brown;
        }

        .listprd:hover {
            background-color: red;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}

                </a> --}}
                {{--
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
                </button> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        {{-- &nbsp;<li><a class="btn btn-success" href="{{ route('admin.user.index') }}">Thông tin tài
                        khoản</a></li> --}}
                        {{-- &nbsp;<li><a class="btn btn-success" href="{{ route('admin.department.index') }}">Phòng
                        Ban</a></li> --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký tài khoản') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @if (session('message'))
                <div class="alert alert-success tc">
                    {{ session('message') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger loi">
                    {{ session('error') }}
                </div>
                @endif
                <div class="row borderall">
                    <div class="col-md-3">
                        <div class="vertical-menu">
                            <a href="{{ route('user.borrow.index') }}" class="{{ (\Request::route()->getName() == 'user.borrow.index') ? 'active' : '' }}">Mượn sách</a>
                            <a href="{{ route('user.giveback.index') }}" class="{{ (\Request::route()->getName() == 'user.give.index') ? 'active' : '' }}">Trả</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="content-admin">
                            @yield('content')
                        </div>
                    </div>
                    <div class="parrentalert">
                        <div class="alert alert-success edit hidden"></div>
                        <div class="alert alert-danger del hidden"></div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    @yield('body_scripts_top')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @if (count($errors) > 0)
    <script type="text/javascript">
        $(document).ready(function(){
                $('#myModal').modal('show');
            })
    </script>
    @endif
     {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('body_scripts_bottom')
</body>

</html>
