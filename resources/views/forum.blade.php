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

<body class="font-sans antialiased dark:bg-[#f4f4f4]  dark:text-black/50">
    <x-nav-bar></x-nav-bar>
    <main class="w-100 my-4">
        <section class="lg:max-w-[567px] mx-auto p-4 bg-white rounded-lg mb-4">
            <div class="flex gap-2 items-center">
                <div class="bg-gray-500 aspect-square w-8 rounded-full"></div>
                <div>Nama Lengkap</div>
            </div>
            <div class="flex justify-between items-center mt-2">
                <button class="bg-[#f4f4f4] px-4 py-2 rounded-md">Tambah Laporan</button>
                <button class="bg-[#f4f4f4] px-4 py-2 rounded-md">Laporan Saya</button>
            </div>
        </section>
        <hr/>
        <section class="my-4 lg:max-w-[567px] mx-auto">
            <input type="text" class="px-4 py-2 bg-white rounded-full w-full" placeholder="Cari Laporan">
            </input>
        </section>
        <hr/>
    </main>
    <x-footer></x-footer>
</body>

</html>
