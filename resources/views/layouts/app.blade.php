<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link type="image/x-icon" href="/storage/img/favicon.ico" rel="shortcut icon">
    <link type="Image/x-icon" href="/storage/img/favicon.ico" rel="icon">
    <meta http-equiv="pragma" content="no-cache">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    @if (Auth::check())
        <script>
            window.Laravel = {!! json_encode([
                'isLoggedin' => true,
                'user' => Auth::user(),
            ]) !!}
        </script>
    @else
        <script>
            window.Laravel = {!! json_encode([
                'isLoggedin' => false,
            ]) !!}
        </script>
    @endif
    <div id="app"
        class="flex flex-col flex-auto flex-shrink-0 min-h-screen antialiased text-black bg-white dark:bg-gray-800 dark:text-white">
        @include('inc.header')
        @include('inc.sidebar')
        <div class="h-full mb-10 ml-16 mt-14 md:ml-52">
            @yield('content')
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
