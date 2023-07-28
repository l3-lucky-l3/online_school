<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#6c5bd5">
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#ffffff') }}">
    <meta name="msapplication-config" content="{{ asset('img/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- csrf -->
    <meta name="csrf-tiken" content="{{ csrf_token() }}">

    <!-- style -->
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    @yield('css')
    <!-- title -->
    <title>@yield('title', 'Online School')</title>
</head>

<body>
    <header>
        @yield('additional_header')
        <div class="logo">
            <img src="{{ asset('img/logo.PNG') }}" alt="logo">
        </div>

        @yield('header')
        <a href="/" class="dark_theme">Главная</a>
    </header>


    @yield('html')

    
    @yield('script')
    <script src="https://kit.fontawesome.com/93bde0f1f1.js" crossorigin="anonymous"></script>

</body>

</html>