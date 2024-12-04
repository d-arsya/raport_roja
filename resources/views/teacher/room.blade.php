@extends('layouts.main')
@section('container')
    @foreach ($rooms as $room)
        @php
            $students = $room->students();
        @endphp
        <div class="p-4 bg-pink-600 rounded-lg">
            <h1 class="text-3xl font-bold text-white">Data Kelas</h1>
            <div class="mt-4">
                <h1 class="text-md font-semibold text-white">Nama : {{ $room->name }}</h1>
                <h1 class="text-md font-semibold text-white">Siswa : {{ $students->count() }} Siswa</h1>
                <h1 class="text-md font-semibold text-white">Pengampu : {{ ucwords($room->teacher->name) }}</h1>
            </div>
        </div>
        <div onclick="openPopup('{{ $students[0]->group_id }}')"
            class="rounded-lg bg-lime-600 hover:bg-lime-700 p-2 w-min my-2 text-white cursor-pointer">
            Tambah</div>
        <div class="bg-pink-600 p-2 text-white font-semibold text-xl text-center rounded-t-lg">Anggota Kelas</div>
        <div class="grid grid-cols-1 md:grid-cols-4 mb-12">
            @for ($i = 0; $i < $students->count(); $i++)
                <div class="py-1 border border-px border-pink-600">
                    <h1 class="text-center">{{ ucwords($students[$i]->name) }}</h1>
                    <h1 class="text-center">{{ $students[$i]->nis }}</h1>
                </div>
            @endfor
            </div>
    @endforeach
    <div id="popup"
        class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
        <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
            <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Tambah Siswa</h1>
            <form action="/siswa/tambah" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Nama Siswa"
                    class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="text" name="arabic" placeholder="Nama Arab"
                    class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="text" name="nis" placeholder="NIS"
                    class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="submit" value="Tambah"
                    class="rounded-lg bg-white border border-1 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
                <input type="text" class="hidden" name="grup">
                <div onclick="closePopup()"
                    class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
            </form>
        </div>
    </div>
    <script>
        function openPopup(groupCode) {
            document.getElementById('popup').classList.remove('hidden')
            document.querySelector('input[name="grup"]').value = groupCode
        }

        function closePopup() {
            document.querySelector('input[name="name"]').value = ""
            document.querySelector('input[name="arabic"]').value = ""
            document.querySelector('input[name="nis"]').value = ""
            document.getElementById('popup').classList.add('hidden')
        }
    </script>
@endsection
