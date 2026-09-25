@php
use Carbon\Carbon;
$year = Carbon::now()->isoFormat('YYYY');
@endphp

<footer class="w-full bg-white/70 backdrop-blur-md border-t border-[var(--bg-form-border)] py-4 mt-auto relative z-10 shadow-[0_-1px_3px_rgba(0,0,0,0.02)]">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 flex flex-col items-center justify-center gap-1.5 text-center">
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            <span>TMQ PONDOK ROJA</span>
        </div>
        <p class="text-[11px] text-[#abb4be] font-medium leading-relaxed m-0">
            © Copyright {{ $year }} TARBIYYATU MUHAFFIZHATIL QUR'AN PONDOK ROOIHATUL JANNAH. All Rights Reserved.
        </p>
    </div>
</footer>
