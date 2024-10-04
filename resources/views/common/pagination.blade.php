<?php
use App\Models\Categories;

// config
$link_limit = 10; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)

    <ul class="mb-2" style="display: flex; justify-content: center; align-items: center;">
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" style="width: 100px;">
                <a href="{{ $paginator->url(1) }}" title="pagination" aria-label="{{trans('words.previous')}}" class="text-light bg-primary border border-primary">
                    <span aria-hidden="true" class="fas fa-angle-double-left"></span>
                    <span class="sr-only">{{trans('words.previous')}}</span>
                </a>
            </li>
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" style="width: 100px;">
                <a href="{{ $paginator->previousPageUrl() }}" title="pagination" aria-label="{{trans('words.previous')}}" class="text-light bg-primary border border-primary">
                    <span aria-hidden="true" class="fas fa-angle-left"></span>
                    <span class="sr-only">{{trans('words.previous')}}</span>
                </a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                $half_total_links = floor($link_limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a style="min-width: 60px" {{ ($paginator->currentPage() == $i) ? ' active' : '' }} href="{{ $paginator->url($i) }}" title="pagination"
                            class="text-light bg-primary border border-primary">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            @if ($paginator->currentPage() == $paginator->lastPage())
            @php
                $percentage = 10;
                $percentage1 = 20;
                $percentage2 = 30;
                $pagesToGoBack = ceil(($paginator->lastPage() * $percentage) / 100);
                $pagesToGoBack1 = ceil(($paginator->lastPage() * $percentage1) / 100);
                $pagesToGoBack2 = ceil(($paginator->lastPage() * $percentage2) / 100);
            @endphp
        <li class="page-item">
            <a style="min-width: 60px" href="{{ $paginator->url(max($paginator->currentPage() - $pagesToGoBack, 1)) }}" title="pagination" aria-label="{{trans('words.previous')}}"
                class="text-light bg-primary border border-primary">
                {{ max($paginator->currentPage() - $pagesToGoBack, 1) }}
            </a>
        </li>
        <li class="page-item">
            <a style="min-width: 60px" href="{{ $paginator->url(max($paginator->currentPage() - $pagesToGoBack1, 1)) }}" title="pagination" aria-label="{{trans('words.previous')}}"
                class="text-light bg-primary border border-primary">
                {{ max($paginator->currentPage() - $pagesToGoBack1, 1) }}
            </a>
        </li>
        <li class="page-item">
            <a style="min-width: 60px" href="{{ $paginator->url(max($paginator->currentPage() - $pagesToGoBack2, 1)) }}" title="pagination" aria-label="{{trans('words.previous')}}"
                class="text-light bg-primary border border-primary">
                {{ max($paginator->currentPage() - $pagesToGoBack2, 1) }}
            </a>
        </li>
        @else
        @php
        $percentage = 10;
        $percentage1 = 20;
        $percentage2 = 30;
        $pagesToGoBack = ceil(($paginator->lastPage() * $percentage) / 100);
        $pagesToGoBack1 = ceil(($paginator->lastPage() * $percentage1) / 100);
        $pagesToGoBack2 = ceil(($paginator->lastPage() * $percentage2) / 100);
    @endphp
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a style="min-width: 60px" href="{{ $paginator->url(min($paginator->currentPage() + $pagesToGoBack, $paginator->lastPage())) }}" title="pagination" aria-label="{{trans('words.next')}}"
                    class="text-light bg-primary border border-primary">
                    {{ min($paginator->currentPage() + $pagesToGoBack, $paginator->lastPage()) }}
                </a>
            </li>
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a style="min-width: 60px" href="{{ $paginator->url(min($paginator->currentPage() + $pagesToGoBack1, $paginator->lastPage())) }}" title="pagination" aria-label="{{trans('words.next')}}"
                    class="text-light bg-primary border border-primary">
                    {{ min($paginator->currentPage() + $pagesToGoBack1, $paginator->lastPage()) }}
                </a>
            </li>
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a style="min-width: 60px" href="{{ $paginator->url(min($paginator->currentPage() + $pagesToGoBack2, $paginator->lastPage())) }}" title="pagination" aria-label="{{trans('words.next')}}"
                    class="text-light bg-primary border border-primary">
                    {{ min($paginator->currentPage() + $pagesToGoBack2, $paginator->lastPage()) }}
                </a>
            </li>
            @endif
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" style="width: 100px;">
                <a href="{{ $paginator->nextPageUrl() }}" title="pagination" aria-label="{{trans('words.next')}}" class="text-light bg-primary border border-primary">
                    <span aria-hidden="true" class="fas fa-angle-right"></span>
                    <span class="sr-only">{{trans('words.next')}}</span>
                </a>
            </li>
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" style="width: 100px;">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" title="pagination" aria-label="{{trans('words.next')}}" class="text-light bg-primary border border-primary">
                    <span aria-hidden="true" class="fas fa-angle-double-right"></span>
                <span class="sr-only">{{trans('words.next')}}</span>
                </a>
            </li>
    </ul>
    <br>
@endif
<script>
window.onload = function() {
    if (window.innerWidth <= 800) {
        var currentPage = document.querySelector('.pagination .page-item.active');
        var arrowPages = document.querySelectorAll('.pagination .page-item:first-child, .pagination .page-item:nth-child(2), .pagination .page-item:nth-last-child(2), .pagination .page-item:last-child');

        currentPage.style.display = 'block';

        for (var i = 0; i < arrowPages.length; i++) {
            arrowPages[i].style.display = 'block';
        }
    }
};
</script>
<style>
    @media (max-width: 800px) {
        .pagination .page-item {
            display: none;
        }
    }
</style>
