@extends('admin.layout.master')

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Worksheet')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="table-responsive" style="overflow-x: auto;">
        <div class="card-header">

            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="today_works_tab" data-toggle="tab" href="#today_works" role="tab"
                        aria-controls="today_works" aria-selected="true">আজকের শিট</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="previous_works_tab" data-toggle="tab" href="#previous_works" role="tab"
                        aria-controls="previous_works" aria-selected="false">পূর্বের শিট</a>
                </li>
            </ul>

        </div>
        <div class="card-body text-center">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="today_works" role="tabpanel" aria-labelledby="today_works_tab">
                    {{-- today works --}}
                    <table class="table table-striped" style="min-width: 1000px;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                <th scope="col">@changeLang('Daily Target')</th>
                                <th scope="col">@changeLang('Target Achieve')</th>
                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                <th scope="col">@changeLang('Bonus Point')</th>
                                <th scope="col">@changeLang('Attendance Status')</th>
                                <th scope="col">@changeLang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todaysworksheets as $employee)
                                <tr>
                                    <!-- Rows for today's data -->
                                    <td class="text-center">{{ $employee->created_at->format('d M Y') }}</td>
                                    <td class="text-center">{{ $employee->daily_target }}</td>
                                    <td class="text-center">{{ $employee->target_achive }}</td>
                                    <td class="text-center">
                                        @if ($employee->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                            {{ $employee->target_achive > $employee->daily_target ? $employee->target_achive - $employee->daily_target : 0 }}
                                        @else
                                            {{ $employee->target_extra_achive }}
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($employee->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                            {{ $employee->daily_target > $employee->target_achive ? $employee->daily_target - $employee->target_achive : 0 }}
                                        @else
                                            {{ $employee->target_non_achive }}
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if ($employee->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                            TBD
                                        @else
                                            {{ $employee->total_final_achive }}
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if ($employee->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                            TBD
                                        @else
                                            {{ $employee->final_non_achive }}
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        @if ($employee->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                            TBD
                                        @else
                                            {{ $employee->bonus_point }}
                                        @endif

                                    </td>


                                    <td class="text-center">
                                        @if ($employee->attendence_selfie)
                                            <span class="badge bg-success btn btn-sm"><a
                                                    href="{{ route('admin.image.view', $employee->id) }}">Checked
                                                    In</a></span>
                                        @else
                                            <span class="badge bg-danger">Not Checked In</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex">
                                            <a href="{{ route('admin.set_target.edit', $employee->id) }}"
                                                class="btn btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($todaysworksheets->hasPages())
                        {{ $todaysworksheets->links('admin.partials.paginate') }}
                    @endif
                    {{-- <div class="d-flex justify-content-center">

                    </div> --}}
                </div>
                <div class="tab-pane fade" id="previous_works" role="tabpanel" aria-labelledby="previous_works_tab">
                    {{-- previous works --}}
                    <table class="table table-striped" style="min-width: 1000px;">
                        <thead>
                            <tr>
                                <!-- Define the column headers for Previous Works -->
                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                <th scope="col">@changeLang('Daily Target')</th>
                                <th scope="col">@changeLang('Target Achieve')</th>
                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                <th scope="col">@changeLang('Bonus Point')</th>
                                <th scope="col">@changeLang('Attendance Status')</th>
                                <th scope="col">@changeLang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($previousworksheets as $employee)
                                <tr>
                                    <!-- Rows for previous data -->
                                    <td class="text-center">{{ $employee->created_at->format('d M Y') }}</td>
                                    <td class="text-center">{{ $employee->daily_target }}</td>
                                    <td class="text-center">{{ $employee->target_achive }}</td>
                                    <td class="text-center">{{ $employee->target_extra_achive }}</td>
                                    <td class="text-center">{{ $employee->target_non_achive }}</td>
                                    <td class="text-center">{{ $employee->total_final_achive }}</td>
                                    <td class="text-center">{{ $employee->final_non_achive }}</td>
                                    <td class="text-center">{{ $employee->bonus_point }}</td>
                                    <td class="text-center">
                                        @if ($employee->attendence_selfie)
                                            <span class="badge bg-success btn btn-sm"><a
                                                    href="{{ route('admin.image.view', $employee->id) }}">Checked
                                                    In</a></span>
                                        @else
                                            <span class="badge bg-danger">Not Checked In</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex">
                                            <a href="{{ route('admin.set_target.edit', $employee->id) }}"
                                                class="btn btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="d-flex justify-content-center">
                        {{ $previousworksheets->links('admin.partials.paginate') }}
                    </div> --}}
                    @if ($previousworksheets->hasPages())
                        {{ $previousworksheets->links('admin.partials.paginate') }}
                    @endif
                </div>
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
            });

            // // Handle tab switching behavior
            // $('#today_works_tab').on('click', function() {
            //     $('#previous_works').removeClass('show active');
            //     $('#today_works').addClass('show active');
            // });

            // $('#previous_works_tab').on('click', function() {
            //     $('#today_works').removeClass('show active');
            //     $('#previous_works').addClass('show active');
            // });
        });
    </script>
@endpush
