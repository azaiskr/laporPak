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

<body class="flex flex-col min-h-screen font-sans antialiased dark:bg-[#f4f4f4] dark:text-black/50">
    <x-nav-bar></x-nav-bar>
   <main class="w-full my-4 flex-grow">
        <section class="lg:max-w-[785px] mx-auto p-3 bg-white rounded-2xl drop-shadow-md mb-4 mt-12 font-bold text-black">
            <div>
                <div>
                    <div class="mx-auto max-w-2xl lg:mx-0 p-8">
                        <h2 class="text-5xl font-bold tracking-tight text-black">Formulir Lapor</h2>
                    </div>
                </div>
                <form class="max-w-2xl mx-auto">
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-xl font-extrabold text-black">Judul Laporan</label>
                        <input type="text" id="name" class="pl-4 bg-white border-black text-black text-sm rounded-full 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-black" 
                        placeholder="Nama Judul, contoh: Kerusakan Jalan di bayuwangi" required />
                    </div>
                    <div class="mb-5">
                        <label for="category" class="block mb-2 text-xl font-extrabold text-black">Kategori</label>
                        <input type="text" id="category" class=" pl-4 bg-white border-black text-black text-sm rounded-full 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-black" 
                        placeholder="Nama Judul, contoh: Kerusakan Jalan di bayuwangi" required />
                    </div>
                    <div class="mb-5">
                        <label for="location" class="block mb-2 text-xl font-extrabold text-black">Lokasi</label>
                        <input type="text" id="location" class=" pl-4 bg-white border-black text-black text-sm rounded-full 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-black" 
                        placeholder="Nama Judul, contoh: Kerusakan Jalan di bayuwangi" required />
                    </div>
                    <div class="mb-5">
                        <label for="location-description" class="block mb-2 text-xl font-extrabold text-black">Keterangan Tambahan Lokasi</label>
                        <input type="text" id="location-description" class=" pl-4 bg-white border-black text-black text-sm rounded-full 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-black" 
                        placeholder="Nama Judul, contoh: Kerusakan Jalan di bayuwangi" required />
                    </div>
                    <div class="mb-5">
                        <label for="description" class="block mb-2 text-xl font-extrabold text-black">Deskripsi</label>
                        <textarea id="description" rows="4" class="pl-4 block p-2.5 w-full text-sm text-black bg-white rounded-3xl border border-black 
                        focus:ring-blue-500 focus:border-blue-500 placeholder-black " 
                        placeholder="Nama Judul, contoh: Kerusakan Jalan di bayuwangi" required></textarea>
                    </div>
                    <div class="mb-5">
                        <span class="block mb-2 text-lg font-extrabold text-black">Media Video / Gambar</span>
                         <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border border-black rounded-3xl cursor-pointer bg-white">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-6 h-6 mb-4 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-black"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-black">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" required/>
                            </label>
                        </div> 
                    </div>
                    <div class="flex justify-center mb-5">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 
                        focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-xs w-full sm:w-auto px-24 py-2.5 text-center">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <x-footer></x-footer>
</body>

</html>
