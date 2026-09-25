@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="Daftar Anggota Kelas"
        subtitle="Kelola santri yang berada dalam rombel pengampuan Anda"
        :breadcrumbs="[['label' => 'Kelas']]"
    />
</div>

@foreach ($rooms as $room)
    @php
        $students = $room->students();
    @endphp
    <div class="roja_card p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center font-bold text-sm">
                    {{ substr($room->name, 0, 2) }}
                </div>
                <div>
                    <h3 class="text-base font-bold text-[#17283c]">Kelas {{ $room->name }}</h3>
                    <p class="text-xs text-slate-400">
                        Wali Kelas: <span class="font-semibold text-slate-700">{{ ucwords($room->teacher->name ?? '-') }}</span>
                    </p>
                </div>
            </div>

            <x-roja.badge variant="secondary">
                {{ $students->count() }} Santri
            </x-roja.badge>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-4">
            @forelse ($students as $student)
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center font-bold text-xs shrink-0">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <h5 class="text-xs font-bold text-[#17283c] truncate">
                            {{ ucwords($student->name) }}
                        </h5>
                        <span class="text-[11px] text-slate-400 font-medium">NIS: {{ $student->nis }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-xs text-slate-400">
                    Belum ada anggota santri dalam kelas ini.
                </div>
            @endforelse
        </div>
    </div>
@endforeach
@endsection
