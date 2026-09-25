@extends('layouts.main')

@section('container')
<div class="mb-6">
    <x-roja.page-header
        title="{{ isset($room) ? 'Santri Kelas: ' . $room->name : 'Daftar Santri' }}"
        subtitle="{{ isset($room) ? 'Pengampu: ' . ucwords($room->teacher->name ?? '-') : 'Daftar seluruh santri aktif' }}"
        :breadcrumbs="[['label' => 'Kelas', 'url' => '/kelas'], ['label' => $room->name ?? 'Santri']]"
    />
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($students as $student)
        <a href="/nilai?nis={{ $student->nis }}" class="roja_card p-5 hover:shadow-roja-md hover:-translate-y-0.5 transition-all duration-200 group">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-2xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white flex items-center justify-center font-bold text-sm shrink-0 transition-colors">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="text-sm font-bold text-[#17283c] group-hover:text-primary transition-colors truncate">
                        {{ ucwords($student->name) }}
                    </h4>
                    <div class="mt-1 flex items-center gap-2">
                        <x-roja.badge variant="secondary">
                            NIS: {{ $student->nis }}
                        </x-roja.badge>
                        <x-roja.badge variant="info">
                            {{ $student->room->name ?? '-' }}
                        </x-roja.badge>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>

<div class="mt-6">
    {{ $students->links() }}
</div>
@endsection