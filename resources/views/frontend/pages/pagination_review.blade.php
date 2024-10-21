@if ($paginator->lastPage() > 1)
<ul class="pagination">
    <li class="page-item {{ ($paginator->currentPage() == 1) ? ' ' : '' }}">
        <a class="page-link"  href="{{ $paginator->url(1) }}"><</a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' ' : '' }}">
        <a class="page-link"  id="load-more-btn" data-offset="{{ count($paginator) }}" >></a>
    </li>
</ul>


@endif