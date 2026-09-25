@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Dashboard Guru"
        subtitle="Selamat datang Ustadz/Ustadzah {{ ucwords($teacher->name) }}"
        :breadcrumbs="[['label' => 'Dashboard']]"
    />
</div>

<!-- Welcome Teacher Profile Card -->
<div class="roja_card p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-xl shrink-0">
            {{ strtoupper(substr($teacher->name, 0, 1)) }}
        </div>
        <div>
            <span class="text-xs font-semibold text-secondary block">Ahlan Wa Sahlan,</span>
            <h2 class="text-xl font-bold text-[#17283c]">{{ ucwords($teacher->name) }}</h2>
            <div class="flex items-center gap-3 mt-1 text-xs text-slate-400">
                @if($teacher->name_arabic)
                    <span class="font-arabic text-sm text-slate-600">{{ $teacher->name_arabic }}</span>
                    <span>•</span>
                @endif
                <span>NIP: {{ $teacher->nip }}</span>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <x-roja.button href="/nilai" variant="primary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path>
            </svg>
            <span>Input Nilai Raport</span>
        </x-roja.button>
    </div>
</div>

<!-- Classrooms Overview -->
@if ($rooms->count() > 0)
    <div class="space-y-6">
        @foreach ($rooms as $room)
            @php
                $students = $room->students();
                $courses = $room->courses()->get();
            @endphp
            <div class="roja_card p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center font-bold text-sm">
                            {{ substr($room->name, 0, 2) }}
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-[#17283c]">Kelas {{ $room->name }}</h3>
                            <p class="text-xs text-slate-400">Semester Aktif: {{ $room->semester }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-roja.badge variant="secondary">
                            {{ $students->count() }} Santri
                        </x-roja.badge>
                        <x-roja.badge variant="info">
                            {{ $courses->count() }} Mata Pelajaran
                        </x-roja.badge>
                    </div>
                </div>

                <!-- Students in Room -->
                <div class="mt-4">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Daftar Santri:</h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                        @foreach ($students as $student)
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-center text-xs font-medium text-slate-700 truncate">
                                {{ ucwords($student->name) }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Courses in Room -->
                @if ($courses->count() > 0)
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Daftar Mata Pelajaran & KKM:</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                            @foreach ($courses as $course)
                                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between text-xs">
                                    <span class="font-semibold text-slate-700 truncate mr-1">{{ ucwords($course->name) }}</span>
                                    <x-roja.badge variant="primary">
                                        {{ $course->kkm }}
                                    </x-roja.badge>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@else
    <div class="roja_card p-12 text-center">
        <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h4 class="text-sm font-bold text-[#17283c]">Belum Ada Kelas yang Diampu</h4>
        <p class="text-xs text-slate-400 mt-1">Anda belum ditugaskan sebagai wali kelas untuk rombel aktif.</p>
    </div>
@endif
@endsection
