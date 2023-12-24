@extends('admin.layout.master')

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Top Services')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="day_tab" data-toggle="tab" href="#day" role="tab"
                                aria-controls="day" aria-selected="true">@changeLang('Today')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="week_tab" data-toggle="tab" href="#week" role="tab"
                                aria-controls="week" aria-selected="false">@changeLang('This Week')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="month_tab" data-toggle="tab" href="#month" role="tab"
                                aria-controls="month" aria-selected="false">@changeLang('This Month')</a>
                        </li>


                    </ul>


                </div>

                <div class="card-body text-center">

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="day" role="tabpanel" aria-labelledby="day_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@changeLang('Sl')</th>
                                            <th>@changeLang('Service Name')</th>
                                            <th>@changeLang('Service Count')</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $sl = 1;
                                        @endphp

                                        @forelse ($collections['daily'] as $collection)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $collection['name'] }}</td>
                                                <td>{{ $collection['count'] }}</td>
                                            </tr>

                                        
                                        @empty
   
   
                                        <tr>
   
                                            <td class="text-center" colspan="100%">@changeLang('No Service Found')</td>
   
                                        </tr>
   
   
   
                                    @endforelse


                                    </tbody>
                                </table>
                            </div>
                            {{-- @if ($day->hasPages())
                            {{ $day->links('admin.partials.paginate') }}
                        @endif --}}
                        </div>
                        <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@changeLang('Sl')</th>
                                            <th>@changeLang('Service Name')</th>
                                            <th>@changeLang('Service Count')</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $sl = 1;
                                        @endphp

                                        @forelse ($collections['weekly'] as $collection)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $collection['name'] }}</td>
                                                <td>{{ $collection['count'] }}</td>
                                            </tr>

                                        
                                        @empty
   
   
                                        <tr>
   
                                            <td class="text-center" colspan="100%">@changeLang('No Service Found')</td>
   
                                        </tr>
   
   
   
                                    @endforelse


                                    </tbody>
                                </table>
                            </div>
                            {{-- @if ($week->hasPages())
                            {{ $week->links('admin.partials.paginate') }}
                        @endif --}}
                        </div>
                        <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month_tab">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>@changeLang('Sl')</th>
                                            <th>@changeLang('Service Name')</th>
                                            <th>@changeLang('Service Count')</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $sl = 1;
                                        @endphp

                                        @forelse ($collections['monthly'] as $collection)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $collection['name'] }}</td>
                                                <td>{{ $collection['count'] }}</td>
                                            </tr>

                                        
                                        @empty
   
   
                                        <tr>
   
                                            <td class="text-center" colspan="100%">@changeLang('No Service Found')</td>
   
                                        </tr>
   
   
   
                                    @endforelse


                                    </tbody>
                                </table>
                            </div>
                            {{-- @if ($week->hasPages())
                            {{ $week->links('admin.partials.paginate') }}
                        @endif --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
