<div class="pagination">
    <div>
        @if (!$data->onFirstPage())
            <a href="{{ $data->previousPageUrl() }}">
                Prev
            </a>
        @endif
    </div>
    <ul>
        @for ($i = 1; $i <= $data->total() / $data->perPage() + 1; $i++)
            <li class="@if ($data->currentPage() == $i) active @endif">
                @if (Str::contains(request()->fullUrl(), '?'))
                    <a href="{{ request()->fullUrl() }}&page={{ $i }}">{{ $i }}</a>
                @else
                    <a href="{{ request()->url() }}?page={{ $i }}">{{ $i }}</a>
                @endif
            </li>
        @endfor
    </ul>
    <div>
        @if ($data->hasMorePages())
            <a href="{{ $data->nextPageUrl() }}">
                Next
            </a>
        @endif
    </div>
</div>
