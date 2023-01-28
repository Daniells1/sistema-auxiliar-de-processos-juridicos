@if($paginator->lastPage() > 1)
<nav>
    <ul class="pagination">
        <li class="page-item">
            <a href="{{ $paginator->url(1) }}" class="page-link">ínicio</a>
        </li>

        @for($i = 1; $i <= $paginator->lastPage(); $i++ )

        <li class="page-item">
            <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
        </li>

        @endfor
        <li class="page-item">
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">Fim</a>
        </li>
    </ul>
</nav>

@endif