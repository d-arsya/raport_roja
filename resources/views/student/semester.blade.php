@extends('layouts.main')
@section('container')
    <div class="p-4 bg-pink-600 rounded-lg">
        <h1 class="text-3xl font-bold text-white">Data Nilai</h1>
        <div class="mt-4">
            <h1 class="text-md font-semibold text-white">Nama : {{ ucwords($student->name) }}</h1>
            <h1 class="text-md font-semibold text-white">Rata-rata : {{ round($grades->avg('grade'),2) }}</h1>
            <h1 class="text-md font-semibold text-white">Semester : {{ $semester % 2 == 0 ? 'Genap' : 'Ganjil' }}</h1>
            <h1 class="text-md font-semibold text-white">Rank : {{ $student->rank($semester)??'-' }}</h1>
        </div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-6 w-full gap-3 mt-5">
        @if ($semester>12)
        @for ($i = 13; $i <= 14; $i++)
            <a href="/nilai/siswa/semester/{{ $i }}"
                class="bg-pink-600 rounded-md text-center p-5 text-white font-bold hover:bg-pink-700">Semester
                {{ $i-12 }}</a>
        @endfor            
        @elseif($semester>6)
        @for ($i = 7; $i <= 12; $i++)
            <a href="/nilai/siswa/semester/{{ $i }}"
                class="bg-pink-600 rounded-md text-center p-5 text-white font-bold hover:bg-pink-700">Semester
                {{ $i-6 }}</a>
        @endfor
        @else
        @for ($i = 1; $i <= 6; $i++)
            <a href="/nilai/siswa/semester/{{ $i }}"
                class="bg-pink-600 rounded-md text-center p-5 text-white font-bold hover:bg-pink-700">Semester
                {{ $i }}</a>
        @endfor
            
        @endif
    </div>
    @if ($grades->count()>0)
    <div class="flex gap-3 mt-12">
        <form action="{{ route('print-indo') }}" method="POST">
            @csrf
            <input type="hidden" name="semester" value="{{ $semester }}">
            <button class="bg-lime-600 rounded-md text-center p-2 text-white font-medium hover:bg-lime-700 text-sm" type="submit">Download</button>
        </form>
        <!--<form action="{{ route('print-arab') }}" method="POST">-->
        <!--    @csrf-->
        <!--    <input type="hidden" name="semester" value="{{ $semester }}">-->
        <!--    <button class="bg-lime-600 rounded-md text-center p-2 text-white font-medium hover:bg-lime-700 text-sm" type="submit">Download Arab</button>-->
        <!--</form>-->
    </div>
        
    
    <h1 class="text-2xl bg-lime-600 text-white text-center p-3 rounded-t-md mt-3">Semester {{ $semester }}</h1>
    <table class="w-full">
        <thead class="bg-pink-600 text-white font-bold text-md">
            <th class="py-2">Nama</th>
            <th class="hidden md:table-cell py-2 text-center">KKM</th>
            <th class="py-2 text-center">Nilai</th>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td class="border border-px border-pink-600 py-2 pl-2">{{ $grade->course->name }}</td>
                    <td class="hidden md:table-cell border border-px border-pink-600 text-center py-2 pl-2">
                        {{ $grade->course->kkm }}</td>
                    <td class="border border-px border-pink-600 text-center py-2 pl-2">{{ $grade->grade }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="text-center py-4 bg-pink-600 text-lg text-white font-semibold" colspan="3">Ekstrakurikuler</td>
            </tr>
            @foreach (App\Models\ExtraCourse::all() as $key=>$course)
            <tr>
                <td class="border border-px border-pink-600 py-2 px-4" colspan="2">{{ ucwords($course->name) }}</td>
                <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2 text-center">
                    {{ $extras[$key]->grade??'-' }}
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
                    {{ $personalities[$key]->grade??'-' }}
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="text-center py-4 bg-pink-600 text-lg text-white font-semibold" colspan="3">Ketidakhadiran</td>
            </tr>
        @foreach (App\Models\Abcent::all() as $key=>$course)
            <tr>
                <td class="border border-px border-pink-600 py-2 px-4" colspan="2">{{ ucwords($course->name) }}</td>
                <td class="border border-px border-pink-600 py-2 w-16 md:w-48 px-2 text-center">{{ $abcents[$key]->grade??'-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h1 class="text-center italic mt-36 text-2l">Nilai tidak tersedia</h1>
    @endif
@endsection
