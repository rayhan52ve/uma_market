@php
    
    $content = content('service.content');
    $element = element('service.element', 15);
    
@endphp

@push('custom-css')
    <style>
        .service-card img {
            height: 65px;
            width: 70px;
        }

        .service-card:hover {
            box-shadow: 3px 3px 6px -3px var(--primary);
        }
    </style>
@endpush
<!--Service Start-->
<div class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-headline text-center">
                    <h2 class="font-weight-bold">{{ __(@$content->data->title) }}</h2>
                    {{-- <p>{{__(@$content->data->sub_title)}}</p> --}}
                </div>
            </div>
        </div>
        <div class="row service-row mt_30">
            @foreach ($element as $service)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('home.service', @$service->data->title) }}">
                        <div class="d-flex justify-content-between align-items-center p-2 border mb-3 service-card">
                            <div class="col-md-8 text-center">
                                <span>{{ __(@$service->data->title) }}</span>
                            </div>
                            <div class="col-md-4 text-right">
                                <img src="{{ getFile('service', @$service->data->image) }}" alt="">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!--Service End-->
