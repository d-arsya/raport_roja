@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Dashboard Akademik"
        subtitle="Selamat datang di Sistem Raport & Manajemen Akademik TMQ Pondok Roja"
        :breadcrumbs="[['label' => 'Dashboard']]"
    />
</div>

<!-- Roja Summary Statistic Widgets -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Santri Widget -->
    <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 bg-contain bg-right-bottom bg-no-repeat" style="background-image: url('{{ asset('assets/svg/etc/Widget-Bg.svg') }}');">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Santri</span>
                <h3 class="text-2xl font-bold text-[#17283c] mt-1">{{ $studentCount ?? 0 }}</h3>
                <span class="text-[11px] text-info font-semibold mt-1 inline-block">Terdaftar di sistem</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-info/10 text-info flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Guru Widget -->
    <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 bg-contain bg-right-bottom bg-no-repeat" style="background-image: url('{{ asset('assets/svg/etc/Widget-Bg.svg') }}');">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Guru / Wali</span>
                <h3 class="text-2xl font-bold text-[#17283c] mt-1">{{ $teacherCount ?? 0 }}</h3>
                <span class="text-[11px] text-tertiary font-semibold mt-1 inline-block">Pengajar aktif</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-tertiary/10 text-tertiary flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Kelas Widget -->
    <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 bg-contain bg-right-bottom bg-no-repeat" style="background-image: url('{{ asset('assets/svg/etc/Widget-Bg.svg') }}');">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Kelas</span>
                <h3 class="text-2xl font-bold text-[#17283c] mt-1">{{ $roomCount ?? 0 }}</h3>
                <span class="text-[11px] text-secondary font-semibold mt-1 inline-block">Rombel aktif</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Mapel Widget -->
    <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 bg-contain bg-right-bottom bg-no-repeat" style="background-image: url('{{ asset('assets/svg/etc/Widget-Bg.svg') }}');">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Mata Pelajaran</span>
                <h3 class="text-2xl font-bold text-[#17283c] mt-1">{{ $courseCount ?? 0 }}</h3>
                <span class="text-[11px] text-primary font-semibold mt-1 inline-block">Kurikulum aktif</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Navigation Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="/siswa" class="roja_card p-6 hover:shadow-roja-md hover:-translate-y-1 transition-all duration-200 group">
        <div class="w-10 h-10 rounded-2xl bg-info/10 text-info flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <h4 class="text-sm font-bold text-[#17283c] group-hover:text-info transition-colors">Manajemen Siswa</h4>
        <p class="text-xs text-slate-400 mt-1">Lihat dan kelola data seluruh santri terdaftar di TMQ Pondok Roja.</p>
    </a>

    <a href="/guru" class="roja_card p-6 hover:shadow-roja-md hover:-translate-y-1 transition-all duration-200 group">
        <div class="w-10 h-10 rounded-2xl bg-tertiary/10 text-tertiary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </div>
        <h4 class="text-sm font-bold text-[#17283c] group-hover:text-tertiary transition-colors">Data Guru & Wali</h4>
        <p class="text-xs text-slate-400 mt-1">Kelola data dewan guru, penugasan kelas, dan akun ustadz.</p>
    </a>

    <a href="/kelas" class="roja_card p-6 hover:shadow-roja-md hover:-translate-y-1 transition-all duration-200 group">
        <div class="w-10 h-10 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h4 class="text-sm font-bold text-[#17283c] group-hover:text-secondary transition-colors">Kelas & Rombel</h4>
        <p class="text-xs text-slate-400 mt-1">Atur pembagian kelas, semester aktif, dan penempatan santri.</p>
    </a>
</div>
@endsection