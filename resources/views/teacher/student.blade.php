@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Raport Santri: {{ ucwords($student->name) }}"
        subtitle="Kelas {{ $room->name }} - Semester {{ $semester % 2 == 0 ? 'Genap' : 'Ganjil' }} | Rata-rata: {{ round($grades->avg('grade'), 2) }}"
        :breadcrumbs="[['label' => 'Nilai', 'url' => '/nilai'], ['label' => ucwords($student->name)]]"
    />
</div>

<!-- Quick Actions: PDF Downloads -->
<div class="roja_card p-5 mb-6 flex flex-wrap items-center justify-between gap-4">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center font-bold text-sm">
            {{ strtoupper(substr($student->name, 0, 1)) }}
        </div>
        <div>
            <h4 class="text-sm font-bold text-[#17283c]">{{ ucwords($student->name) }}</h4>
            <p class="text-xs text-slate-400">NIS: {{ $student->nis }}</p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <form action="{{ route('print-indo') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="nis" value="{{ $student->nis }}">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <x-roja.button type="submit" variant="primary" size="sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Cetak Raport (Indo)</span>
            </x-roja.button>
        </form>

        <form action="{{ route('print-arab') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="nis" value="{{ $student->nis }}">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <x-roja.button type="submit" variant="secondary" size="sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Cetak Raport (Arab)</span>
            </x-roja.button>
        </form>
    </div>
</div>

<!-- Comprehensive Grade Form -->
<form action="/nilai/kelas/{{ $room->class_code }}/siswa/{{ $student->nis }}/semester/{{ $semester }}" method="POST" class="space-y-6">
    @csrf

    <!-- 1. Nilai Akademik -->
    <div class="roja_card overflow-hidden">
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">1. Nilai Mata Pelajaran</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400 font-semibold text-[11px]">
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-center hidden md:table-cell">KKM</th>
                        <th class="px-6 py-3 text-center w-36">Nilai (0-100)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($courses as $key => $course)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-3 font-semibold text-[#17283c]">{{ ucwords($course->name) }}</td>
                            <td class="px-6 py-3 text-center text-slate-400 hidden md:table-cell">{{ $course->kkm }}</td>
                            <td class="px-6 py-3 text-center">
                                <input
                                    type="number"
                                    name="{{ $course->id }}"
                                    value="{{ $grades[$key]->grade ?? 0 }}"
                                    min="0"
                                    max="100"
                                    class="form-control text-center font-bold text-xs h-9 w-24 mx-auto rounded-xl"
                                />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. Ekstrakurikuler -->
    <div class="roja_card overflow-hidden">
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">2. Kegiatan Ekstrakurikuler</h4>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach (App\Models\ExtraCourse::all() as $key => $course)
                @php
                    $val = $extras[$key]->grade ?? 'A';
                @endphp
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <label class="text-xs font-bold text-slate-700 block mb-2">{{ ucwords($course->name) }}</label>
                    <select name="extra-{{ $course->id }}" class="form-control text-xs h-9 rounded-xl">
                        @foreach (['A', 'B', 'C', 'D'] as $opt)
                            <option value="{{ $opt }}" @selected($val === $opt)>Predikat {{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 3. Akhlak & Kepribadian -->
    <div class="roja_card overflow-hidden">
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">3. Akhlak & Kepribadian</h4>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach (App\Models\Personality::all() as $key => $course)
                @php
                    $val = $personalities[$key]->grade ?? 'Baik';
                @endphp
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <label class="text-xs font-bold text-slate-700 block mb-2">{{ ucwords($course->name) }}</label>
                    <select name="personality-{{ $course->id }}" class="form-control text-xs h-9 rounded-xl">
                        @foreach (['Sangat Baik', 'Baik', 'Kurang Baik'] as $opt)
                            <option value="{{ $opt }}" @selected($val === $opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 4. Ketidakhadiran -->
    <div class="roja_card overflow-hidden">
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">4. Catatan Ketidakhadiran</h4>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach (App\Models\Abcent::all() as $key => $course)
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <label class="text-xs font-bold text-slate-700 block mb-2">{{ ucwords($course->name) }}</label>
                    <div class="flex items-center gap-2">
                        <input
                            type="number"
                            name="abcent-{{ $course->id }}"
                            value="{{ $abcents[$key]->grade ?? 0 }}"
                            min="0"
                            class="form-control text-center font-bold text-xs h-9 rounded-xl"
                        />
                        <span class="text-xs text-slate-400 font-semibold">Hari</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex items-center justify-between pt-2">
        <x-roja.button href="/nilai" variant="light">
            Kembali
        </x-roja.button>
        <x-roja.button type="submit" variant="primary" size="lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>Simpan Raport Santri</span>
        </x-roja.button>
    </div>
</form>
@endsection