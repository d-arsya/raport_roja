@extends('layouts.main')
@section('container')
<div class="p-4 bg-pink-600 rounded-lg">
    <h1 class="text-3xl font-bold text-white">Data Nilai</h1>
    <div class="mt-4">
        <h1 class="text-md font-semibold text-white">Nama : {{ ucwords($student->name) }}</h1>
        <h1 class="text-md font-semibold text-white">NIS : {{ $student->nis }}</h1>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 w-full gap-3 mt-5">
    @for ($i = 1; $i <= 6; $i++)
        <a href="/nilai/siswa/semester/{{ $i }}" class="bg-pink-600 rounded-md text-center p-5 text-white font-bold hover:bg-pink-700">Semester {{ $i }}</a>
    @endfor
</div>

@endsection