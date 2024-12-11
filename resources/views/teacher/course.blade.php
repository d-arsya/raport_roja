@extends('layouts.main')
@section('container')
    <div class="p-4 bg-pink-600 rounded-lg mb-3">
        <h1 class="text-3xl font-bold text-white">Data Nilai</h1>
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="mt-4">
                <h1 class="text-md font-semibold text-white">Kelas : {{ $room->name }}</h1>
                <h1 class="text-md font-semibold text-white">Mapel : {{ $course->name }}</h1>
                <h1 class="text-md font-semibold text-white">Semester : {{ $semester % 2 == 0 ? 'Genap' : 'Ganjil' }}</h1>
                <h1 class="text-md font-semibold text-white">KKM : {{ $course->kkm }}</h1>
            </div>
            <div class="mt-4">
                <h1 class="text-md font-semibold text-white">Tertinggi : {{ $grades->max('grade') }}</h1>
                <h1 class="text-md font-semibold text-white">Terendah : {{ $grades->min('grade') }}</h1>
                <h1 class="text-md font-semibold text-white">Rata-rata : {{ round($grades->avg('grade'), 2) }}</h1>
            </div>

        </div>
    </div>
    <label for="csvFile"
        class="w-max text-white bg-lime-600 hover:bg-lime-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2">
        <svg class="w-5 h-5 text-gray-800 inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
        </svg>Tambah
    </label>
    <a
                download="Nilai {{$course->name}} - {{ substr(uniqid(),-4) }}.csv" href="{{ Storage::url('data/nilai.csv') }}" class="w-max text-white bg-lime-600 hover:bg-lime-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2">Template Nilai</a>
    <input type="file" class="hidden" accept="csv" name="csvFile" id="csvFile">
    <table class="w-full mt-5">
        <thead class="bg-pink-600">
            <th class="rounded-ss-lg py-2 text-lg text-white font-semibold">Nama</th>
            <th class="hidden md:table-cell py-2 text-lg text-white font-semibold">NIS</th>
            <th class="rounded-se-lg py-2 text-lg text-white font-semibold w-min">Nilai</th>
        </thead>
        <tbody>
            <form action="/nilai/kelas/{{ $room->class_code }}/pelajaran/{{ $course->id }}/semester/{{ $semester }}"
                method="POST">
                @csrf
                @foreach ($students as $key => $student)
                    <tr>
                        <td class="border border-px border-pink-600 py-2 px-4">{{ ucwords($student->name) }}</td>
                        <td class="hidden md:table-cell text-center border border-px border-pink-600">{{ $student->nis }}
                        </td>
                        <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2"><input
                                class="rounded-md bg-lime-100 w-full text-center font-semibold"
                                value="{{ $grades[$key]->grade ?? 0 }}" type="number" name="{{ $student->nis }}"
                                max="100" id=""></td>
                    </tr>
                @endforeach
        </tbody>
    </table>
    <input type="submit" value="Simpan"
        class="w-full rounded-md bg-pink-600 p-3 mt-16 text-white font-bold text-xl cursor-pointer hover:bg-pink-700">
    </form>
    <a href="/nilai"
        class="w-full rounded-md bg-red-600 p-3 mt-10 block text-center text-white font-bold text-xl cursor-pointer hover:bg-red-700">Kembali</a>
    <script>
        let csvFile = document.querySelector('#csvFile')
        csvFile.addEventListener('change', function(e) {
            let file = e.target.files[0]
            const reader = new FileReader();

            reader.onload = function(event) {
                const csvData = event.target.result;
                processCSV(csvData);
            };

            reader.readAsText(file);
        })

        function processCSV(csvData) {
            const lines = csvData.split('\n');

            lines.forEach(line => {
                const [number, value] = line.split(';');

                if (number && value) {
                    const input = document.querySelector(`input[name="${number.trim()}"]`);
                    if (input) {
                        input.value = value.trim();
                    }
                }
            });
            csvFile.files = new DataTransfer().files
        }
    </script>
@endsection
