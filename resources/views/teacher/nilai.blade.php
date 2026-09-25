@extends('layouts.main')

@section('container')
<x-roja.page-header
    title="Data Nilai Santri"
    subtitle="Pilih berdasarkan mata pelajaran atau santri untuk mengelola nilai semester"
    :breadcrumbs="[['label' => 'Nilai']]"
/>

@foreach ($rooms as $room)  
@php
    $courses = $room->courses;
    $students = $room->students();
    $sem1 = $room->semester;
    $sem2 = $room->semester + 1;
@endphp

<div class="roja_card p-6 mb-8">
    <!-- Class Info Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-100">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-lg">
                {{ substr($room->name, 0, 2) }}
            </div>
            <div>
                <h3 class="text-lg font-bold text-[#17283c]">{{ $room->name }}</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">
                    Wali Kelas: <span class="text-slate-700 font-semibold">{{ ucwords($room->teacher->name ?? 'Belum Ditentukan') }}</span>
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <x-roja.badge variant="secondary">
                {{ $students->count() }} Santri
            </x-roja.badge>
            <x-roja.badge variant="info">
                {{ $courses->count() }} Mapel
            </x-roja.badge>
        </div>
    </div>

    @if ($room->course == 0)
        <div class="py-12 text-center">
            <div class="w-12 h-12 rounded-2xl bg-warning/10 text-warning flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h4 class="text-sm font-bold text-[#17283c]">Daftar Pelajaran Belum Disimpan</h4>
            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Silakan atur dan simpan permanen daftar pelajaran untuk kelas ini terlebih dahulu.</p>
            <div class="mt-4">
                <x-roja.button href="/pelajaran" variant="primary" size="sm">
                    Kelola Pelajaran
                </x-roja.button>
            </div>
        </div>
    @else
        <!-- Semester Sections -->
        @foreach ([['num' => 1, 'sem' => $sem1, 'label' => 'Semester 1 (Ganjil)'], ['num' => 2, 'sem' => $sem2, 'label' => 'Semester 2 (Genap)']] as $semesterItem)
            <div class="mt-6 pt-6 {{ $loop->first ? '' : 'border-t border-slate-100' }}">
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2.5 h-2.5 rounded-full bg-secondary"></span>
                    <h4 class="text-sm font-bold text-[#17283c]">{{ $semesterItem['label'] }}</h4>
                </div>

                <!-- Berdasarkan Mapel -->
                <div class="mb-5">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-2.5">
                        Input Berdasarkan Mata Pelajaran:
                    </span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5">
                        @foreach ($courses as $course)
                            <a
                                href="/nilai/kelas/{{ $room->class_code }}/pelajaran/{{ $course->id }}/semester/{{ $semesterItem['sem'] }}"
                                class="p-3 rounded-xl bg-slate-50 hover:bg-primary/10 border border-slate-100 hover:border-primary/20 text-slate-700 hover:text-primary font-semibold text-xs text-center transition-all duration-150 truncate shadow-xs"
                            >
                                {{ ucwords($course->name) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Berdasarkan Siswa -->
                <div>
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-2.5">
                        Input & Raport Berdasarkan Siswa:
                    </span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5">
                        @foreach ($students as $student)
                            <a
                                href="/nilai/kelas/{{ $room->class_code }}/siswa/{{ $student->nis }}/semester/{{ $semesterItem['sem'] }}"
                                class="p-3 rounded-xl bg-slate-50 hover:bg-secondary/10 border border-slate-100 hover:border-secondary/20 text-slate-700 hover:text-secondary font-semibold text-xs text-center transition-all duration-150 truncate shadow-xs"
                            >
                                {{ ucwords($student->name) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endforeach
@endsection