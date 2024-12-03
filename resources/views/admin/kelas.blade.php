@extends('layouts.main')
@section('container')
    <div onclick="openPopup()" class="text-white bg-pink-600 hover:bg-pink-700 w-max font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 cursor-pointer"><svg
            class="w-5 h-5 text-gray-800 inline" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
        </svg>Tambah</div>
        @if (session('success'))
    <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
          {{ session('success') }}
        </div>
            
          <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
      </div>
        @endif
    <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 justify-align-center gap-3">
        @foreach ($rooms as $kelas)
            <span
                class="block max-w-full p-6 bg-white rounded-lg shadow-lg">
                <?php $jumlah = $kelas->students()->count(); ?>
                <a href="/kelas/{{ $kelas->class_code }}"
                    class="hover:text-gray-400 mb-2 text-xl font-bold tracking-tight text-pink-600">{{ $kelas->name }}</a>
                <a href="/kelas/hapus/{{ $kelas->class_code }}"
                    class="inline {{ $jumlah <= 0 ? 'visible' : 'invisible' }} text-xs">Hapus</a>
                <p class="italic text-sm text-lime-600">{{ $jumlah }} Murid</p>
                <p class="italic text-sm text-lime-600">Diampu oleh :
                    {{ $kelas->teacher ? ucwords($kelas->teacher->name):'LULUS' }}</p>
                @if ($kelas->teacher->name ?? false)
                    <form action="/kelas/edit/guru" id="ubah" method="post" class="max-w-sm mx-auto mt-3">
                        @csrf
                        <input type="hidden" name="class_code" value="{{ $kelas->class_code }}">
                        <select name="nip"
                            class="bg-gray-50 border border-gray-300 text-pink-600 text-sm rounded-lg focus:ring-pink-600 focus:border-pink-600 block w-full p-2.5">
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->nip }}"
                                    @if ($kelas->teacher->name == $teacher->name) {{ 'selected' }} @endif>{{ ucwords($teacher->name) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </span>
        @endforeach
    </div>
<div id="popup" class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
    <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
        <h1 class="text-3xl font-bold mb-4 text-center">Tambah Kelas</h1>
        <form action="/kelas/tambah" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama Kelas" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <input type="text" name="arabic" placeholder="Nama Arab" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <input type="number" name="semester" placeholder="Semester" class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
            <select name="nip" id="guru" class="bg-gray-50 mb-8 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Guru</option>
                @foreach ($avail as $guru)
                    <option value="{{ $guru->nip }}">{{ ucwords($guru->name) }}</option>
                @endforeach
              </select>
            <input type="submit" value="Tambah" class="rounded-lg bg-white border border-1 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
            <div onclick="closePopup()" class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
        </form>
    </div>
</div>
<script>
    function openPopup(){
        document.getElementById('popup').classList.remove('hidden')
    }
    function closePopup(){
        document.querySelector('input[name="name"]').value=""
        document.querySelector('input[name="arabic"]').value=""
        document.querySelector('input[name="semester"]').value=""
        document.getElementById('popup').classList.add('hidden')
    }
    document.querySelector('#ubah').addEventListener('change',function(e){
            document.querySelector('#ubah').submit()
        })
    document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('[aria-label="Close"]').forEach(button => {
    button.addEventListener('click', function() {
      const alert = button.closest('[role="alert"]');
      if (alert) {
        alert.remove();
      }
    });
  });
});
</script>
@endsection
