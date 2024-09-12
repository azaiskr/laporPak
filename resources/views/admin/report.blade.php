@extends('layouts.admin')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg px-12 py-6">
    <div class="pb-4 bg-white px-12 py-6">
        <label for="table-search" class="sr-only">Search</label>
        <div class="flex justify-between">
            <div class="flex justify-center">
                <div class=" mx-0 my-auto">
                    <div class="relative flex justify-center items-center">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="table-search" class="block pt-2 pl-10 text-sm text-gray-900 border border-black rounded-full w-96 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
                    </div>
                </div>
            </div>
            <div id="dateRangeDropdown" class="z-10 bg-white rounded-lg w-80 lg:w-96 mt-10">
                <!-- Header Section -->
                <div class="p-3">
                    <h3 class="text-lg font-semibold text-gray-900">Date</h3>
                </div>
                <!-- Date Range Picker Section -->
                <div class="p-3">
                    <div date-rangepicker datepicker-autohide class="flex items-center justify-between">
                        <div>
                            <input name="start" type="date" class="bg-gray-50 border border-black text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Start date">
                        </div>
                        <span class="mx-2 text-gray-500">to</span>
                        <div>
                            <input name="end" type="date" class="bg-gray-50 border border-black text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="End date">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="px-12 py-6 bg-white">
        <table class="w-full text-sm text-center rtl:text-right text-black">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border border-black">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pengirim
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Title
                    </th>
                    <td class="px-6 py-4">
                        Pengirim
                    </td>
                    <td class="px-6 py-4">
                        Tanggal
                    </td>
                    <td class="px-6 py-4">
                        Status
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 hover:underline action-button">Action</a>
                    </td>
                </tr>
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Title
                    </th>
                    <td class="px-6 py-4">
                        Pengirim
                    </td>
                    <td class="px-6 py-4">
                        Tanggal
                    </td>
                    <td class="px-6 py-4">
                        Status
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 hover:underline action-button">Action</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-center px-12 py-6 items-center">

            <div class="flex items-center justify-center px-12">
                <button type="button" class="text-black border border-black bg-white- hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 focus:bg-gray-100 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" style="transform: rotate(-180deg); transform-origin: center;">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
                <span class="m-2 rounded-md text-xs">Page 1 of 100</span>
                <button type="button" class="text-black border border-black bg-white- hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 focus:bg-gray-100 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                    <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </button>
            </div>
            <div>
                <button id="dropdownRightEndButton" data-dropdown-toggle="10" data-dropdown-placement="right-end"
                class="mb-3 md:mb-0 border border-black text-black bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium
                text-xs px-5 py-2.5 text-center inline-flex items-center" type="button">10
                <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownRightEnd" class="z-10 hidden fixed border border-black bg-white shadow w-16">
                    <ul class="text-sm text-black" aria-labelledby="dropdownRightEndButton">
                    <li>
                        <a href="#" class="block text-center py-2 border border-gray-300 hover:bg-gray-100">1</a>
                    </li>
                    <li>
                        <a href="#" class="block text-center py-2 border border-gray-300 hover:bg-gray-100">2</a>
                    </li>
                    <li>
                        <a href="#" class="block text-center py-2 border border-gray-300 hover:bg-gray-100">3</a>
                    </li>
                    <li>
                        <a href="#" class="block text-center py-2 border border-gray-300 hover:bg-gray-100">...</a>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<aside id="default-display" class="hidden fixed top-0 right-0 z-40 w-1/2 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow" aria-label="display">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
        <div>
            <div class="flex px-4 items-start justify-between py-4">
                <div class="flex items-start">
                    {{-- Close Button --}}
                    <button id="default-display-button" type="button" style="transform: rotate(-180deg);"
                    class="text-black border border-black bg-white hover:bg-gray-300 focus:ring-4
                    focus:outline-none focus:ring-gray-300 focus:bg-gray-100 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center">
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex px-4 items-start justify-between py-4">
                <div class="flex items-start">
                    <a href="#" class="flex text-3xl font-semibold text-gray-900">
                        Title
                    </a>
                </div>
            </div>

            <div class="flex flex-row justify-between gap-2 mt-4 items-start mb-4 px-4">
                <div class="flex justify-center items-center">
                    <div>
                        <span class="text-gray-900 text-xl font-extrabold">Pengirim</span>
                        <br />
                        <span class="text-xs text-gray-600">Tanggal</span>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col gap-3 items-start">
                        <div>
                            <span class="text-md font-extrabold">Status</span>
                        </div>
                        <div class="bg-white border border-black px-4 py-2">
                            <span class="text-md font-extrabold">Rejected</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div>
            <div class="items-center mt-4">
                <div>
                    <p class="px-3 m-2">Laporan Singkat: Kerusakan Jalan di [Nama Lokasi]</p>
                    <p class="px-3 m-2">Tanggal: [Tanggal Laporan]</p>
                    <p class="px-3 m-2">Lokasi: [Alamat atau Nama Jalan]</p>
                </div>
                <div>
                    <p class="px-3 m-2">
                        Jenis Kerusakan:
                    </p>
                    <br>
                    <p class="px-3 m-2">
                        <br>. Permukaan Jalan: Terdapat sejumlah lubang dan retakan yang mengganggu
                        kelancaran lalu lintas. Kerusakan ini cukup parah, dengan beberapa lubang
                        mencapai kedalaman hingga 15 cm.
                        . Paving Blok: Beberapa paving blok terlepas dan bergeser, menciptakan area
                        yang tidak rata dan berpotensi membahayakan kendaraan serta pejalan kaki.
                        . Saluran Drainase: Saluran drainase terlihat tersumbat oleh sampah dan tanah,
                        menyebabkan genangan air saat hujan yang memperburuk kerusakan pada
                        permukaan jalan.
                    </p>
                    <br>
                    <p class="px-3 m-2">
                        Dampak Kerusakan:
                    </p>
                    <p class="px-3 m-2">
                        <br>· Lalu Lintas: Peningkatan risiko kecelakaan dan kemacetan lalu lintas. Pengemudi
                        harus memperlambat kendaraan, menyebabkan penurunan kecepatan rata-rata
                        di area tersebut.
                        · Keamanan: Peningkatan risiko kecelakaan bagi pengendara motor dan pejalan
                        kaki. Lubang dan permukaan yang tidak rata dapat menyebabkan terjadinya
                        kecelakaan.
                        · Ekonomi: Kerusakan jalan dapat menghambat distribusi barang dan jasa, serta
                        mempengarubi kegiatan ekonomi lokal
                    </p>
                </div>
                <div>
                    <div class="mx-auto relative w-full h-64">
                        <img
                            src="https://dummyimage.com/600x400/000/fff"
                            alt="Descriptive Alt Text"
                            class="absolute p-4 inset-0 w-full h-full object-cover rounded-sm"
                        />
                    </div>
                </div>
            </div>
        </div>
   </div>
</aside>

<script>
    // Post Display
    document.addEventListener('DOMContentLoaded', function() {
        const actionButtons = document.querySelectorAll('.action-button');
        const sidePanel = document.getElementById('default-display');
        const closeButton = document.getElementById('default-display-button');

        actionButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                sidePanel.classList.toggle('hidden');
            });
        });

        closeButton.addEventListener('click', function() {
            sidePanel.classList.add('hidden');
        });
    });

    // Pagination Dropdown
    document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownRightEndButton');
    const dropdownMenu = document.getElementById('dropdownRightEnd');

    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });
});
</script>

@endsection
