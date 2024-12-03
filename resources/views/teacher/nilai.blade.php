@extends('layouts.main')
@section('container')
<div class="p-4 bg-pink-600 rounded-lg">
    <h1 class="text-3xl font-bold text-white">Data Kelas</h1>
    <div class="mt-4">
        <h1 class="text-md font-semibold text-white">Nama : {{ $room->name }}</h1>
        <h1 class="text-md font-semibold text-white">Siswa : {{ $room->students()->count() }} Siswa</h1>
        <h1 class="text-md font-semibold text-white">Pengampu : {{ ucwords($room->teacher->name) }}</h1>
    </div>
</div>
@if ($room->course==0)
<h1 class="text-center text-xl font-semibold italic mt-36">Silahkan simpan permanen daftar pelajaran terlebih dahulu</h1>
<a href="/pelajaran" class="text-center block bg-pink-600 p-2 text-white text-xl mt-3 hover:bg-pink-700 rounded-lg w-min m-auto">Pelajaran</a>
@else   
<div class="hover:bg-lime-800 bg-lime-600 text-white p-2 rounded-b-md text-md text-center font-bold mt-5">
    Semester 1
</div>
<div class="bg-pink-600 text-white rounded-t-md p-4 text-2xl text-center font-semibold mt-5">
Berdasarkan Mapel
</div>
<div class="grid grid-cols-2 md:grid-cols-6">
    @foreach ($courses as $course)
            <a href="/nilai/kelas/{{ $room->class_code }}/pelajaran/{{ $course->id }}/semester/{{ $room->semester }}" class="border border-px border-pink-600 hover:bg-pink-600 text-center text-pink-600 hover:text-white font-medium text-lg">{{ ucwords($course->name) }}</a>
    @endforeach
</div>
<div class="bg-pink-600 text-white rounded-t-md p-4 text-2xl text-center font-semibold mt-5">
Berdasarkan Siswa
</div>
<div class="grid grid-cols-1 md:grid-cols-6">
    @foreach ($students as $student)
            <a href="/nilai/kelas/{{ $room->class_code }}/siswa/{{ $student->nis }}/semester/{{ $room->semester }}" class="border border-px border-pink-600 hover:bg-pink-600 text-center text-pink-600 hover:text-white font-medium text-lg">{{ ucwords($student->name )}}</a>
    @endforeach
</div>
<div class="hover:bg-lime-800 bg-lime-600 text-white p-2 rounded-b-md text-md text-center font-bold mt-24">
    Semester 2
</div>
<div class="bg-pink-600 text-white rounded-t-md p-4 text-2xl text-center font-semibold mt-5">
Berdasarkan Mapel
</div>
<div class="grid grid-cols-2 md:grid-cols-6">
    @foreach ($courses as $course)
            <a href="/nilai/kelas/{{ $room->class_code }}/pelajaran/{{ $course->id }}/semester/{{ $room->semester+1 }}" class="border border-px border-pink-600 hover:bg-pink-600 text-center text-pink-600 hover:text-white font-medium text-lg">{{ ucwords($course->name) }}</a>
    @endforeach
</div>
<div class="bg-pink-600 text-white rounded-t-md p-4 text-2xl text-center font-semibold mt-5">
Berdasarkan Siswa
</div>
<div class="grid grid-cols-1 md:grid-cols-6">
    @foreach ($students as $student)
            <a href="/nilai/kelas/{{ $room->class_code }}/siswa/{{ $student->nis }}/semester/{{ $room->semester+1 }}" class="border border-px border-pink-600 hover:bg-pink-600 text-center text-pink-600 hover:text-white font-medium text-lg">{{ ucwords($student->name) }}</a>
    @endforeach
</div>
@endif
@endsection