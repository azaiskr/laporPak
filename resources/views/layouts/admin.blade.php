<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex max-w-[1600px] mx-auto h-screen z-50">
            <div class="z-40">
            @include('components.admin-navbar')
            </div>
            <div class="w-[20%]">
                @include('components.admin-sidebar')
            </div>
            <div class="w-full h-full bg-slate-200 pt-12">
                <div class="h-[90%] overflow-auto">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>

