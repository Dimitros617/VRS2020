<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Výpůjční a rezervační systém</title>
        <link rel="icon" href="{{ URL::asset('img/logo_icon_old3.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/auth.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-grid.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-reboot.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-utilities.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
