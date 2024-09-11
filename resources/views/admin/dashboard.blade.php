@extends('layouts.admin')

@section('content')
<div class="grid gap-8 md:grid-cols-2 lg:gap-12 p-6 md:p-10">
    <a href="#" class="flex flex-col p-6 space-y-6 transition-all duration-500 bg-white border border-indigo-100 rounded-lg shadow hover:shadow-xl lg:p-8 lg:flex-row lg:space-y-0 lg:space-x-6">
        <div class="flex-1">
            <h5 class="mb-3 text-xl font-bold lg:text-2xl">Laporan Hari Ini</h5>
            <p class="mb-6 text-lg text-gray-600">20</p>
        </div>
    </a>
    <a href="#" class="flex flex-col p-6 space-y-6 transition-all duration-500 bg-white border border-indigo-100 rounded-lg shadow hover:shadow-xl lg:p-8 lg:flex-row lg:space-y-0 lg:space-x-6">
        <div class="flex-1">
            <h5 class="mb-3 text-xl font-bold lg:text-2xl">Total Laporan</h5>
            <p class="mb-6 text-lg text-gray-600">320</p>
        </div>
    </a>
</div>
@endsection
