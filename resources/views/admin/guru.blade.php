@extends('layouts.main')
@section('container')
<div onclick="openPopup()" class="inline text-white w-max bg-pink-600 hover:bg-pink-700 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2"><svg class="w-5 h-5 text-gray-800 dark:text-white inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
  </svg>Tambah</div>
<div onclick="openBulk()" id="openButton" class="inline text-white w-max bg-pink-600 hover:bg-pink-700 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2"><svg class="w-5 h-5 text-gray-800 dark:text-white inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
  </svg>Masal</div>
  <button disabled type="button" id="loadButton" class="hidden inline text-white w-max bg-pink-600 hover:bg-pink-700 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2">
    <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#65a30d"/>
    </svg>
    Memuat file...
    </button>
  
<div class="mt-3 grid grid-cols-1 sm:grid-cols-3 justify-align-center gap-3">

    @foreach ($teachers as $guru)
        <span class="block max-w-full p-6 bg-white border-gray-800 rounded-lg shadow-md">
        
        <h5 class="mb-2 text-xl font-bold tracking-tight text-pink-600 dark:text-white">{{ ucwords($guru->name) }}</h5>
        <p class="italic text-sm text-lime-600">{{ $guru->user()->first()->email }}</p>
        <?php
        $gurus = $guru->room
        ?>
        @if ($gurus->count()>0)
            @foreach ($gurus->sortBy('createdAt')->take(3)->reverse() as $kelas)
            <a href="/kelas/{{ $kelas->class_code }}" class="italic inline text-sm text-gray-700 text-lime-600">{{$kelas->name }}</a>                
            @endforeach
        @else
            <p class="italic inline text-sm text-gray-700 text-lime-600">Belum ada kelas 
                <a href="/guru/hapus/{{ $guru->nip }}" class="bg-red-700 rounded text-sm text-white hover:bg-red-800 hover:cursor  py-1 px-2">Hapus</a></p>               
        @endif
        </span> 
    @endforeach
</div>
<div id="popup" class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
    <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
        <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Tambah Guru</h1>
        <form action="/guru/tambah" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama Guru" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <input type="text" name="arabic" placeholder="Nama Arab" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <input type="text" name="email" placeholder="Email" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <input type="text" name="nip" placeholder="NIP" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <input type="submit" value="Tambah" class="rounded-lg bg-white border border-1 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
            <div onclick="closePopup()" class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
        </form>
    </div>
</div>
<div id="bulk" class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
    <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
        <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Tambah Masal</h1>
        <form action="/guru/tambah" id="ubah" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="user_data" class="cursor-pointer block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Data Guru
                (CSV file) >></label>
            <input type="file" id="user_data" class="hidden" name="user_data" required>
            <div class="my-1 text-sm text-gray-500" id="user_avatar_help">Gunakan template berikut <a
                download="Data Guru - {{ substr(uniqid(),-4) }}.csv" href="{{ Storage::url('data/dat.csv') }}" class="text-lime-600 hover:underline">(disini)</a></div>
            <div onclick="closeBulk()" class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
        </form>
    </div>
</div>
<script>
    function openPopup(){
        document.getElementById('popup').classList.remove('hidden')
    }
    function openBulk(){
        document.getElementById('bulk').classList.remove('hidden')
    }
    function closeBulk(){
        document.querySelector('input[name="user_data"]').files = new DataTransfer().files
        document.getElementById('bulk').classList.add('hidden')
    }
    function closePopup(){
        document.querySelector('input[name="name"]').value=""
        document.querySelector('input[name="arabic"]').value=""
        document.querySelector('input[name="nip"]').value=""
        document.getElementById('popup').classList.add('hidden')
    }
    document.querySelector('#ubah').addEventListener('change',function(){
        document.getElementById('bulk').classList.add('hidden')
        document.getElementById('openButton').classList.add('hidden')
        document.getElementById('loadButton').classList.remove('hidden')
        document.querySelector('#ubah').submit()

    })
</script>

@endsection