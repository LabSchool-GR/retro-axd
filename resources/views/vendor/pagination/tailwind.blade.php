@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col items-center space-y-2 mt-4">
        {{-- Mobile: Only Previous / Next --}}
        <div class="flex justify-between w-full sm:hidden">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-default">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop: Full pagination and summary --}}
        <div class="hidden sm:flex sm:flex-col sm:items-center sm:space-y-2">
            {{-- Summary text --}}
            <div class="text-sm text-gray-600">
                {{ __('Showing') }}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {{ __('to') }}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {{ __('of') }}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {{ __('results') }}
            </div>

            {{-- Page numbers --}}
            <div>
                <span class="inline-flex items-center -space-x-px rounded-md shadow-sm" role="group">
                    {{-- Previous Page --}}
                    @if ($paginator->onFirstPage())
                        <span class="px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-l-md cursor-default">
                            ‹
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="px-2 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-l-md hover:text-blue-500">
                            ‹
                        </a>
                    @endif

                    {{-- Page Links --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="px-4 py-2 text-sm font-bold text-white bg-blue-500 border border-blue-500">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:text-blue-500">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="px-2 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-r-md hover:text-blue-500">
                            ›
                        </a>
                    @else
                        <span class="px-2 py-2 text-sm text-gray-500 bg-white border border-gray-300 rounded-r-md cursor-default">
                            ›
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

