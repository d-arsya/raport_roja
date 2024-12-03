@if ($paginator->hasPages())
    <nav aria-label="Page navigation example" class="flex items-center justify-between">
        <div>
            <p class="text-sm text-pink-600 leading-5">
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('-') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('dari') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
            </p>
        </div>

        {{-- Pagination links --}}
        <ul class="inline-flex -space-x-px text-sm">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li>
                    <a href="{{ $paginator->url(1) }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-pink-600 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-pink-500 hover:text-white">
                        <<
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page" class="flex items-center justify-center px-3 h-8 text-white border border-gray-300 bg-pink-600 hover:bg-white hover:text-pink-600">
                                    {{ $page }}
                                </span>
                            </li>
                        @elseif($page == $paginator->currentPage()-1 ||$page == $paginator->currentPage()+1)
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight text-pink-600 bg-white border border-gray-300 hover:bg-pink-500 hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="flex items-center justify-center px-3 h-8 leading-tight text-pink-600 bg-white border border-gray-300 rounded-e-lg hover:bg-pink-500 hover:text-white">
                        >>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
