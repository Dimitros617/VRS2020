<!DOCTYPE html>
<!-- Šablona pro základ dalších stránek - bude stejná hlavička, rozložení, patička, ta se do všech ostatních blade bude dědit -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Styles -->
    <style>
        html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}
    </style>

    <style>
        body {
            font-family: 'Century Gothic';
        }
    </style>
</head>
<body class="antialiased">
<header>
    <img id='logo' alt="Logo VRS" src="https://media.discordapp.net/attachments/760875058561810520/768835407671590942/unknown.png">
    <div>Jméno přihlášeného</div>
    <div>Výpůjček: </div>
    <div>Čeká na schválení: </div>
</header>
<section>
    @yield('obsah')
</section>
<footer>
    Budeme chtít na konci stránky mít jména tvůrců?
</footer>

</body>
</html>
