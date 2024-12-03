@extends('layouts.main')
@section('container')
@if ($active=='kelas')
<div class="p-4 bg-pink-600 rounded-lg mb-3">
    <h1 class="text-3xl font-bold text-white">Data Kelas</h1>
    <div class="mt-4">
        <h1 class="text-md font-semibold text-white">Nama : {{ $room->name }}</h1>
        <h1 class="text-md font-semibold text-white">Siswa : {{ $students->count() }} Siswa</h1>
        <h1 class="text-md font-semibold text-white">Pengampu : {{ $room->teacher->name }}</h1>
    </div>
</div>    
@endif
<input type="text" class="w-full p-3 mb-4 rounded-lg text-medium text-pink-600 border border-px border-pink-600 ring-pink-600" placeholder="Cari...">
<div class="bg-pink-600 p-2 text-white font-semibold text-xl text-center rounded-t-lg">Daftar Santri</div>
<div class="grid grid-cols-2 md:grid-cols-5">
@foreach ($students as $student)
    <div class="py-1 border border-px border-pink-600">
        <h1 class="text-center">{{ ucwords($student->name) }}</h1>
        <h1 class="text-center">{{ $student->nis }}(<a href="/grup/{{ $student->group->name }}">{{ $student->group->name }}</a>)</h1>
    </div>
    
    @endforeach
</div>
<div class="p-5 text-bold">
    {{ $students->links() }}

</div>
@endsection