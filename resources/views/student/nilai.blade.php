@extends('layouts.main')

@section('container')
<x-roja.page-header
    title="Raport Santri"
    subtitle="Pilih semester untuk melihat dan mengunduh laporan hasil belajar"
    :breadcrumbs="[['label' => 'Nilai']]"
/>

<!-- Student Profile Overview -->
<div class="roja_card p-6 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-base">
            {{ strtoupper(substr($student->name, 0, 1)) }}
        </div>
        <div>
            <h3 class="text-base font-bold text-[#17283c]">{{ ucwords($student->name) }}</h3>
            <p class="text-xs text-slate-400 font-medium mt-0.5">
                NIS: <span class="text-slate-700 font-semibold">{{ $student->nis }}</span>
            </p>
        </div>
    </div>

    <x-roja.badge variant="secondary">
        Status: Aktif
    </x-roja.badge>
</div>

<!-- Semester Grid Buttons -->
@php
    $semester = $student->room()->first()->semester ?? 1;
    $nisParam = request('nis') ? '?nis=' . request('nis') : '';
    
    if ($semester > 12) {
        $semesters = range(13, 14);
        $offset = 12;
    } elseif ($semester > 6) {
        $semesters = range(7, 12);
        $offset = 6;
    } else {
        $semesters = range(1, 6);
        $offset = 0;
    }
@endphp

<div class="roja_card p-6">
    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-4">Pilih Semester:</h4>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
        @foreach ($semesters as $i)
            <a
                href="/nilai/siswa/semester/{{ $i }}{{ $nisParam }}"
                class="group p-5 rounded-2xl bg-slate-50 hover:bg-primary/10 border border-slate-100 hover:border-primary/20 text-center transition-all duration-200 shadow-xs hover:shadow-md"
            >
                <div class="w-8 h-8 rounded-xl bg-white text-primary group-hover:bg-primary group-hover:text-white flex items-center justify-center font-bold text-xs mx-auto mb-2 transition-colors shadow-xs">
                    {{ $i - $offset }}
                </div>
                <span class="text-xs font-bold text-slate-700 group-hover:text-primary transition-colors block">
                    Semester {{ $i - $offset }}
                </span>
            </a>
        @endforeach
    </div>
</div>
@endsection
