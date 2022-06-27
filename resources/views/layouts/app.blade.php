<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link type="image/x-icon" href="/storage/img/favicon.ico" rel="shortcut icon">
    <link type="Image/x-icon" href="/storage/img/favicon.ico" rel="icon">
    <meta http-equiv="pragma" content="no-cache">
    <title>@yield('title')</title>
</head>

<body>
    @if (Auth::check())
    <script>
        window.Laravel = {!!json_encode([
            'isLoggedin' => true,
            'user' => Auth::user()
        ])!!}
    </script>
@else
    <script>
        window.Laravel = {!!json_encode([
            'isLoggedin' => false
        ])!!}
    </script>
@endif
    <div id="app"
        class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-800 text-black dark:text-white">
        @include('inc.header')
        @include('inc.sidebar')
        <div class="h-full ml-16 mt-14 mb-10 md:ml-52">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</body>
