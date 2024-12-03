@extends('layouts.main')
@section('container')
    <div id="openButton" onclick="openPopup()"
        class="w-max text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
        <svg class="w-5 h-5 text-gray-800 dark:text-white inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
        </svg>Tambah
    </div>
    <button disabled type="button" id="loadButton"
        class="hidden inline text-white w-max bg-pink-600 hover:bg-pink-700 font-medium rounded-lg text-sm px-3 py-1.5 me-2 mb-2">
        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600"
            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor" />
            <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="#65a30d" />
        </svg>
        Memuat file...
    </button>
    @if (session('success'))
        <div id="alert-1"
            class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>

            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-lime-600 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 justify-align-center gap-3">

        @foreach ($groups as $group)
            @if ($group->name != 'ALUMNI')
                <span class="block max-w-full p-6 bg-white rounded-lg shadow-md">

                    <a href="/grup/{{ $group->name }}"
                        class="hover:text-gray-200 mb-2 text-xl font-bold tracking-tight text-pink-600 dark:text-white">{{ $group->name }}
                        ({{ $group->students->count() }} Siswa)
                    </a>
                    <form action="/grup/edit/kelas" class="ubah" method="post" class="max-w-sm mx-auto mt-3">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <select name="class_code" id="countries"
                            class="bg-gray-50 border border-gray-300 text-lime-600 text-sm rounded-lg focus:ring-lime-600 focus:border-lime-600 block w-full p-2.5">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->class_code }}"
                                    @if ($room->name == $group->room->name) {{ 'selected' }} @endif>{{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </span>
            @endif
        @endforeach
    </div>
    <div id="popup"
        class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
        <div class="rounded-md w-80 md:w-96 bg-white px-10 py-4 absolute">
            <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Tambah Grup Siswa</h1>
            <form onsubmit="sub()" id="formPop" action="/grup/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nama Grup"
                    class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <input type="text" name="year" placeholder="Tahun Masuk"
                    class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                <select name="room"
                    class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-600 focus:border-lime-600 block w-full p-2.5">

                    @foreach ($avail as $room)
                        <option value="{{ $room->class_code }}">{{ $room->name }}</option>
                    @endforeach
                </select>
                <label for="user_data" class="cursor-pointer block mb-2 text-sm font-medium text-gray-900"
                    for="user_avatar">Data Siswa
                    (CSV file) >></label>
                <input type="file" id="user_data" class="hidden" name="user_data" required>
                <div class="my-1 text-sm text-gray-500" id="user_avatar_help">Gunakan template berikut (<a
                        download="Data Grup Siswa - {{ substr(uniqid(), -4) }}.csv" class="text-lime-600"
                        href="{{ Storage::url('data/dat.csv') }}">disini</a>)</div>
                <input type="submit" value="Tambah"
                    class="rounded-lg bg-white border border-1 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
                <div onclick="closePopup()"
                    class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal</div>
            </form>
        </div>
    </div>
    <script>
        let formUbah = document.querySelectorAll('.ubah')

        function openPopup() {
            document.getElementById('popup').classList.remove('hidden')
        }

        function closePopup() {
            document.querySelector('input[name="name"]').value = ""
            document.querySelector('input[name="year"]').value = ""
            document.querySelector('input[name="user_data"]').files = new DataTransfer().files
            document.getElementById('popup').classList.add('hidden')
        }
        formUbah.forEach(function(e) {
            e.addEventListener('change', function(f) {
                f.currentTarget.submit()
                // f.target.submit()
            })
        })

        function sub() {
            document.getElementById('openButton').classList.add('hidden')
            document.getElementById('loadButton').classList.remove('hidden')
            document.getElementById('popup').classList.add('hidden')
        }
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
