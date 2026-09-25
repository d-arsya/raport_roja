@extends('layouts.main')

@section('container')
<x-roja.page-header
    title="Data Siswa"
    subtitle="Kelola dan pantau seluruh data santri/siswa terdaftar"
    :breadcrumbs="[['label' => 'Siswa']]"
/>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($students as $siswa)
        <div class="roja_card p-5 hover:shadow-roja-md transition-all duration-200 flex flex-col justify-between">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-2xl bg-info/10 text-info flex items-center justify-center font-bold text-sm shrink-0">
                    {{ strtoupper(substr($siswa->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-bold text-[#17283c] truncate">
                        {{ ucwords($siswa->name) }}
                    </h4>
                    <div class="mt-1 flex items-center gap-2">
                        <x-roja.badge variant="secondary">
                            NIS: {{ $siswa->nis }}
                        </x-roja.badge>
                    </div>
                </div>
            </div>
        </div> 
    @endforeach
</div>

<div class="mt-6">
    {{ $students->links() }}
</div>
@endsection