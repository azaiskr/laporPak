@extends('layouts.admin')

@section('content')
<div class="px-12 py-6 flex flex-col gap-3">
    <div class="w-full bg-white px-4 py-2">Dashboard</div>
    <div class="w-full bg-white p-4">
        <div class="flex gap-4">
            <div class="w-full shadow p-4 rounded-2xl">
                <div>Laporan Hari Ini</div>
                <div>20</div>
            </div>
            <div class="w-full shadow p-4 rounded-2xl">
                <div>Total Laporan</div>
                <div>320</div>
            </div>
        </div>
    </div>
</div>
@endsection
