@if ($paginator->hasPages())
    <nav class="pagination is-centered is-rounded p-t-50" role="navigation" aria-label="pagination">
        <?php
            $start = $paginator->currentPage() - 1; // show 3 pagination links before current
            $end = $paginator->currentPage() + 1; // show 3 pagination links after current
            if($start < 1) {
                $start = 1; // reset start to 1
                $end += 1;
            }
            if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
        ?>
        <a class="pagination-previous has-text-white p-l-30 p-r-30" style="background: #E74847;" @if($paginator->currentPage() == 1) disabled @endif href="{{ $paginator->previousPageUrl() }}" ><span class="icon"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span></a>
        <a class="pagination-next has-text-white p-l-30 p-r-30" style="background: #E74847; "@if($paginator->currentPage() == $paginator->lastPage()) disabled @endif href="{{ $paginator->nextPageUrl() }}" ><span class="icon"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span></a>
        <ul class="pagination-list">
            @if($start > 1)
                <li>
                    <a class="pagination-link" href="{{ $paginator->url(1) }}">{{1}}</a>
                </li>
                @if($paginator->currentPage() != 4)
                    {{-- "Three Dots" Separator --}}
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                @endif
            @endif
            @for ($i = $start; $i <= $end; $i++)
                <li><a class="pagination-link {{($paginator->currentPage() == $i) ? ' is-current' : ''}}" href="{{ $paginator->url($i) }}">{{$i}}</a></li>
            @endfor
            @if($end < $paginator->lastPage())
                @if($paginator->currentPage() + 3 != $paginator->lastPage())
                    {{-- "Three Dots" Separator --}}
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                @endif
                <li>
                    <a class="pagination-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
