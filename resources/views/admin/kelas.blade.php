@extends('layouts.main')

@section('container')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <x-roja.page-header
        title="Data Kelas"
        subtitle="Kelola data kelas, semester, dan wali kelas"
        :breadcrumbs="[['label' => 'Kelas']]"
        class="mb-0"
    />

    <x-roja.button type="button" onclick="openModal('modal-tambah-kelas')" variant="primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Tambah Kelas</span>
    </x-roja.button>
</div>

@if (session('success'))
    <div class="mb-4 p-4 rounded-2xl bg-success/10 text-success text-xs font-semibold flex items-center justify-between border border-success/20">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($rooms as $kelas)
        @php
            $studentCount = $kelas->students()->count();
            $hasTeacher = $kelas->teacher && ($kelas->teacher->name ?? false);
        @endphp
        <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div>
                        <a href="/kelas/{{ $kelas->class_code }}" class="text-base font-bold text-[#17283c] hover:text-primary transition-colors">
                            {{ $kelas->name }}
                        </a>
                        <p class="text-xs text-slate-400 font-medium mt-0.5">
                            Kode: {{ $kelas->class_code }}
                        </p>
                    </div>

                    <x-roja.badge variant="secondary">
                        {{ $studentCount }} Santri
                    </x-roja.badge>
                </div>

                <div class="pt-3 border-t border-slate-100">
                    <label class="text-[11px] font-semibold text-slate-400 block mb-1.5">Wali / Pengampu:</label>
                    @if ($hasTeacher)
                        <form action="/kelas/edit/guru" method="post">
                            @csrf
                            <input type="hidden" name="class_code" value="{{ $kelas->class_code }}">
                            <select name="nip" onchange="this.form.submit()" class="form-control text-xs py-1.5 h-auto rounded-xl">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->nip }}" @selected($kelas->teacher->name == $teacher->name)>
                                        {{ ucwords($teacher->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    @else
                        <span class="text-xs font-semibold text-slate-500">LULUS / Belum ditentukan</span>
                    @endif
                </div>
            </div>

            @if ($studentCount <= 0)
                <div class="mt-4 pt-3 border-t border-slate-100 flex justify-end">
                    <a href="/kelas/hapus/{{ $kelas->class_code }}" onclick="return confirm('Yakin hapus kelas ini?')" class="roja_label roja_label-danger hover:opacity-80 transition-opacity">
                        Hapus Kelas
                    </a>
                </div>
            @endif
        </div>
    @endforeach
</div>

<!-- Modal Tambah Kelas -->
<x-roja.modal id="modal-tambah-kelas" title="Tambah Kelas Baru">
    <form action="/kelas/tambah" method="POST" class="space-y-4">
        @csrf
        <x-roja.input label="Nama Kelas" name="name" placeholder="Contoh: 1A, 2B" required />
        <x-roja.input label="Nama Arab (Opsional)" name="arabic" placeholder="Nama Arab" />
        <x-roja.input label="Semester" name="semester" type="number" placeholder="1 / 2" required />
        
        <div class="form-group mb-4">
            <label for="nip" class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
                Guru / Wali Kelas <span class="text-danger">*</span>
            </label>
            <select name="nip" id="guru" required class="form-control text-xs">
                <option value="">-- Pilih Guru Pengampu --</option>
                @foreach ($avail as $guru)
                    <option value="{{ $guru->nip }}">{{ ucwords($guru->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2">
            <x-roja.button type="button" onclick="closeModal('modal-tambah-kelas')" variant="light">
                Batal
            </x-roja.button>
            <x-roja.button type="submit" variant="primary">
                Simpan Kelas
            </x-roja.button>
        </div>
    </form>
</x-roja.modal>
@endsection
