@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Daftar Pelajaran Kelas"
        subtitle="Kelola mata pelajaran dan KKM untuk masing-masing kelas yang diampu"
        :breadcrumbs="[['label' => 'Pelajaran']]"
    />
</div>

@if (session('success'))
    <div class="mb-4 p-4 rounded-2xl bg-success/10 text-success text-xs font-semibold flex items-center gap-2 border border-success/20">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@foreach ($rooms as $room)
    @php
        $courses = App\Models\ClassCourse::where('class_code', $room->class_code)->get();
    @endphp
    <div class="roja_card p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                    {{ substr($room->name, 0, 2) }}
                </div>
                <div>
                    <h3 class="text-base font-bold text-[#17283c]">Pelajaran Kelas {{ $room->name }}</h3>
                    <p class="text-xs text-slate-400">
                        Status Kurikulum: <span class="font-semibold {{ $room->course == 0 ? 'text-warning' : 'text-success' }}">{{ $room->course == 0 ? 'Draft / Belum Permanen' : 'Permanen' }}</span>
                    </p>
                </div>
            </div>

            @if ($room->course == 0)
                <div class="flex items-center gap-2">
                    <x-roja.button type="button" onclick="openPopupCourse('{{ $room->class_code }}')" variant="primary" size="sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Mapel</span>
                    </x-roja.button>

                    <x-roja.button href="/pelajaran/permanen/{{ $room->class_code }}" onclick="return confirm('Kunci kurikulum kelas ini secara permanen?')" variant="secondary" size="sm">
                        <span>Kunci Permanen</span>
                    </x-roja.button>
                </div>
            @endif
        </div>

        <div class="overflow-x-auto mt-4">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-500 font-bold uppercase tracking-wider text-[11px]">
                        <th class="px-6 py-3">Mata Pelajaran</th>
                        <th class="px-6 py-3 hidden md:table-cell">Nama Arab</th>
                        <th class="px-6 py-3 text-center hidden md:table-cell">Kategori</th>
                        <th class="px-6 py-3 text-center">Nilai KKM</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($courses as $course)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-3 font-semibold text-[#17283c] flex items-center gap-2">
                                @if ($room->course == 0)
                                    <a href="/pelajaran/hapus/kelas/{{ $course->id }}" onclick="return confirm('Hapus pelajaran dari kelas ini?')" class="text-danger hover:opacity-80 p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </a>
                                @endif
                                <span>{{ $course->name }}</span>
                            </td>
                            <td class="px-6 py-3 text-slate-500 font-arabic text-sm hidden md:table-cell">
                                {{ $course->name_arabic ?? '-' }}
                            </td>
                            <td class="px-6 py-3 text-center hidden md:table-cell">
                                <x-roja.badge variant="{{ strtolower($course->varian) === 'agama' ? 'secondary' : 'info' }}">
                                    {{ ucfirst($course->varian) }}
                                </x-roja.badge>
                            </td>
                            <td class="px-6 py-3 text-center">
                                @if ($room->course == 0)
                                    <form action="/pelajaran/ubah/kelas" method="POST" class="inline-flex items-center gap-1.5">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $course->id }}">
                                        <input type="text" maxlength="3" name="kkm" value="{{ $course->kkm }}" class="form-control text-center font-bold text-xs h-8 w-14 rounded-lg" />
                                        <button type="submit" class="roja_btn roja_btn-primary roja_btn-sm text-[10px] px-2 h-8 min-h-0">
                                            Simpan
                                        </button>
                                    </form>
                                @else
                                    <span class="font-bold text-slate-800">{{ $course->kkm }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400">
                                Belum ada mata pelajaran yang ditambahkan ke kelas ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endforeach

<!-- Modal Tambah Pelajaran Kelas -->
<x-roja.modal id="modal-tambah-pelajaran-kelas" title="Tambah Pelajaran ke Kelas">
    <form action="/pelajaran/tambah/kelas" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="class_code" id="modal_class_code">
        <x-roja.input label="Nama Pelajaran" name="name" placeholder="Contoh: Matematika" required />
        <x-roja.input label="Nama Arab (Opsional)" name="arabic" placeholder="Nama Arab" />
        <x-roja.input label="KKM" name="kkm" type="number" placeholder="75" required />
        
        <div class="form-group mb-4">
            <label for="varian" class="control-label font-semibold text-xs text-[#17283c] mb-1.5 block">
                Kategori <span class="text-danger">*</span>
            </label>
            <select name="varian" id="varian" required class="form-control text-xs">
                <option value="akademik">Akademik</option>
                <option value="agama">Agama</option>
            </select>
        </div>

        <div class="pt-2 flex items-center justify-end gap-2">
            <x-roja.button type="button" onclick="closeModal('modal-tambah-pelajaran-kelas')" variant="light">
                Batal
            </x-roja.button>
            <x-roja.button type="submit" variant="primary">
                Simpan
            </x-roja.button>
        </div>
    </form>
</x-roja.modal>

<script>
function openPopupCourse(classCode) {
    document.getElementById('modal_class_code').value = classCode;
    openModal('modal-tambah-pelajaran-kelas');
}
</script>
@endsection
