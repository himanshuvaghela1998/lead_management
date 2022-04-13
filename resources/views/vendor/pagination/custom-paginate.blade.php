@if ($paginator->hasPages())
    <div class="row border-light-gray br-5 p-3 mx-0 mt-4 font-mulish">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="col-auto">
                <span aria-label="@lang('pagination.previous')" class="text-medium-gray2 font-18 font-weight-bold cursor-pointer">
                    <i class="fa-solid fa-angle-left mr-2"></i>
                    Previous
                </span>
            </div>
        @else
            <div class="col-auto">
                <a href="{{ $paginator->previousPageUrl() }}" class="text-navy-blue-dark font-18 font-weight-bold cursor-pointer text-decoration-none">
                    <i class="fa-solid fa-angle-left mr-2"></i>
                    Previous
                </a>
            </div>
        @endif
        <div class="col-auto mx-auto business-list-pagination">
            <ul class="list-unstyled m-0 d-flex text-navy-blue font-18 font-weight-bold">
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="font-18 font-weight-bold mx-2 text-medium-gray2 cursor-pointer">{{ $page }}</li>
                            @else
                                <li class="mx-2 cursor-pointer"><a class="mx-2 text-navy-blue text-decoration-none" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div class="col-auto">
                <a href="{{ $paginator->nextPageUrl() }}" class="text-navy-blue-dark font-18 font-weight-bold cursor-pointer text-decoration-none">
                    Next
                    <i class="fa-solid fa-angle-right ml-2 text-black"></i>
                </a>
            </div>
        @else
            <div class="col-auto text-medium-gray2">
                <span class="font-18 font-weight-bold cursor-pointer">
                    Next
                    <i class="fa-solid fa-angle-right ml-2"></i>
                </span>
            </div>
        @endif
    </div>
@endif
