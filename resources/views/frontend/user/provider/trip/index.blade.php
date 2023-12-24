@extends('frontend.layout.master')
@section('breadcrumb')
    <section class="section">

        <div class="section-header d-flex justify-content-between">

            <h1>@changeLang('All Trips')</h1>

            <a href="{{ route('user.dashboard') }}" class="btn btn-link">
                <i class="fa fa-home"></i>
            </a>
        </div>
    </section>
@endsection
@section('content')
    <div id="allTrip">
        <div class="row">
            <div class="form-group col-md-4 col-12">
                <select v-on:change="searchLoad()" class="form-control form-select" id="loadLocation"
                    v-model="search.load_location">
                    <option v-if="vehicle_id == 1" selected value=""> লোড লোকেশন </option>
                    <option v-else selected value=""> যাত্রা শুরুর স্থান </option>
                    @foreach ($upazilas as $upazila)
                        <option value="{{ $upazila->bn_name }}">{{ $upazila->bn_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4 col-12">
                <select v-on:change="searchLoad()" class="form-control form-select" id="unloadLocation"
                    v-model="search.unload_location">
                    <option v-if="vehicle_id == 1" selected value=""> আনলোড লোকেশন </option>
                    <option v-else selected value=""> গন্তব্যস্থান </option>
                    @foreach ($upazilas as $upazila)
                        <option value="{{ $upazila->bn_name }}">{{ $upazila->bn_name }}</option>
                    @endforeach
                </select>
            </div>

            @if ($vehicle == 'ট্রাক')
                <div class="form-group col-md-4 col-12">
                    <select v-on:change="searchLoad()" class="form-control form-select" id="vehicleType"
                        v-model="search.truck_type">
                        <option selected value="">গাড়ির ধরণ </option>
                        @foreach ($truck_types as $truck_type)
                            <option value="{{ $truck_type->id }}">{{ $truck_type->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>

        <div v-if="trips != null" class="row" id="searchResults" v-for="trip in trips">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 ">
                                <img v-if="trip.customer.image != null" :src="'/backend/images/user/' + trip.customer.image"
                                    alt="" class="customer_image">
                                <img v-else src="{{ asset('backend/images/default-user.png') }}" alt=""
                                    class="customer_image">
                            </div>

                            <div class="col-md-8 d-flex align-items-center ">
                                @if ($vehicle == 'ট্রাক')
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label v-if="trip.vehicle_id == 1" class="custom_label">লোড লোকেশন: </label>
                                                <label v-else class="custom_label">যাত্রা শুরুর স্থান: </label>

                                                @{{ trip.start_location }}
                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label v-if="trip.vehicle_id == 1" class="custom_label">আনলোড লোকেশন :
                                                </label>
                                                <label v-else class="custom_label">গন্তব্যস্থান: </label>

                                                @{{ trip.end_location }}
                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label">পণ্যের বিবরণ : </label>
                                                @{{ trip.product_description }}
                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label">টন : </label> @{{ trip.ton }}
                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label">গাড়ীর ধরণ : </label>
                                                @{{ trip.vehicle.name }}
                                                <span v-if="trip.truck_type != null">@{{ '(' + trip.truck.name + ')' }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="customer_text">
                                                <label class="custom_label">লোডের তারিখ : </label>
                                                @{{ new Date(trip.starting_date).toLocaleString('default', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
}) }}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="customer_text">
                                                <label class="custom_label">লোডের সময় : </label>
                                                @{{ trip.starting_time }}
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                        <div class="customer_text">
                                            <label class="custom_label">লোডের সময় : </label>
                                            @{{ formatTime12Hours(trip.starting_time) }}
                                        </div>
                                    </div> --}}


                                    </div>
                                @endif

                                @if ($vehicle != 'ট্রাক')
                                    <div class="row">
                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label v-if="trip.vehicle_id == 1" class="custom_label">লোড লোকেশন: :
                                                </label>
                                                <label v-else class="custom_label">যাত্রা শুরুর স্থান: </label>

                                                @{{ trip.start_location }}
                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label v-if="trip.vehicle_id == 1" class="custom_label">আনলোড লোকেশন :
                                                </label>
                                                <label v-else class="custom_label">গন্তব্যস্থান: </label>

                                                @{{ trip.end_location }}
                                            </div>
                                        </div>

                                        <div v-if="trip.vehicle_id != 5" class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label">যাত্রীসংখ্যা : </label> @{{ trip.passenger_count }}
                                            </div>
                                        </div>

                                        <div v-if="trip.vehicle_id == 5" class=" col-md-6">
                                            <div class="customer_text">
                                                <label v-if="trip.without_driver == 1" class="custom_label">চালকের ধরণ :

                                                </label>
                                                চালক ছাড়া
                                                <label v-else class="custom_label">চালকের ধরণ :</label>
                                                চালক সহ
                                            </div>
                                        </div>

                                        <div class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label">গাড়ীর ধরণ : </label>
                                                @{{ trip.vehicle.name }}
                                                <span v-if="trip.truck_type != null">@{{ '(' + trip.truck.name + ')' }}</span>
                                            </div>
                                        </div>
                                        {{-- <div v-if="trip.vehicle_id == 5 && trip.without_driver == 1" class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label"> বাইক ব্রান্ড :
                                                </label>
                                                @{{ trip.bike_brand_id }}
                                            </div>
                                        </div>


                                        <div v-if="trip.vehicle_id == 5 && trip.without_driver == 1" class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label"> বাইক সিসি :
                                                </label>
                                                @{{ trip.bike_model_id }} সিসি
                                            </div>
                                        </div>
                                        <div v-if="trip.vehicle_id == 5 && trip.without_driver == 1" class=" col-md-6">
                                            <div class="customer_text">
                                                <label class="custom_label"> বাইক মডেল :
                                                </label>
                                                @{{ trip.bike_model_id }}
                                            </div>
                                        </div> --}}

                                        <div class="col-md-12">
                                            <div class="customer_text">
                                                <label class="custom_label">যাত্রা শুরুর তারিখ : </label>
                                                @{{ new Date(trip.starting_date).toLocaleString('default', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
}) }}
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="customer_text">
                                                <label class="custom_label">যাত্রা শুরুর সময় : </label>
                                                @{{ trip.starting_time }}
                                            </div>
                                        </div>

                                    </div>
                                @endif

                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <div class="w-100">
                                    <a :href="'provider-trip/bid-confirm/' + trip.id" class="btn btn-primary btn-block">বিড
                                        করুন <a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <style>
        .customer_image {
            width: 100%;
            border-radius: 50%;
        }

        .customer_text {
            font-size: 1.4em;
        }

        .custom_label {
            font-weight: 600;
            font-size: 1em;
            color: #828282;
        }

        @media (max-width: 480px) {

            .customer_image {
                margin-bottom: 1rem
            }

        }
    </style>
@endpush

@push('custom-script')
    <script>
        let app = new Vue({
            el: '#allTrip',
            data() {
                return {
                    search: {
                        load_location: '',
                        unload_location: '',
                        truck_type: '',
                    },
                    vehicle_id: '{{ $vehicle_id }}',
                    provider_id: '{{ auth()->user()->id }}',
                    trips: []
                }
            },
            methods: {
                searchLoad: function() {
                    let ref = this;
                    ref.getTrips();
                },
                getTrips() {
                    let ref = this;
                    let url = '/api/trip/list';
                    axios.get(url, {
                        params: {
                            load_location: ref.search.load_location,
                            unload_location: ref.search.unload_location,
                            truck_type: ref.search.truck_type,
                            vehicle_id: ref.vehicle_id,
                            provider_id: ref.provider_id
                        }
                    }).then(function(response) {
                        let data = response.data.data;
                        ref.trips = data;
                    });
                }



            },
            created() {
                this.getTrips();
            }

        });
    </script>
@endpush
