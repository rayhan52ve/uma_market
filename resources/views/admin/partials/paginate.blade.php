<div class="card-footer text-right">
    <nav class="d-inline-block">

        <ul class="pagination mb-0">
            @if($paginator->onFirstPage())

            @else
            <li class="page-item">
                <a class="page-link" href="{{$paginator->previousPageUrl()}}" tabindex="-1">
                @if($general->site_direction == 'rtl')
                <i class="fas fa-chevron-right"></i>
                @else
                    <i class="fas fa-chevron-left"></i>
                @endif
                </a>
            </li>
            @endif

            @foreach ($elements as $element)

                @if (count($element) < 2)


                @else

                @foreach ($element as $key=> $el)

                    <li class="page-item {{ $key == $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $el }}">{{$key}}</a>
                    </li>
                    
                @endforeach
                @endif
            @endforeach

         @if($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{$paginator->nextPageUrl()}}">
                 @if($general->site_direction == 'rtl')
                <i class="fas fa-chevron-left"></i>
                @else
                    <i class="fas fa-chevron-right"></i>
                @endif
                </a>
            </li>
        @endif
        </ul>
    </nav>
</div>
