<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>VRS - @yield('title')</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">


    <!-- Javascript -->
    <link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script src="{{ URL::asset('js/messages.js') }}"></script>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
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
<div class="min-h-screen bg-gray-100 bg-vrs-cyan">
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
