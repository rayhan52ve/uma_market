@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1> {{ $customer_name}} এর সকল
                ট্রিপ</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">

                <div class="card-body text-center">

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="all_trips" role="tabpanel" aria-labelledby="all_trips_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-left">
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Customer')</th>
                                        <th>@changeLang('Vehicle Name')</th>
                                        <th>@changeLang('Load Location')</th>
                                        <th>@changeLang('Unload Location')</th>
                                        <th>@changeLang('Loading Date/Time')</th>
                                        <th>@changeLang('Status')</th>
                                        <th>@changeLang('Action')</th>
                                    </tr>
                                    @forelse ($all_trips as $all_trip)
                                        <tr class="text-left">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $all_trip->customer->fname }}</td>
                                            <td>{{ $all_trip->vehicle->name }}</td>
                                            <td>{{ $all_trip->start_location }}</td>
                                            <td>{{ $all_trip->end_location }}</td>
                                            <td>{{ date('d-M-y', strtotime($all_trip->starting_date)) }} |
                                                {{ date('h:i A', strtotime($all_trip->starting_time)) }}</td>
                                            <td><span
                                                    class="badge {{ $all_trip->status == 'ordered' ? 'badge-warning' : ($all_trip->status == 'in-progress' ? 'badge-info' : ($all_trip->status == 'completed' ? 'badge-success' : 'badge-danger')) }}">
                                                    {{ $all_trip->status }}
                                                </span></td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('admin.trips.show_provider_bidding',$all_trip->id)}}"><i class="fa fa-eye"></i></a>

                                                <button class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            @if ($all_trips->hasPages())
                                {{ $all_trips->links('admin.partials.paginate') }}
                            @endif
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection


@push('custom-script')
    <script></script>
@endpush
