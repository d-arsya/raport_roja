@extends('layouts.main')

@section('container')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <x-roja.page-header
        title="Data Guru"
        subtitle="Kelola data ustadz / ustadzah dan penugasan kelas"
        :breadcrumbs="[['label' => 'Guru']]"
        class="mb-0"
    />

    <div class="flex items-center gap-2">
        <x-roja.button type="button" onclick="openModal('modal-tambah-guru')" variant="primary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Guru</span>
        </x-roja.button>

        <x-roja.button type="button" onclick="openModal('modal-bulk-guru')" id="openButton" variant="secondary" size="md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
            </svg>
            <span>Import Masal</span>
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

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($teachers as $guru)
        @php
            $teacherUser = $guru->user()->first();
            $rooms = $guru->room;
        @endphp
        <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-tertiary/10 text-tertiary flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr($guru->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#17283c]">
                                {{ ucwords($guru->name) }}
                            </h4>
                            <p class="text-xs text-slate-400 font-medium mt-0.5">
                                {{ $teacherUser ? $teacherUser->email : 'NIP: ' . $guru->nip }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-3 pt-3 border-t border-slate-100 flex flex-wrap items-center gap-1.5">
                    <span class="text-[11px] font-semibold text-slate-400 mr-1">Kelas:</span>
                    @if ($rooms->count() > 0)
                        @foreach ($rooms->sortBy('createdAt')->take(3)->reverse() as $kelas)
                            <a href="/kelas/{{ $kelas->class_code }}" class="roja_label roja_label-secondary hover:opacity-80 transition-opacity">
                                {{ $kelas->name }}
                            </a>
                        @endforeach
                    @else
                        <span class="text-xs italic text-slate-400">Belum ada kelas</span>
                    @endif
                </div>
            </div>

            @if ($rooms->count() == 0)
                <div class="mt-4 pt-3 border-t border-slate-100 flex justify-end">
                    <a href="/guru/hapus/{{ $guru->nip }}" onclick="return confirm('Yakin ingin menghapus guru ini?')" class="roja_label roja_label-danger hover:opacity-80 transition-opacity">
                        Hapus Guru
                    </a>
                </div>
            @endif
        </div>
    @endforeach
</div>

<!-- Modal Tambah Guru -->
<x-roja.modal id="modal-tambah-guru" title="Tambah Guru Baru">
    <form action="/guru/tambah" method="POST" class="space-y-4">
        @csrf
        <x-roja.input label="Nama Lengkap Guru" name="name" placeholder="Nama Guru" required />
        <x-roja.input label="Nama Arab (Opsional)" name="arabic" placeholder="Nama Arab" />
        <x-roja.input label="Alamat Email" name="email" type="email" placeholder="email@roja.com" required />
        <x-roja.input label="NIP" name="nip" placeholder="Nomor Induk Pegawai" required />
        
        <div class="pt-2 flex items-center justify-end gap-2">
            <x-roja.button type="button" onclick="closeModal('modal-tambah-guru')" variant="light">
                Batal
            </x-roja.button>
            <x-roja.button type="submit" variant="primary">
                Simpan Guru
            </x-roja.button>
        </div>
    </form>
</x-roja.modal>

<!-- Modal Bulk Import -->
<x-roja.modal id="modal-bulk-guru" title="Tambah Guru Secara Masal">
    <form action="/guru/tambah" id="ubah" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
                File Data Guru (.CSV)
            </label>
            <input type="file" id="user_data" name="user_data" accept=".csv" required class="form-control py-2 text-xs" />
            <p class="text-[11px] text-slate-400 mt-2">
                Format CSV harus sesuai. Unduh template: 
                <a download="Data Guru.csv" href="{{ Storage::url('data/dat.csv') }}" class="text-secondary font-semibold hover:underline">Download CSV Template</a>
            </p>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2">
            <x-roja.button type="button" onclick="closeModal('modal-bulk-guru')" variant="light">
                Batal
            </x-roja.button>
            <x-roja.button type="submit" variant="primary">
                Unggah & Proses
            </x-roja.button>
        </div>
    </form>
</x-roja.modal>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const formUbah = document.querySelector('#ubah');
    if (formUbah) {
        formUbah.addEventListener('change', function(e) {
            if (e.target.name === 'user_data' && e.target.files.length > 0) {
                closeModal('modal-bulk-guru');
                const openBtn = document.getElementById('openButton');
                const loadBtn = document.getElementById('loadButton');
                if (openBtn) openBtn.classList.add('hidden');
                if (loadBtn) loadBtn.classList.remove('hidden');
                formUbah.submit();
            }
        });
    }
});
</script>
@endsection