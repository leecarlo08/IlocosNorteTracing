<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ADMIN | Tourism</title>


    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset(mix('js/admin.js')) }}" defer></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"> </script>

    <script src="{{ asset('DataTables/DataTables-1.10.16/js/dataTables.buttons.min.js') }}"> </script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/buttons.flash.min.js') }}"> </script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/jszip.min.js') }}"> </script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/pdfmake.min.js') }}"> </script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/vfs_fonts.js') }}"> </script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/buttons.html5.min.js') }}"> </script>
    <script src="{{ asset('DataTables/DataTables-1.10.16/js/buttons.print.min.js') }}"> </script>

    <!-- Styles -->
    <link href="{{ asset(mix('css/admin.css')) }}" rel="stylesheet">
    <link href="{{ asset('DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @yield('hs')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/super-user') }}">{{'ADMIN | Tourism' }}</a>
        <ul class="navbar-nav px-3">
            @if(Auth::guard('admin')->check())
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('adminLogout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('adminLogout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </nav>
    @if(Auth::guard('admin')->check())
        <admin-side-nav></admin-side-nav>
    @endif
    @yield('content2')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="padding-top: 80px; padding-bottom: 80px">
        @yield('content')
    </main>
</div>
@yield('script')
</body>
</html>
