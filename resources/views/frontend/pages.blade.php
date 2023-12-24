@extends('frontend.layout.frontend')


@section('content')


@push('seo')
        <meta name='description' content="{{$page->seo_description}}">
@endpush
 @if ($page->sections != null)
        @foreach ($page->sections as $sections)
        {{-- @php
            dd($page);
        @endphp --}}
            @include('frontend.sections.'.$sections, $page)
        @endforeach

    @endif

@endsection
