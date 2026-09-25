@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Dashboard Santri"
        subtitle="Selamat datang di Portal Akademik TMQ Pondok Roja"
        :breadcrumbs="[['label' => 'Dashboard']]"
    />
</div>

<!-- Welcome Santri Profile Card -->
<div class="roja_card p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-xl shrink-0">
            {{ strtoupper(substr($student->name, 0, 1)) }}
        </div>
        <div>
            <span class="text-xs font-semibold text-secondary block">Ahlan Wa Sahlan,</span>
            <h2 class="text-xl font-bold text-[#17283c]">{{ ucwords($student->name) }}</h2>
            <div class="flex items-center gap-3 mt-1 text-xs text-slate-400">
                @if($student->name_arabic)
                    <span class="font-arabic text-sm text-slate-600">{{ $student->name_arabic }}</span>
                    <span>•</span>
                @endif
                <span>NIS: {{ $student->nis }}</span>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <x-roja.button href="/nilai" variant="primary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z"></path>
            </svg>
            <span>Lihat Raport Saya</span>
        </x-roja.button>
    </div>
</div>

<!-- Class Information & Classmates -->
<div class="roja_card p-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center font-bold text-sm">
                {{ substr($room->name, 0, 2) }}
            </div>
            <div>
                <h3 class="text-base font-bold text-[#17283c]">Kelas {{ $room->name }}</h3>
                <p class="text-xs text-slate-400 font-medium">
                    Wali Kelas: <span class="text-slate-700 font-semibold">{{ ucwords($room->teacher->name ?? 'Belum Ditentukan') }}</span>
                </p>
            </div>
        </div>

        <x-roja.badge variant="secondary">
            {{ $students->count() }} Teman Sekelas
        </x-roja.badge>
    </div>

    <!-- Classmates Grid -->
    <div class="mt-4">
        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Daftar Santri Sekelas:</h4>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5">
            @foreach ($students as $item)
                @php
                    $isSelf = ($item->nis === $student->nis);
                @endphp
                <div class="p-3 rounded-xl {{ $isSelf ? 'bg-primary/10 border-primary/30 text-primary font-bold shadow-xs' : 'bg-slate-50 border-slate-100 text-slate-700 font-medium' }} border text-center text-xs truncate">
                    {{ ucwords($item->name) }}
                    @if($isSelf)
                        <span class="text-[9px] block text-primary font-bold">(Saya)</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection