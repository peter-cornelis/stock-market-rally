@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="text-black/70 mt-4 max-md:mx-4">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center pl-1 pr-3 py-1 text-sm font-medium text-black/50 bg-white cursor-default shadow rounded-lg">
                    <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
                    Vorige
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center pl-1 pr-3 py-1 text-sm font-medium bg-white hover:text-black/90 active:text-black/70 shadow rounded-lg transition ease-in-out duration-200">
                    <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
                    Vorige
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center pl-3 pr-1 py-1 text-sm font-medium bg-white hover:text-black/90 active:text-black/70 shadow rounded-lg transition ease-in-out duration-200">
                    Volgende
                    <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
                </a>
            @else
                <span class="relative inline-flex items-center pl-3 pr-1 py-1 text-sm font-medium text-black/50 bg-white cursor-default shadow rounded-lg">
                    Volgende
                    <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
                </span>
            @endif
        </div>

        <div class="hidden sm:flex justify-between items-center">
            <p class="py-1">
                {!! __('Resultaat') !!}
                <span>{{ $paginator->firstItem() }}</span>
                {!! __('tot') !!}
                <span>{{ $paginator->lastItem() }}</span>
                {!! __('van de') !!}
                <span>{{ $paginator->total() }}</span>
            </p>

            <ul class="flex items-center bg-white font-semibold rounded-lg shadow">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="flex justify-center min-w-8 text-center text-black/50 py-1 border-r border-black/5" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
                    </li>
                @else
                    <li class="flex justify-center min-w-8 text-center hover:text-black/90 active:text-black/70 py-1 border-r border-black/5 transition ease-in-out duration-200">
                        <a class="material-symbols-outlined" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">chevron_left</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="px-2 py-1 border-r border-black/5" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="min-w-8 text-center text-black/90 px-2 py-1 border-r border-black/5" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="min-w-8 text-center hover:text-black/90 active:text-black/70 px-2 py-1 border-r border-black/5 transition ease-in-out duration-200"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="flex justify-center min-w-8 text-center hover:text-black/90 transition ease-in-out duration-200">
                        <a class="material-symbols-outlined" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">chevron_right</a>
                    </li>
                @else
                    <li class="flex justify-center min-w-8 text-center text-black/50" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
                    </li>
                @endif
            </ul>
        </div>
        
    </nav>
@endif