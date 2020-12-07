<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Výpůjční a rezervační systém</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="css/welcomeDefault.css">
        <link rel="stylesheet" type="text/css" href="css/welcome.css">


    </head>
    <body class="antialiased">

        <div class="relative flex items-top justify-center min-h-screen  sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-lg text-gray-700 underline ">Hlavní strana</a>
                    @else
                        <a href="{{ route('login') }}" class="text-lg text-gray-700 underline ">Přihlášení</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-lg text-gray-700 underline ">Registrace</a>
                        @endif
                    @endif
                </div>
            @endif

                <div class="logo_box ">
                    <a href="/dashboard">
                    <div id="logo_max_size">
                    </div>
                    </a>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Build v{{ Illuminate\Foundation\Application::VERSION }}
                    </div>
                </div>
    </body>
</html>
