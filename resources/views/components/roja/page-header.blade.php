@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumbs' => [],
])

<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-[#17283c] tracking-tight">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-xs text-slate-500 mt-1">{{ $subtitle }}</p>
        @endif
    </div>

    @if(count($breadcrumbs) > 0)
        <nav class="flex items-center text-xs text-slate-400 gap-2">
            <a href="/dashboard" class="hover:text-primary transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>
            @foreach($breadcrumbs as $crumb)
                <span class="text-slate-300">/</span>
                @if(isset($crumb['url']))
                    <a href="{{ $crumb['url'] }}" class="hover:text-primary transition-colors font-medium">{{ $crumb['label'] }}</a>
                @else
                    <span class="text-slate-600 font-semibold">{{ $crumb['label'] }}</span>
                @endif
            @endforeach
        </nav>
    @endif
</div>
