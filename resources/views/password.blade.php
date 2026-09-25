@extends('layouts.main')

@section('container')
<div class="max-w-md mx-auto py-6">
    <x-roja.page-header
        title="Ubah Password"
        subtitle="Perbarui kata sandi akun Anda untuk keamanan"
        :breadcrumbs="[['label' => 'Ubah Password']]"
    />

    <div class="roja_card p-6 md:p-8">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-2xl bg-warning/10 text-warning flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-[#17283c]">Ganti Password</h4>
                <p class="text-xs text-slate-400">Pastikan menggunakan password yang aman.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3.5 rounded-xl bg-success/10 text-success text-xs font-semibold flex items-center gap-2 border border-success/20">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="/password" method="POST" class="space-y-4">
            @csrf
            <x-roja.input
                label="Password Baru"
                name="password"
                type="password"
                placeholder="Masukkan kata sandi baru"
                required
            />

            <x-roja.input
                label="Konfirmasi Password Baru"
                name="password_confirmation"
                type="password"
                placeholder="Ulangi kata sandi baru"
                required
            />

            <div class="pt-4 flex items-center justify-between">
                <x-roja.button href="/dashboard" variant="light">
                    Kembali
                </x-roja.button>
                <x-roja.button type="submit" variant="primary">
                    Simpan Password
                </x-roja.button>
            </div>
        </form>
    </div>
</div>
@endsection
