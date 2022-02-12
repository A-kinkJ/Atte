<style>
  .paginationWrap {
    display: flex;
    justify-content: center;
    margin-top: 20px;

  }

  .paginationWrap ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0px -2px;
  }

  .paginationWrap ul.pagination li {
    display: inline-block;
    background-color: white;
    /*padding: 14px 16px;*/
  }

  .paginationWrap ul.pagination li a:first-child .active {
    
    padding: initial;
    background-color: #F5F5F5;
  }

  li .disabled {
    padding: 11px 13px;
  }

  .paginationWrap ul.pagination li:first-child:not(.active) {
    border-right: 4px solid #F5F5F5;
    padding: 9px 11px;
  }


  .paginationWrap ul.pagination li a {
    color: #1565C0;
    padding: 11px 13px;
    background-color: white;
    font-size: 12px;
  }

  .paginationWrap ul.paginatin li:disabled {
    padding: 12px;
  }

  .paginationWrap ul.pagination li a.active {
    background-color: #4b90f6;
    color: white;
    padding: 11px 13px;
  }

  .paginationWrap ul.pagination li a:hover:not(.active) {
    background-color: #e1e7f0;
  }
</style>




@if ($paginator->hasPages())
<div class="paginationWrap">
  <ul class="pagination" role="navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled" aria-disabled="true" tabindex="-1" aria-label="@lang('pagination.previous')">
      < </li>
        @else
    <li>
      <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
        < </a>
    </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li aria-disabled="true">{{ $element }}</li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li aria-current="page"><a class="active" href="#">{{ $page }}</a></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <li>
      <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">></a>
    </li>
    @else
    <li aria-disabled="true" aria-label="@lang('pagination.next')">
      >
    </li>
    @endif
  </ul>
</div>
@endif