
@php
    $maximumPageView = 7;
@endphp
@if ($paginator->lastPage() > 1)
<div id="user-list-page-info" class="col-md-6">
    <span>Halaman {{ $paginator->currentPage() }} dari total {{ $paginator->total() }} Data</span>
</div>
<div class="col-md-6">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end mb-0">
            <li class="page-item {{ ($paginator->currentPage() == 1) ? 'disabled' : ''}}">
                <a class="page-link" href="{{ $paginator->previousPageUrl()	 }}" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            @for($i = 1; $i <= $paginator->lastPage(); $i++ )
                <li class="page-item {{ ($paginator->currentPage() ==  $i) ? 'active' : '' }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl()}}">Next</a>
            </li>
        </ul>
    </nav>
</div>
@else 
<div id="user-list-page-info" class="col-md-6">
    <span>Halaman {{ $paginator->currentPage() }} dari total {{ $paginator->total() }} Data</span>
</div>
@endif