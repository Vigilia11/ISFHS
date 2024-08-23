<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'ISFHS') }}</title>-->
    <title>ISFHS</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome Icon Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet"/>
    
    <!--custom css-->
    <link rel="stylesheet" href="{{ asset('css/customButtoncss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">

    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    @auth
        @if(Auth::user()->hasRole('facilitator') || Auth::user()->hasRole('student'))
        <div id="app" class="" style="background-color:#f3f4f6;">
            @include('layouts.navigation')

            <main class="min-vh-100" style="padding-top:56px;">
                @yield('content')
            </main>
        </div>
        @endif
        @if(Auth::user()->hasRole('admin'))
        <div id="app" class="" style="backround-color: #1f2937;">
            @include('admin.layouts.navigation')
            @include('admin.layouts.sidenav_v2')
            <div class="admin-content" id="" style="">
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('js/admin/layouts/app.js') }}" defer></script>
        @endif
    @endauth
    @guest
    <div id="app" class="" style="background-color:#f3f4f6;">
        @include('layouts.navigation')

        <main class="min-vh-100" style="padding-top:60px">
            @yield('content')
        </main>
    </div>
    @endguest
    <!--
    @guest
    <div id="app" class="" style="background-color:#e5e7eb;">
        <main class="vh-100">
            @yield('content')
        </main>
    </div>
    @endguest
-->
    <script src="{{ asset('js/welcome.js') }}" prefer></script>
</body>
</html>
