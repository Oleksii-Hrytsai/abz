<div class="text-center mt-3 mt-sm-3">
    <ul class="pagination justify-content-center mb-0">
        @if ($pagination['prev_url'])
            <li class="page-item"><a class="page-link" href="{{ $pagination['prev_url'] }}">Prev</a></li>
        @endif

        @for ($i = 1; $i <= $pagination['total_pages']; $i++)
            <li class="page-item @if ($i == $pagination['current_page']) active @endif">
                <a class="page-link" href="{{ route('fetch-users', ['page' => $i, 'count' => $count]) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($pagination['next_url'])
            <li class="page-item"><a class="page-link" href="{{ $pagination['next_url'] }}">Next</a></li>
        @endif
    </ul>
</div>
