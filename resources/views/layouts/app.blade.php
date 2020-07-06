<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tourist Registration & Information System</title>

    <!-- Scripts -->
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset(mix('css/main.css')) }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav-bar
            :auth="{{ (Auth::check())? Auth::user() : 0  }}"
            :auth2="{{ (Auth::guard('spot')->check())? Auth::guard('spot')->user() : 0 }}"
        ></nav-bar>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
