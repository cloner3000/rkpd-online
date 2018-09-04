@if ($paginator->hasPages())
    <ul class="m-datatable__pager-nav">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li>
                <a title="First"
                   class="m-datatable__pager-link m-datatable__pager-link--first m-datatable__pager-link--disabled"
                   disabled="disabled">
                    <i class="la la-angle-double-left"></i>
                </a>
            </li>
        @else
            <li>
                <a title="Previous" href="{{ $paginator->previousPageUrl() }}"
                   class="m-datatable__pager-link m-datatable__pager-link--prev">
                    <i class="la la-angle-left"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>
                    <a title="More pages"
                       class="m-datatable__pager-link m-datatable__pager-link--more-next">
                        <i class="la la-ellipsis-h"></i>
                    </a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <a class="m-datatable__pager-link m-datatable__pager-link-number m-datatable__pager-link--active"
                               title="{{ $page }}">
                                {{ $page }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="m-datatable__pager-link m-datatable__pager-link-number"
                               href="{{ $url }}" title="{{ $page }}">
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
                <a title="Next"
                   class="m-datatable__pager-link m-datatable__pager-link--next"
                   href="{{ $paginator->nextPageUrl() }}">
                    <i class="la la-angle-right"></i>
                </a>
            </li>
        @else
            <li>
                <a title="Next"
                   class="m-datatable__pager-link m-datatable__pager-link--next m-datatable__pager-link--disabled"
                   disabled="disabled">
                    <i class="la la-angle-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
