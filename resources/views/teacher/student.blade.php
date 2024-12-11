@extends('layouts.main')
@section('container')
<div class="p-4 bg-pink-600 rounded-lg">
    <h1 class="text-3xl font-bold text-white">Data Nilai</h1>
    <div class="mt-4">
        <h1 class="text-md font-semibold text-white">Nama : {{ ucwords($student->name) }}</h1>
        <h1 class="text-md font-semibold text-white">Kelas : {{ $room->name }}</h1>
        <h1 class="text-md font-semibold text-white">Rata-rata : {{ round($grades->avg('grade'),2) }}</h1>
        <h1 class="text-md font-semibold text-white">Semester : {{ $semester%2==0?"Genap":"Ganjil" }}</h1>
    </div>
</div>
<div class="flex gap-3 mt-12">
    <form action="{{ route('print-indo') }}" method="POST">
        @csrf
        <input type="hidden" name="nis" value="{{ $student->nis }}">
        <input type="hidden" name="semester" value="{{ $semester }}">
        <button class="bg-lime-600 rounded-md text-center p-2 text-white font-medium hover:bg-lime-700 text-sm" type="submit">Download</button>
    </form>
    <!--<form action="{{ route('print-arab') }}" method="POST">-->
    <!--    @csrf-->
    <!--    <input type="hidden" name="semester" value="{{ $semester }}">-->
    <!--    <button class="bg-lime-600 rounded-md text-center p-2 text-white font-medium hover:bg-lime-700 text-sm" type="submit">Download Arab</button>-->
    <!--</form>-->
</div>
<h1 class="text-2xl bg-lime-600 text-white text-center p-3 rounded-md mt-12 mb-5">Berdasarkan Siswa</h1>
<table class="w-full mt-5">
    <thead class="bg-pink-600">
        <th class="rounded-ss-lg py-2 text-lg text-white font-semibold">Nama</th>
        <th class="hidden md:table-cell py-2 text-lg text-white font-semibold">KKM</th>
        <th class="rounded-se-lg py-2 text-lg text-white font-semibold w-min">Nilai</th>
    </thead>
    <tbody>
        <form action="/nilai/kelas/{{ $room->class_code }}/siswa/{{ $student->nis }}/semester/{{ $semester }}" method="POST">
            @csrf
        @foreach ($courses as $key=>$course)
            <tr>
                <td class="border border-px border-pink-600 py-2 px-4">{{ ucwords($course->name) }}</td>
                <td class="hidden md:table-cell text-center border border-px border-pink-600">{{ $course->kkm }}</td>
                <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2"><input class="rounded-md bg-lime-100 w-full text-center font-semibold" value="{{ $grades[$key]->grade??0 }}" type="number" name="{{ $course->id }}" max="100" id=""></td>
            </tr>
            @endforeach
            <tr>
                <td class="text-center py-4 bg-pink-600 text-lg text-white font-semibold" colspan="3">Ekstrakurikuler</td>
            </tr>
            @foreach (App\Models\ExtraCourse::all() as $key=>$course)
            <tr>
                <td class="border border-px border-pink-600 py-2 px-4" colspan="2">{{ ucwords($course->name) }}</td>
                <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2">
                    <select class="w-full bg-lime-100 text-center p-1 rounded-md" name="extra-{{ $course->id }}" id="">
                        <option value="0">Nilai</option>
                        @if ($extras->count()>0)
                        <option {{ $extras[$key]->grade=='A'?'selected':'' }} value="A">A</option>
                        <option {{ $extras[$key]->grade=='B'?'selected':'' }} value="B">B</option>
                        <option {{ $extras[$key]->grade=='C'?'selected':'' }} value="C">C</option>
                        <option {{ $extras[$key]->grade=='D'?'selected':'' }} value="D">D</option>
                        
                        @else
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        @endif
                    </select>
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="text-center py-4 bg-pink-600 text-lg text-white font-semibold" colspan="3">Akhlak dan Kepribadian</td>
            </tr>
            @foreach (App\Models\Personality::all() as $key=>$course)
            <tr>
                <td class="border border-px border-pink-600 py-2 px-4" colspan="2">{{ ucwords($course->name) }}</td>
                <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2">
                    <select class="w-full bg-lime-100 text-center p-1 rounded-md" name="personality-{{ $course->id }}" id="">
                        <option value="Nilai">Nilai</option>
                        @if ($personalities->count()>0)
                        <option {{ $personalities[$key]->grade=='Sangat Baik'?'selected':'' }} value="Sangat Baik">Sangat Baik</option>
                        <option {{ $personalities[$key]->grade=='Baik'?'selected':'' }} value="Baik">Baik</option>
                        <option {{ $personalities[$key]->grade=='Kurang Baik'?'selected':'' }} value="Kurang Baik">Kurang Baik</option>
                        
                        @else
                        <option value="Sangat Baik">Sangat Baik</option>
                        <option value="Baik">Baik</option>
                        <option value="Kurang Baik">Kurang Baik</option>
                        @endif
                    </select>
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="text-center py-4 bg-pink-600 text-lg text-white font-semibold" colspan="3">Ketidakhadiran</td>
            </tr>
        @foreach (App\Models\Abcent::all() as $key=>$course)
            <tr>
                <td class="border border-px border-pink-600 py-2 px-4" colspan="2">{{ ucwords($course->name) }}</td>
                <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2"><input class="rounded-md bg-lime-100 w-full text-center font-semibold" value="{{ $abcents[$key]->grade??0 }}" type="number" name="abcent-{{ $course->id }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" value="Simpan" class="w-full rounded-md bg-pink-600 p-3 mt-16 text-white font-bold text-xl cursor-pointer hover:bg-pink-700">
</form>
<a href="/nilai" class="w-full rounded-md bg-red-600 p-3 mt-10 block text-center text-white font-bold text-xl cursor-pointer hover:bg-red-700">Kembali</a>

@endsection