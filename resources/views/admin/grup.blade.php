@extends('layouts.main')

@section('container')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <x-roja.page-header
        title="Group Siswa (Angkatan)"
        subtitle="Kelola grup angkatan santri dan asosiasi kelas"
        :breadcrumbs="[['label' => 'Group Siswa']]"
        class="mb-0"
    />

    <div class="flex items-center gap-2">
        <x-roja.button type="button" id="openButton" onclick="openModal('modal-tambah-grup')" variant="primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Group</span>
        </x-roja.button>

        <button disabled type="button" id="loadButton" class="hidden roja_btn roja_btn-secondary">
            <svg aria-hidden="true" role="status" class="inline w-4 h-4 animate-spin" viewBox="0 0 100 101" fill="none">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#ffffff"/>
            </svg>
            <span>Memuat file...</span>
        </button>
    </div>
</div>

@if (session('success'))
    <div class="mb-4 p-4 rounded-2xl bg-success/10 text-success text-xs font-semibold flex items-center gap-2 border border-success/20">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($groups as $group)
        @if ($group->name != 'ALUMNI')
            <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <a href="/grup/{{ $group->name }}" class="text-base font-bold text-[#17283c] hover:text-primary transition-colors">
                            {{ $group->name }}
                        </a>
                        <x-roja.badge variant="info">
                            {{ $group->students->count() }} Santri
                        </x-roja.badge>
                    </div>

                    <div class="pt-3 border-t border-slate-100">
                        <label class="text-[11px] font-semibold text-slate-400 block mb-1.5">Penugasan Kelas:</label>
                        <form action="/grup/edit/kelas" method="post" class="ubah-form">
                            @csrf
                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                            <select name="class_code" onchange="this.form.submit()" class="form-control text-xs py-1.5 h-auto rounded-xl">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->class_code }}" @selected(isset($group->room) && $room->name == $group->room->name)>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!-- Modal Tambah Grup -->
<x-roja.modal id="modal-tambah-grup" title="Tambah Group Siswa Baru">
    <form id="formPop" action="/grup/tambah" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <x-roja.input label="Nama Group" name="name" placeholder="Contoh: Angkatan 2026" required />
        <x-roja.input label="Tahun Masuk" name="year" placeholder="Contoh: 2026" required />
        
        <div class="form-group mb-4">
            <label for="room" class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
                Kelas Awal <span class="text-danger">*</span>
            </label>
            <select name="room" id="room" required class="form-control text-xs">
                @foreach ($avail as $room)
                    <option value="{{ $room->class_code }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
                Data Santri (.CSV file) <span class="text-danger">*</span>
            </label>
            <input type="file" id="user_data" name="user_data" accept=".csv" required class="form-control py-2 text-xs" />
            <p class="text-[11px] text-slate-400 mt-2">
                Template CSV: 
                <a download="Data Grup Siswa.csv" href="{{ Storage::url('data/dat.csv') }}" class="text-secondary font-semibold hover:underline">Download Template</a>
            </p>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2">
            <x-roja.button type="button" onclick="closeModal('modal-tambah-grup')" variant="light">
                Batal
            </x-roja.button>
            <x-roja.button type="submit" onclick="handleSubmitGrup()" variant="primary">
                Simpan & Import
            </x-roja.button>
        </div>
    </form>
</x-roja.modal>

<script>
function handleSubmitGrup() {
    const fileInput = document.getElementById('user_data');
    if (fileInput && fileInput.files.length > 0) {
        closeModal('modal-tambah-grup');
        const openBtn = document.getElementById('openButton');
        const loadBtn = document.getElementById('loadButton');
        if (openBtn) openBtn.classList.add('hidden');
        if (loadBtn) loadBtn.classList.remove('hidden');
    }
}
</script>
@endsection
