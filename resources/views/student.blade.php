@extends('layouts.main')
@section('container')
    <h1 class="text-lime-600 text-xl font-semibold">Ahlan Wa Sahlan,</h1>
    <h1 class="text-pink-600 text-4xl font-bold">{{ ucwords($student->name) }}</h1>
    <h1 class="text-pink-600 text-2xl font-bold">{{ $student->name_arabic }}</h1>
    <h1 class="text-pink-600 text-lg italic mb-4">{{ $student->nis }} <svg onclick="openPopup()" class="inline" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
      </svg> </h1>
    <div class="p-4 bg-pink-600 rounded-lg">
        <h1 class="text-3xl font-bold text-white">Data Kelas</h1>
        <div class="mt-4">
            <h1 class="text-md font-semibold text-white">Nama : {{ $room->name }}</h1>
            <h1 class="text-md font-semibold text-white">Siswa : {{ $students->count() }} Siswa</h1>
            {{-- {{ dd($room->teacher) }} --}}
            <h1 class="text-md font-semibold text-white">Pengampu : {{ ucwords($room->teacher->name) }}</h1>
        </div>
    </div>
    <div class="bg-pink-600 p-2 text-white font-semibold text-xl text-center mt-2 rounded-t-lg">Teman Kelas</div>
    <div class="grid grid-cols-1 md:grid-cols-4">
        @foreach ($students as $student)
        <div class="py-1 border border-px border-pink-600">
            <h1 class="text-center">{{ ucwords($student->name) }}</h1>
        </div>        
        @endforeach
    
    </div>
    @if ($errors->any())
    <div id="popup" class="fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
        <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
            <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Ubah Password</h1>
            <form action="/user/edit" method="POST">
                @csrf
                <input type="password" name="old" placeholder="Password lama" class="w-full mt-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                @error('old')
                <p class="italic text-xs text-red-500">{{ $message }}</p>
                
                @enderror
                <input type="password" name="new" placeholder="Passord baru" class="w-full mt-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                @error('new')
                <p class="italic text-xs text-red-500">{{ $message }}</p>
                    
                @enderror
                <input type="password" name="confirm" placeholder="Konfirmasi password" class="w-full mt-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="submit" value="Ubah Sandi" class="rounded-lg bg-white border border-1 mt-4 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
                <div onclick="closePopup()" class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
            </form>
        </div>
    </div>      
    @else 
    <div id="popup" class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
        <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
            <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Ubah Password</h1>
            <form action="/user/edit" method="POST">
                @csrf
                <input type="password" name="old" placeholder="Password lama" class="w-full mt-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="password" name="new" placeholder="Passord baru" class="w-full mt-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="password" name="confirm" placeholder="Konfirmasi password" class="w-full mt-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="submit" value="Ubah Sandi" class="rounded-lg bg-white border border-1 mt-4 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
                <div onclick="closePopup()" class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
            </form>
        </div>
    </div>    
    @endif
    <script>
        function openPopup(){
            document.getElementById('popup').classList.remove('hidden')
        }
        function closePopup(){
            document.querySelector('input[name="old"]').value=""
            document.querySelector('input[name="new"]').value=""
            document.querySelector('input[name="confirm"]').value=""
            document.getElementById('popup').classList.add('hidden')
        }
    </script>
@endsection