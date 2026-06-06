@if ($paginator->hasPages())
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <span style="opacity:.4;"><i class="fas fa-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" style="background:var(--accent);color:#fff;border-color:var(--accent);">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
        @else
            <span style="opacity:.4;"><i class="fas fa-chevron-right"></i></span>
        @endif
    </div>
@endif
