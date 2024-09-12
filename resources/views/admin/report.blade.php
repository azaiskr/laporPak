@extends('layouts.admin')

@section('content')
<div class="px-12 py-6 flex flex-col gap-3">
    <div class="w-full bg-white p-4">Laporan</div>
    <div class="w-full bg-white p-4">
        <table class="w-full">
            <thead class="w-full">
                <tr>
                    <th class="px-3 py-1">Judul</th>
                    <th class="px-3 py-1">Pengirim</th>
                    <th class="px-3 py-1">Tanggal</th>
                    <th class="px-3 py-1">Status</th>
                    <th class="px-3 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-3 py-2">Kebanjiran di daerah A yang telah merusak 2 rumah warna</td>
                    <td class="px-3 py-2">Budi Partno</td>
                    <td class="px-3 py-2 text-center">2024 - 11 - 09</td>
                    <td class="px-3 py-2 text-center">Terverivikasi</td>
                    <td class="px-3 py-2 text-center">
                        <button>
                            <div class="bg-blue-600 text-white px-4 py-2 rounded">
                                View
                            </div>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-3 py-2">Kebanjiran di daerah A yang telah merusak 2 rumah warna</td>
                    <td class="px-3 py-2">Sumaidah Wiranti</td>
                    <td class="px-3 py-2 text-center">2024 - 12 - 09</td>
                    <td class="px-3 py-2 text-center">Rejected</td>
                    <td class="px-3 py-2 text-center">
                        <button>
                            <div class="bg-blue-600 text-white px-4 py-2 rounded">
                                View
                            </div>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td class="px-3 py-2">Kebanjiran di daerah A yang telah merusak 2 rumah warna</td>
                    <td class="px-3 py-2">Ahmad Agus Prayono</td>
                    <td class="px-3 py-2 text-center">2024 - 08 - 09</td>
                    <td class="px-3 py-2 text-center">On Going</td>
                    <td class="px-3 py-2 text-center">
                        <button>
                            <div class="bg-blue-600 text-white px-4 py-2 rounded">
                                View
                            </div>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
