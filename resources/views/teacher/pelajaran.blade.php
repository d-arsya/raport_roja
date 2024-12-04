@extends('layouts.main')
@section('container')
@if (session('success'))
    <div id="alert-1" class="flex items-center p-4 my-4 text-blue-800 rounded-lg bg-blue-50" role="alert">
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
            class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-lime-600 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:hover:bg-gray-700"
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
    @foreach ($rooms as $room)
        @php
            $courses = App\Models\ClassCourse::where('class_code', $room->class_code)->get();
        @endphp
        <h1 class="text-center font-bold text-2xl mb-6">Pelajaran {{ $room->name }}</h1>
        @if ($room->course == 0)
            <div onclick="openPopup('{{ $room->class_code }}')"
                class="inline mt-5 w-max text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2">
                <svg class="w-5 h-5 text-gray-800 dark:text-white inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>Tambah
            </div>
            <a href="/pelajaran/permanen/{{ $room->class_code }}"
                class="inline w-max text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2">Permanen
            </a>
        @endif
        <table class="w-full mt-4 mb-36">
            <thead class="text-xs text-white uppercase bg-pink-600">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-ss-lg">
                        Nama Pelajaran
                    </th>
                    <th scope="col" class="hidden md:table-cell px-6 py-3">
                        Nama Arab
                    </th>
                    <th scope="col" class="hidden md:table-cell px-6 py-3">
                        Jenis
                    </th>
                    <th scope="col" class="px-6 py-3 rounded-se-lg">
                        KKM
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="bg-white border-1 border-grey-900 dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            @if ($room->course == 0)
                                <a class="text-red-600" href="/pelajaran/hapus/kelas/{{ $course->id }}"><img
                                        class="inline" src="{{ Storage::url('assets/trash.svg') }}" alt=""> </a>
                            @endif
                            {{ $course->name }}
                        </td>
                        <td class="px-6 py-4 text-end hidden md:table-cell">
                            {{ $course->name_arabic }}
                        </td>
                        <td class="px-6 py-4 text-center hidden md:table-cell">
                            {{ $course->varian }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($room->course == 0)
                                <form action="/pelajaran/ubah/kelas" method="POST">
                                    @csrf
                                    <input type="number" name="id" class="hidden" value="{{ $course->id }}">
                                    <input type="text" class="w-10 text-center rounded-lg bg-slate-300" maxlength="2"
                                        name="kkm" value="{{ $course->kkm }}" id="">
                                    <input type="submit" value="Ubah"
                                        class="hover:text-white hover:bg-pink-600 font-semibold text-xs p-1 rounded-md">
                                </form>
                            @else
                                {{ $course->kkm }}
                            @endif
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
        @endforeach
        <div id="popup"
            class="hidden fixed bg-black top-0 left-0 z-50 w-full h-full flex justify-center items-center bg-opacity-60">
            <div class="rounded-md w-96 bg-white px-10 py-4 absolute">
                <h1 class="text-3xl font-bold mb-4 text-center text-pink-600">Tambah Pelajaran</h1>
                <form action="/pelajaran/tambah/kelas" method="POST">
                    @csrf
                    <input type="text" class="hidden" name="class_code">
                    <input type="text" name="name" placeholder="Nama Pelajaran"
                        class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                    <input type="text" name="arabic" placeholder="Nama Arab"
                        class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                    <input type="number" name="kkm" placeholder="KKM"
                        class="w-full mb-4 border border-1 border-grey-200 p-2 rounded-lg" id="">
                    <select name="varian"
                        class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-600 focus:border-lime-600 block w-full p-2.5">
                        <option value="akademik">Akademik</option>
                        <option value="agama">Agama</option>
                    </select>
                    <input type="submit" value="Tambah"
                        class="rounded-lg bg-white border border-1 border-pink-600 hover:bg-pink-600 w-full p-3 text-pink-600 hover:text-white font-semibold cursor-pointer">
                    <div onclick="closePopup()"
                        class="text-center w-full p-3 text-red-600 hover:text-red-400 font-semibold cursor-pointer">Batal
                    </div>
                </form>
            </div>
        </div>
        <script>
            function openPopup(classCode) {
                document.getElementById('popup').classList.remove('hidden')
                document.querySelector('input[name="class_code"]').value = classCode
            }

            function closePopup() {
                document.querySelector('input[name="name"]').value = ""
                document.querySelector('input[name="arabic"]').value = ""
                document.querySelector('input[name="kkm"]').value = ""
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
