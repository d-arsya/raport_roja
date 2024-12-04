@extends('layouts.main')
@section('container')
{{-- <input type="text" class="w-full"> --}}
<div class="mt-3 grid grid-cols-1 sm:grid-cols-3 justify-align-center gap-3">
    
    @foreach ($students as $siswa)
    <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
        
        <h5 class="mb-2 text-xl font-bold tracking-tight text-pink-600">{{ ucwords($siswa->name) }}</h5>
        <p class="italic text-sm text-lime-600">{{ $siswa->nis }}</p>
    </div> 
    @endforeach
</div>
<div class="p-5 text-bold">
    {{ $students->links() }}

</div>
@endsection