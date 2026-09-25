@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Input Nilai: {{ $course->name }}"
        subtitle="Kelas {{ $room->name }} - Semester {{ $semester % 2 == 0 ? 'Genap' : 'Ganjil' }}"
        :breadcrumbs="[['label' => 'Nilai', 'url' => '/nilai'], ['label' => $course->name]]"
    />
</div>

<!-- Stats Card -->
<div class="roja_card p-5 mb-6">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">KKM Pelajaran</span>
            <span class="text-base font-bold text-[#17283c] mt-0.5 block">{{ $course->kkm }}</span>
        </div>
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Nilai Tertinggi</span>
            <span class="text-base font-bold text-success mt-0.5 block">{{ $grades->max('grade') ?? 0 }}</span>
        </div>
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Nilai Terendah</span>
            <span class="text-base font-bold text-danger mt-0.5 block">{{ $grades->min('grade') ?? 0 }}</span>
        </div>
        <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-center">
            <span class="text-[11px] font-bold text-slate-400 block">Rata-rata Kelas</span>
            <span class="text-base font-bold text-primary mt-0.5 block">{{ round($grades->avg('grade'), 2) ?? 0 }}</span>
        </div>
    </div>

    <!-- Actions & CSV Upload -->
    <div class="mt-4 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <label for="csvFile" class="roja_btn roja_btn-secondary roja_btn-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                <span>Upload CSV</span>
            </label>
            <input type="file" class="hidden" accept=".csv" name="csvFile" id="csvFile">

            <a download="Nilai {{ $course->name }}.csv" href="{{ Storage::url('data/nilai.csv') }}" class="roja_btn roja_btn-light roja_btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Template CSV</span>
            </a>
        </div>
    </div>
</div>

<!-- Grade Matrix Table Form -->
<div class="roja_card overflow-hidden">
    <form action="/nilai/kelas/{{ $room->class_code }}/pelajaran/{{ $course->id }}/semester/{{ $semester }}" method="POST">
        @csrf
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-500 font-bold uppercase tracking-wider text-[11px]">
                        <th class="px-6 py-4 w-12 text-center">No</th>
                        <th class="px-6 py-4">Nama Santri</th>
                        <th class="px-6 py-4 hidden md:table-cell text-center">NIS</th>
                        <th class="px-6 py-4 text-center w-36">Nilai Akhir (0-100)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($students as $key => $student)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-6 py-3 text-center text-slate-400 font-semibold">{{ $key + 1 }}</td>
                            <td class="px-6 py-3 font-bold text-[#17283c]">
                                {{ ucwords($student->name) }}
                            </td>
                            <td class="px-6 py-3 text-center text-slate-400 hidden md:table-cell">
                                {{ $student->nis }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                <input
                                    type="number"
                                    name="{{ $student->nis }}"
                                    value="{{ $grades[$key]->grade ?? 0 }}"
                                    min="0"
                                    max="100"
                                    class="form-control text-center font-bold text-sm h-10 w-24 mx-auto rounded-xl"
                                />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-5 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
            <x-roja.button href="/nilai" variant="light">
                Kembali
            </x-roja.button>
            <x-roja.button type="submit" variant="primary" size="md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Simpan Semua Nilai</span>
            </x-roja.button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const csvFileInput = document.querySelector('#csvFile');
    if (csvFileInput) {
        csvFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(event) {
                const csvData = event.target.result;
                const lines = csvData.split('\n');
                lines.forEach(line => {
                    const parts = line.includes(';') ? line.split(';') : line.split(',');
                    if (parts.length >= 2) {
                        const [number, value] = parts;
                        if (number && value) {
                            const input = document.querySelector(`input[name="${number.trim()}"]`);
                            if (input) {
                                input.value = value.trim();
                            }
                        }
                    }
                });
            };
            reader.readAsText(file);
        });
    }
});
</script>
@endsection
