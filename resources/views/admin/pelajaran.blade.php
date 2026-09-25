@extends('layouts.main')

@section('container')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <x-roja.page-header
        title="Mata Pelajaran"
        subtitle="Kelola daftar mata pelajaran, nama arab, jenis kurikulum, dan KKM"
        :breadcrumbs="[['label' => 'Pelajaran']]"
        class="mb-0"
    />

    <x-roja.button type="button" onclick="openModal('modal-tambah-pelajaran')" variant="primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Tambah Pelajaran</span>
    </x-roja.button>
</div>

@if (session('success'))
    <div class="mb-4 p-4 rounded-2xl bg-success/10 text-success text-xs font-semibold flex items-center gap-2 border border-success/20">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="roja_card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-500 font-bold uppercase tracking-wider text-[11px]">
                    <th class="px-6 py-4">Mata Pelajaran</th>
                    <th class="px-6 py-4 hidden md:table-cell">Nama Arab</th>
                    <th class="px-6 py-4 text-center hidden md:table-cell">Kategori</th>
                    <th class="px-6 py-4 text-center">Nilai KKM</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($courses as $course)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-6 py-4 font-bold text-[#17283c]">
                            {{ $course->name }}
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell text-slate-500 font-arabic text-sm">
                            {{ $course->name_arabic ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center hidden md:table-cell">
                            <x-roja.badge variant="{{ strtolower($course->varian) === 'agama' ? 'secondary' : 'info' }}">
                                {{ ucfirst($course->varian) }}
                            </x-roja.badge>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-slate-800">
                            {{ $course->kkm }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="/pelajaran/hapus/{{ $course->id }}" onclick="return confirm('Yakin hapus mata pelajaran ini?')" class="roja_label roja_label-danger hover:opacity-80 transition-opacity">
                                Hapus
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Pelajaran -->
<x-roja.modal id="modal-tambah-pelajaran" title="Tambah Pelajaran Baru">
    <form action="/pelajaran/tambah" method="POST" class="space-y-4">
        @csrf
        <x-roja.input label="Nama Pelajaran" name="name" placeholder="Contoh: Matematika, Fiqih" required />
        <x-roja.input label="Nama Arab (Opsional)" name="arabic" placeholder="Nama dalam bahasa Arab" />
        <x-roja.input label="Nilai KKM" name="kkm" type="number" placeholder="Contoh: 75" required />
        
        <div class="form-group mb-4">
            <label for="varian" class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
                Kategori Kurikulum <span class="text-danger">*</span>
            </label>
            <select name="varian" id="varian" required class="form-control text-xs">
                <option value="akademik">Akademik</option>
                <option value="agama">Agama</option>
            </select>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2">
            <x-roja.button type="button" onclick="closeModal('modal-tambah-pelajaran')" variant="light">
                Batal
            </x-roja.button>
            <x-roja.button type="submit" variant="primary">
                Simpan Pelajaran
            </x-roja.button>
        </div>
    </form>
</x-roja.modal>
@endsection
