@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Laporan Hasil Belajar - Semester {{ $semester }}"
        subtitle="Santri: {{ ucwords($student->name) }} (NIS: {{ $student->nis }})"
        :breadcrumbs="[['label' => 'Nilai', 'url' => '/nilai'], ['label' => 'Semester ' . $semester]]"
    />
</div>

<!-- Stats Card -->
<div class="roja_card p-5 mb-6">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Nama Santri</span>
            <span class="text-xs font-bold text-[#17283c] mt-0.5 block truncate">{{ ucwords($student->name) }}</span>
        </div>
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Semester</span>
            <span class="text-xs font-bold text-slate-800 mt-0.5 block">{{ $semester % 2 == 0 ? 'Genap' : 'Ganjil' }}</span>
        </div>
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Nilai Rata-rata</span>
            <span class="text-base font-bold text-primary mt-0.5 block">{{ round($grades->avg('grade'), 2) ?? 0 }}</span>
        </div>
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Peringkat Kelas</span>
            <span class="text-base font-bold text-secondary mt-0.5 block">{{ $student->rank($semester) ?? '-' }}</span>
        </div>
    </div>

    <!-- Quick Actions: PDF Downloads -->
    @if ($grades->count() > 0)
        <div class="mt-4 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-end gap-2">
            <form action="{{ route('print-indo') }}" method="POST" target="_blank">
                @csrf
                <input type="hidden" name="semester" value="{{ $semester }}">
                @if (request('nis'))
                    <input type="hidden" name="nis" value="{{ request('nis') }}">
                @endif
                <x-roja.button type="submit" variant="primary" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Download Raport (Indonesia)</span>
                </x-roja.button>
            </form>

            <form action="{{ route('print-arab') }}" method="POST" target="_blank">
                @csrf
                <input type="hidden" name="semester" value="{{ $semester }}">
                @if (request('nis'))
                    <input type="hidden" name="nis" value="{{ request('nis') }}">
                @endif
                <x-roja.button type="submit" variant="secondary" size="sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Download Raport (Arab)</span>
                </x-roja.button>
            </form>
        </div>
    @endif
</div>

@if ($grades->count() > 0)
    <!-- 1. Nilai Mata Pelajaran Table -->
    <div class="roja_card overflow-hidden mb-6">
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Nilai Capaian Mata Pelajaran</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400 font-semibold text-[11px]">
                        <th class="px-6 py-3 w-12 text-center">No</th>
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-center hidden md:table-cell">KKM</th>
                        <th class="px-6 py-3 text-center">Nilai Angka</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($grades as $key => $grade)
                        @php
                            $isPassed = $grade->grade >= ($grade->course->kkm ?? 75);
                        @endphp
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-3 text-center text-slate-400 font-semibold">{{ $key + 1 }}</td>
                            <td class="px-6 py-3 font-semibold text-[#17283c]">
                                {{ $grade->course->name }}
                            </td>
                            <td class="px-6 py-3 text-center text-slate-400 hidden md:table-cell">
                                {{ $grade->course->kkm }}
                            </td>
                            <td class="px-6 py-3 text-center font-bold text-slate-800">
                                {{ $grade->grade }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                <x-roja.badge variant="{{ $isPassed ? 'success' : 'danger' }}">
                                    {{ $isPassed ? 'Tuntas' : 'Belum Tuntas' }}
                                </x-roja.badge>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2. Ekstra & Kepribadian & Absensi Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Ekstrakurikuler -->
        <div class="roja_card overflow-hidden">
            <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-100">
                <h4 class="text-xs font-bold text-slate-700 uppercase">Ekstrakurikuler</h4>
            </div>
            <div class="p-4 divide-y divide-slate-100">
                @foreach (App\Models\ExtraCourse::all() as $key => $course)
                    <div class="py-2.5 flex items-center justify-between text-xs">
                        <span class="text-slate-600 font-medium">{{ ucwords($course->name) }}</span>
                        <x-roja.badge variant="info">
                            Predikat {{ $extras[$key]->grade ?? '-' }}
                        </x-roja.badge>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Akhlak & Kepribadian -->
        <div class="roja_card overflow-hidden">
            <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-100">
                <h4 class="text-xs font-bold text-slate-700 uppercase">Akhlak & Kepribadian</h4>
            </div>
            <div class="p-4 divide-y divide-slate-100">
                @foreach (App\Models\Personality::all() as $key => $course)
                    <div class="py-2.5 flex items-center justify-between text-xs">
                        <span class="text-slate-600 font-medium">{{ ucwords($course->name) }}</span>
                        <x-roja.badge variant="secondary">
                            {{ $personalities[$key]->grade ?? '-' }}
                        </x-roja.badge>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ketidakhadiran -->
        <div class="roja_card overflow-hidden">
            <div class="px-5 py-3.5 bg-slate-50 border-b border-slate-100">
                <h4 class="text-xs font-bold text-slate-700 uppercase">Ketidakhadiran</h4>
            </div>
            <div class="p-4 divide-y divide-slate-100">
                @foreach (App\Models\Abcent::all() as $key => $course)
                    <div class="py-2.5 flex items-center justify-between text-xs">
                        <span class="text-slate-600 font-medium">{{ ucwords($course->name) }}</span>
                        <span class="font-bold text-slate-800">{{ $abcents[$key]->grade ?? 0 }} Hari</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="roja_card p-12 text-center">
        <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <h4 class="text-sm font-bold text-[#17283c]">Nilai Belum Tersedia</h4>
        <p class="text-xs text-slate-400 mt-1">Nilai untuk semester ini belum diisi atau belum dipublikasikan oleh ustadz pengampu.</p>
    </div>
@endif
@endsection
