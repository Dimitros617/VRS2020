<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--

     -----------------------------------------------


     Tento systém vytvořily:

     -Dominik Frolík = vedoucí týmu a backend
     -Viola Vrbová = sexy člen týmu a backend
     -Kateřina Bartáková = databázová podpora
     -Kateřina Zábranská = zhezkávající člen týmu - css


     -----------------------------------------------


     -->

    <title>@yield('title') | VRS</title>
    <link rel="icon" href="{{ URL::asset('img/logo_icon_old3.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">


    <!-- Javascript -->
    <link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.esm.js') }}"></script>
    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script src="{{ URL::asset('js/messages.js') }}"></script>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/notification.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/messages.css') }}">
    <link rel="stylesheet" href="@yield('css')">
    <link rel="stylesheet" href="@yield('css2')">
    <link rel="stylesheet" href="@yield('css3')">
    <link rel="stylesheet" href="@yield('css4')">
    <link rel="stylesheet" href="@yield('css5')">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-reboot.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-utilities.css') }}">







    @section('link')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>


</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 bg-vrs-cyan pb-4">
    @livewire('navigation-dropdown')

    <!-- Page Heading -->
{{--            <header class="bg-white shadow">--}}
{{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--        {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}

<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
