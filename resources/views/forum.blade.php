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
        @auth
            <section
                class="lg:max-w-[550px] mx-auto p-3 bg-white rounded-2xl drop-shadow-md mb-4 mt-12 font-bold text-black">
                <div>
                    <div class="flex gap-3 items-center">
                        <div class="bg-gray-300 aspect-square w-12 ml-2 rounded-full"></div>
                        <span>{{ Auth::user()->name }}</span>

                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <button class="bg-[#f4f4f4] flex items-center px-3 py-2 m-2 rounded-md">
                            Tambah Laporan
                            <svg class="h-6 w-6 text-black ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                        <button class="bg-[#f4f4f4] px-3 py-2 m-2 rounded-md">Laporan Saya</button>
                    </div>
                </div>
            </section>
        @endauth
        @guest

        @endguest
        <hr class="lg:max-w-[567px] mx-auto my-4 border-t border-gray-300">
        <section class="my-4 lg:max-w-[567px] mx-auto relative">
            <input type="text"
                class="pl-10 px-4 py-2 bg-white rounded-full w-full text-black border-none drop-shadow-md"
                placeholder="Cari Laporan">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-6 w-6 text-black" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
        </section>
        <hr class="lg:max-w-[567px] mx-auto my-4 border-t border-gray-300">
        <section class="lg:max-w-[550px] mx-auto p-3 bg-white rounded-2xl drop-shadow-md mb-4 font-bold text-black">
            <div>
                <div class="flex gap-3 items-center mt-2">
                    <h2 class="tracking-tight text-xl font-extrabold ml-4">Laporan Terpopuler</h2>
                </div>
                <div class="flex justify-center items-center text-xs">
                    <a href="{{ url('/forum/weekly') }}"
                        class="{{ $currentTimeFrame == 'weekly' ? 'bg-gray-300 border-none' : 'bg-[#f4f4f4] border border-black' }} px-7 py-1 m-2 rounded-full">
                        Weekly
                    </a>
                    <a href="{{ url('/forum/monthly') }}"
                        class="{{ $currentTimeFrame == 'monthly' ? 'bg-gray-300 border-none' : 'bg-[#f4f4f4] border border-black' }} px-7 py-1 m-2 rounded-full">
                        Monthly
                    </a>
                </div>

            </div>
        </section>
        @foreach ($popularReports as $popularReport)
            <section class="lg:max-w-[550px] mx-auto p-3 bg-white rounded-2xl drop-shadow-md mb-4 text-black">
                <div>
                    <!-- Status Message -->
                    <div
                        class="mb-4 flex text-xs justify-center text-center font-extrabold text-black bg-yellow-200 mt-1 py-4 px-2">
                        Laporan ini di {{ $popularReport->status->status }} oleh team
                    </div>

                    <!-- User Information -->
                    <div class="flex">
                        <div class="flex flex-col gap-2 mt-4 items-start">
                            <div class="flex gap-3 items-center">
                                <div class="bg-gray-300 aspect-square w-10 ml-6 rounded-full"></div>
                                <div>
                                    <span>{{ $popularReport->user->name }}</span>
                                    <br />
                                    <span class="text-xs text-black">Dilaporkan pada
                                        {{ $popularReport->created_at }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="items-center mt-4">
                        <p class="px-3 m-2 rounded-md">Laporan Singkat: {{ $popularReport->description }}</p>
                        <p class="px-3 m-2 rounded-md">Tanggal: {{ $popularReport->created_at }}</p>
                        <p class="px-3 m-2 rounded-md">Lokasi: {{ $popularReport->address }}</p>
                    </div>

                    <!-- Image -->
                    <div class="mx-auto relative w-full h-64">
                        <img src="{{ Storage::url($popularReport->media) }}" alt="Descriptive Alt Text"
                            class="absolute p-4 inset-0 w-full h-full object-cover rounded-sm" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col mb-4">
                        <a href="#" class="px-3 m-2 rounded-md text-sm font-extrabold">selengkapnya...</a>
                        <div class="flex items-center justify-center mt-4">

                            <!-- Upvote Form -->
                            <form action="{{ url('/reports/' . $popularReport->id . '/rate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="rating_type" value="up">
                                <button type="submit"
                                    class="text-black border border-black hover:bg-blue-300 focus:ring-4 focus:outline-none focus:ring-blue-300 focus:bg-blue-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 10"
                                        style="transform: rotate(-90deg); transform-origin: center;">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                    <span class="sr-only">Upvote</span>
                                </button>
                            </form>

                            <!-- Display Vote Count -->
                            <span
                                class="px-3 m-2 rounded-md text-xl font-extrabold">{{ $popularReport->upvote_count }}</span>
                            <span
                                class="px-3 m-2 rounded-md text-xl font-extrabold">{{ $popularReport->downvote_count }}</span>

                            <!-- Downvote Form -->
                            <form action="{{ url('/reports/' . $popularReport->id . '/rate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="rating_type" value="down">
                                <button type="submit"
                                    class="text-black border border-black hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-red-300 focus:bg-red-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 10"
                                        style="transform: rotate(90deg); transform-origin: center;">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                    <span class="sr-only">Downvote</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach

        <section class="lg:max-w-[550px] mx-auto p-3 bg-white rounded-2xl drop-shadow-md my-4 font-bold text-black">
            <div>
                <div class="flex gap-3 items-center my-2">
                    <h2 class="tracking-tight text-xl font-extrabold ml-4">Laporan Terbaru</h2>
                </div>
            </div>
        </section>

        @foreach ($newestReports as $newestReport)
            <section class="lg:max-w-[550px] mx-auto p-3 bg-white rounded-2xl drop-shadow-md mb-4 text-black">
                <div>
                    <!-- Status Message -->
                    {{-- <div class="mb-4 flex text-xs justify-center text-center font-extrabold text-black bg-yellow-200 mt-1 py-4 px-2">
                    Laporan ini sedang di proses oleh team
                </div> --}}

                    <!-- User Information -->
                    <div class="flex">
                        <div class="flex flex-col gap-2 mt-4 items-start">
                            <div class="flex gap-3 items-center">
                                <div class="bg-gray-300 aspect-square w-10 ml-6 rounded-full"></div>
                                <div>
                                    <span>{{ $newestReport->user->name }}</span>
                                    <br />
                                    <span class="text-xs text-black">Dilaporkan pada Sep, 9 - 2024</span>
                                </div>
                            </div>
                        </div>
                        <!-- Post Identification -->
                        <div class="flex justify-center items-center ml-8">
                            <div class="flex gap-3 items-center">
                                <div>
                                    <span class="text-xs font-extrabold">Laporan
                                        {{ $newestReport->status->status }}</span>
                                </div>
                                <div class="bg-blue-500 aspect-square w-6 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="items-center mt-4">
                        <p class="px-3 m-2 rounded-md">Laporan Singkat: {{ $newestReport->description }}</p>
                        <p class="px-3 m-2 rounded-md">Tanggal: {{ $newestReport->created_at }}</p>
                        <p class="px-3 m-2 rounded-md">Lokasi: {{ $newestReport->address }}</p>
                    </div>

                    <!-- Image -->
                    <div class="mx-auto relative w-full h-64">
                        <img src="{{ Storage::url($newestReport->media) }}" alt="Descriptive Alt Text"
                            class="absolute p-4 inset-0 w-full h-full object-cover rounded-sm" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col mb-4">
                        <a href="#" class="px-3 m-2 rounded-md text-sm font-extrabold">selengkapnya...</a>
                        <div class="flex items-center justify-center mt-4">
                            <!-- Upvote Form -->
                            <form action="{{ url('/reports/' . $newestReport->id . '/rate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="rating_type" value="up">
                                <button type="submit"
                                    class="text-black border border-black hover:bg-blue-300 focus:ring-4 focus:outline-none focus:ring-blue-300 focus:bg-blue-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 10"
                                        style="transform: rotate(-90deg); transform-origin: center;">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                    <span class="sr-only">Upvote</span>
                                </button>
                            </form>

                            <!-- Display Vote Count -->
                            <span
                                class="px-3 m-2 rounded-md text-xl font-extrabold">{{ $newestReport->upvote_count }}</span>
                            <span
                                class="px-3 m-2 rounded-md text-xl font-extrabold">{{ $newestReport->downvote_count }}</span>

                            <!-- Downvote Form -->
                            <form action="{{ url('/reports/' . $newestReport->id . '/rate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="rating_type" value="down">
                                <button type="submit"
                                    class="text-black border border-black hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-red-300 focus:bg-red-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 10"
                                        style="transform: rotate(90deg); transform-origin: center;">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                    <span class="sr-only">Downvote</span>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        @endforeach

    </main>
    <x-footer></x-footer>
</body>

</html>
