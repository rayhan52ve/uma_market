@php

    $content = content('banner.content');

    // $vehicles = App\Models\Vehicle::orderBy('name', 'ASC')
    //     ->take(6)
    //     ->get();
    $locations = [];

    $all_vehicles = App\Models\Service::where([['status',1],['admin_approval',1]])->pluck('vehicle')->toArray();

    $vehicles = array_unique($all_vehicles);

    $all_location = App\Models\Service::where([['status',1],['admin_approval',1]])->pluck('location')->toArray();

    $locations = array_unique($all_location);

@endphp

<!--Slider Start-->
<div class="slider" id="main-slider">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="doc-search-item">
                    <div class="d-flex align-items-center h-100">
                        <div class="v-mid-content">
                            <div class="heading">
                                <h2>{{ __(@$content->data->title) }}</h2>
                                <p>{{ __(@$content->data->sub_title) }}</p>
                            </div>
                            <div class="doc-search-section">
                                <form action="{{route('experts.search')}}" method="get">
                                    {{-- <div class="box box-search mt-2"> --}}
                                    <div>
                                        <input type="hidden" name="search" class="form-control"
                                            placeholder="@changeLang('Search by expert')">
                                    </div>
                                    <div class="box mt-2">
                                        <select class="form-control form-select select2" name="location">
                                            <option value="">@changeLang('Search By Location')</option>
                                            <option value="">  পুরো দেশ </option>
                                            @foreach ($locations as $loc)
                                                <option>{{ __($loc) }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="box mt-2">
                                        <select class="form-control form-select select2" name="vehicle">
                                            <option value="">@changeLang('Search By Category')</option>
                                            <option value=""> সকল যানবাহন </option>
                                            @foreach ($vehicles as $vehicle)
                                                <option>{{ __($vehicle) }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="doc-search-button mt-2">
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 banner-img">
                <img src="@if (@$content->data->image) {{ getFile('banner', @$content->data->image) }} @else {{ getFile('logo', @$general->default_image) }} @endif"
                    alt="">
            </div>
        </div>
    </div>

</div>
<!--Slider End-->
