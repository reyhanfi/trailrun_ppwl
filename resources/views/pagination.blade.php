@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Navigasi halaman">
        @if ($paginator->onFirstPage())
            <span class="pagination-item" aria-disabled="true" aria-label="Halaman sebelumnya">&lsaquo;</span>
        @else
            <a class="pagination-item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya">&lsaquo;</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination-gap">{{ $element }}</span>
            @else
                @foreach ($element as $page => $url)
                    @if ($page === $paginator->currentPage())
                        <span class="pagination-item" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="pagination-item" href="{{ $url }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="pagination-item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya">&rsaquo;</a>
        @else
            <span class="pagination-item" aria-disabled="true" aria-label="Halaman berikutnya">&rsaquo;</span>
        @endif
    </nav>
@endif
