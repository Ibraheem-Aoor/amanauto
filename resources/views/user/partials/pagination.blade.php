@if (isset($items) && !$items->isEmpty())
    <div class="paginationAlls">
        <nav aria-label="Page navigation  example">
            <ul class="pagination justify-content-center">
                {{-- prev page --}}
                @if ($items->onFirstPage())
                    <li class="page-item"><a class="page-link" href="#">{!! __('pagination.previous') !!}</a></li>
                @else
                    <li class="page-item"><a class="page-link"
                            href="{{ $items->previousPageUrl() }}">{!! __('pagination.previous') !!}</a></li>
                @endif
                {{-- counter --}}
                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $items->currentPage() ? 'active' : '' }}"><a
                            class="page-link {{ $page == $items->currentPage() ? 'active' : '' }}"
                            href="{{ $url }}">{{ $page }}</a></li>
                @endforeach
                {{-- next page --}}
                @if ($items->hasMorePages())
                    <li class="page-item"><a class="page-link"
                            href="{{ $items->nextPageUrl() }}">{!! __('pagination.next') !!}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="#">{!! __('pagination.next') !!}</a></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
