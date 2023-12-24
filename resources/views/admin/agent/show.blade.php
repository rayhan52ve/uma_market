@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            {{-- @if (request()->routeIs('admin.user'))
                <h1>All vendors</h1>
                <h1>@changeLang('All vendors')</h1>
            @else
                <h1>Disabled vendors</h1>
                <h1>@changeLang('Disabled vendors')</h1>
            @endif --}}
            <h1>{{ $agent->fullname }}</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4></h4>

                </div>
                <div class="card-body p-0">

                    <div class="row ml-2">
                        {{-- Agent Info --}}

                        <div class="row col-md-4">
                            <div class="">
                                <div class="card">
                                    <div class="card-header">
                                        <h3> @changeLang('Agent Info')</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th scope="col">@changeLang('ID')</th>
                                                    <td><b>{{ $agent->id }}<b></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">@changeLang('Full Name')</th>
                                                    <td><b>{{ $agent->fullname }}<b></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">@changeLang('Phone')</th>
                                                    <td><b>{{ $agent->mobile }}<b></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">@changeLang('Referral Code')</th>
                                                    <td><b>{{ $agent->referral }}<b></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">@changeLang('Address')</th>
                                                    <td><b>{{ __(@$agent->division->bn_name) }}, {{ @$agent->district->bn_name }},
                                                            {{ @$agent->upazila->bn_name }}, {{ @$agent->union->bn_name }}<b></td>
                                                </tr>

                                                <tr>
                                                    <th scope="col">@changeLang('Created At')</th>
                                                    <td>{{ $agent->created_at->toDayDateTimeString() }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">@changeLang('Updated At')</th>
                                                    <td>{{ $agent->created_at != $agent->updated_at ? $agent->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                                    </td>
                                                </tr>

                                                {{-- <tr>
                                                <th scope="col">Priority</th>
                                                @if ($agent->priority == 1)
                                                    <td class="text-danger"><b>High Priority<b></td>
                                                @elseif($agent->priority==2)
                                                    <td class="text-warning"><b>Medium Priority<b></td>
                                                @else
                                                    <td class="text-success"><b>Low Priority<b></td>
                                                @endif
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- Counters --}}
                        <div class="col-md-8 ml-2">
                            <div class="row">
                                <div class=" col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>@changeLang('Total Registration')</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalReg }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>@changeLang('Total User')</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalCustomer }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-info">
                                            <i class="fas fa-person-booth"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>@changeLang('Total Provider')</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalProvider }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <i class="fas fa-truck-pickup"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>@changeLang('Running Trip')</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalRunningOrder }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-danger">
                                            <i class="fas fa-truck-pickup"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>@changeLang('Canceled Trips')</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalCanceledOrder }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <i class="fas fa-truck-pickup"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>@changeLang('Confirmed Trips')</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $totalConfirmOrder }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Customer & Vendor Table --}}

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Full Name')</th>
                                    <th>@changeLang('User Type')</th>
                                    <th>@changeLang('Phone')</th>
                                    <th>@changeLang('Address')</th>
                                    <th>@changeLang('Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sl = 1;
                                @endphp
                                @forelse ($customer_vendors as $vendor)
                                    <tr>


                                        <td>{{ $sl++ }}</td>
                                        <td>{{ __($vendor->fullname) }}</td>
                                        <td>{{ __($vendor->user_type == 1 ? 'Customer' : 'Provider') }}</td>
                                        <td>{{ __($vendor->mobile) }}</td>
                                        <td>{{ __(@$vendor->division->bn_name) }}, {{ @$vendor->district->bn_name }},
                                            {{ @$vendor->upazila->bn_name }}, {{ @$vendor->union->bn_name }}</td>
                                        <td>
                                            @if ($vendor->status)
                                                <span class='badge badge-success'>@changeLang('Active')</span>
                                            @else
                                                <span class='badge badge-danger'>@changeLang('Inactive')</span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty


                                    <tr>

                                        <td class="text-center" colspan="100%">@changeLang('No User Found')</td>

                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- @if ($vendors->hasPages())
                    <div class="card-footer">
                        {{ $vendors->links('admin.partials.paginate') }}
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
@endsection


@push('custom-script')
    <script>
        $(function() {

            $('.delete').on('click', function() {
                const modal = $('#deleteModal');

                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            })
        })
    </script>
@endpush
