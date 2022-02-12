<style>
    li a{
        text-decoration: none;
    }
    .pagination-nav ul {
        width: 100%;
        justify-content: center;
        margin: 40px 0;
        list-style: none;
        display: flex;
    }

    .pagination-nav li {
        background-color: white;
        border-top: 1px solid #F5F5F5;
        border-bottom: 1px solid #F5F5F5;
        border-left: 1px solid #F5F5F5;
        
        color: #1565C0;
        font-size: 12px;
    }

    .pagination-nav li:first-child {
        border-radius: 5px 0 0 5px;
    }


    .pagination-nav li:last-child {
        border-right: 1px solid #F5F5F5;
        border-radius: 0 5px 5px 0;
    }


    li.page-item.disabled {
        background-color: white;
        color: #757575;
        pointer-events: none;
    }

    .page-item a:last-child {
        color: #1976D2;
        display: block;
        width: 100%;
        height: 100%;
    }

    li.page-item a.page-link {
        display: block;
        width: 100%;
        height: 100%;
    }

    li.page-item {
        color: #757575;
        -moz-user-select: none;
        -webkit-user-select: none;
    }

    li.page-item.active {
        background-color: #1976D2;
        color: white;
        display: block;
    }
</style>
@if ($paginator->hasPages())
<div class="pagination-nav">
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" tabindex="-1" aria-label="@lang('pagination.previous')" disabled>
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true" tabindex="-1"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endif

<script>
    const tabs = document.getElementsByClassName('page-item');
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener('click', tabSwitch);

        function tabSwitch() {
            document.getElementsByClassName('active')[0].classList.remove('active');
            this.classList.add('active');
        }
    }
</script>