@extends('employee.layout.master')

@section('page_title', 'পারফরমেন্স')

@section('employee_content')

    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        @changeLang('Daily Target') : <b class="">{{ @$self_performance->daily_target }}</b><br>
                        @changeLang('Target Achieve') : <b class="">{{ @$self_performance->target_achive }}</b><br>
                        @changeLang('Total Registration') : <b class="">{{ @$self_performance->total_final_achive }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->employee_role == 'Zone Manager')
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">

                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="daytl_tab" data-toggle="tab" href="#daytl"
                                    role="tab" aria-controls="daytl" aria-selected="true">@changeLang('Today')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="weektl_tab" data-toggle="tab" href="#weektl" role="tab"
                                    aria-controls="weektl" aria-selected="false">@changeLang('This Week')</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="monthtl_tab" data-toggle="tab" href="#monthtl" role="tab"
                                    aria-controls="monthtl" aria-selected="false">@changeLang('This Month')</a>
                            </li>


                        </ul>


                    </div>
                    <div class="card-body text-center">
                        <h4 class="">টিম লিডার লিস্ট</h4>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="daytl" role="tabpanel"
                                aria-labelledby="daytl_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width: 1000px;">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                                <th scope="col">@changeLang('Employee ID')</th>
                                                <th scope="col">@changeLang('Name')</th>

                                                <th scope="col">@changeLang('Daily Target')</th>
                                                <th scope="col">@changeLang('Target Achieve')</th>
                                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                                <th scope="col">@changeLang('Bonus Point')</th>
                                                <th scope="col">@changeLang('Attendance Status')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($employeedata_today['teamleader'] as $employee)
                                                <tr>
                                                    <td class="text-center">{{ $employee->created_at->format('d M Y') }}
                                                    </td>
                                                    <td class="text-center">{{ $employee->employee_id }}</td>
                                                    <td class="text-center">{{ $employee->user->fname }}</td>

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
                                                            <span class="badge bg-success"><a
                                                                    href="{{ route('view.image', $employee->id) }}">Checked
                                                                    In</a></span>
                                                        @else
                                                            <span class="badge bg-danger">Not Checked In</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($employeedata_today['teamleader']->hasPages())
                                    {{ $employeedata_today['teamleader']->links('admin.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="weektl" role="tabpanel" aria-labelledby="weektl_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width: 1000px;">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                                <th scope="col">@changeLang('Employee ID')</th>
                                                <th scope="col">@changeLang('Name')</th>

                                                <th scope="col">@changeLang('Daily Target')</th>
                                                <th scope="col">@changeLang('Target Achieve')</th>
                                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                                <th scope="col">@changeLang('Bonus Point')</th>
                                                <th scope="col">@changeLang('Attendance Status')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($employeedata_week['teamleader'] as $employee)
                                                <tr>
                                                    <td class="text-center">{{ $employee->created_at->format('d M Y') }}
                                                    </td>
                                                    <td class="text-center">{{ $employee->employee_id }}</td>
                                                    <td class="text-center">{{ $employee->user->fname }}</td>

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
                                                            <span class="badge bg-success"><a
                                                                    href="{{ route('view.image', $employee->id) }}">Checked
                                                                    In</a></span>
                                                        @else
                                                            <span class="badge bg-danger">Not Checked In</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($employeedata_week['teamleader']->hasPages())
                                    {{ $employeedata_week['teamleader']->links('admin.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="monthtl" role="tabpanel" aria-labelledby="monthtl_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width: 1000px;">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                                <th scope="col">@changeLang('Employee ID')</th>
                                                <th scope="col">@changeLang('Name')</th>

                                                <th scope="col">@changeLang('Daily Target')</th>
                                                <th scope="col">@changeLang('Target Achieve')</th>
                                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                                <th scope="col">@changeLang('Bonus Point')</th>
                                                <th scope="col">@changeLang('Attendance Status')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($employeedata_month['teamleader'] as $emp)
                                                <tr>
                                                    <td class="text-center">{{ $emp->created_at->format('d M Y') }}</td>
                                                    <td class="text-center">{{ $emp->employee_id }}</td>
                                                    <td class="text-center">{{ $emp->user->fname }}</td>

                                                    <td class="text-center">{{ $employee->daily_target }}</td>
                                                    <td class="text-center">{{ $employee->target_achive }}</td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            {{ $emp->target_achive > $emp->daily_target ? $emp->target_achive - $employee->daily_target : 0 }}
                                                        @else
                                                            {{ $emp->target_extra_achive }}
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            {{ $emp->daily_target > $emp->target_achive ? $employee->daily_target - $employee->target_achive : 0 }}
                                                        @else
                                                            {{ $emp->target_non_achive }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            TBD
                                                        @else
                                                            {{ $emp->total_final_achive }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            TBD
                                                        @else
                                                            {{ $emp->final_non_achive }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            TBD
                                                        @else
                                                            {{ $emp->bonus_point }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->attendence_selfie)
                                                            <span class="badge bg-success"><a
                                                                    href="{{ route('view.image', $emp->id) }}">Checked
                                                                    In</a></span>
                                                        @else
                                                            <span class="badge bg-danger">Not Checked In</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($employeedata_month['teamleader']->hasPages())
                                    {{ $employeedata_month['teamleader']->links('admin.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="micro" role="tabpanel" aria-labelledby="micro_tab">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->employee_role == 'Team Leader' || auth()->user()->employee_role == 'Zone Manager')
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">

                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="day_tab" data-toggle="tab" href="#day"
                                    role="tab" aria-controls="day" aria-selected="true">@changeLang('Today')</a>
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
                        <h4 class="">ব্রান্ড প্রোমোটার লিস্ট</h4>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="day" role="tabpanel"
                                aria-labelledby="day_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width: 1000px;">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                                <th scope="col">@changeLang('Employee ID')</th>
                                                <th scope="col">@changeLang('Name')</th>

                                                <th scope="col">@changeLang('Daily Target')</th>
                                                <th scope="col">@changeLang('Target Achieve')</th>
                                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                                <th scope="col">@changeLang('Bonus Point')</th>
                                                <th scope="col">@changeLang('Attendance Status')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($employeedata_today['brandpromoter'] as $employee)
                                                <tr>
                                                    <td class="text-center">{{ $employee->created_at->format('d M Y') }}
                                                    </td>
                                                    <td class="text-center">{{ $employee->employee_id }}</td>
                                                    <td class="text-center">{{ $employee->user->fname }}</td>

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
                                                            <span class="badge bg-success"><a
                                                                    href="{{ route('view.image', $employee->id) }}">Checked
                                                                    In</a></span>
                                                        @else
                                                            <span class="badge bg-danger">Not Checked In</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($employeedata_today['brandpromoter']->hasPages())
                                    {{ $employeedata_today['brandpromoter']->links('admin.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width: 1000px;">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                                <th scope="col">@changeLang('Employee ID')</th>
                                                <th scope="col">@changeLang('Name')</th>

                                                <th scope="col">@changeLang('Daily Target')</th>
                                                <th scope="col">@changeLang('Target Achieve')</th>
                                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                                <th scope="col">@changeLang('Bonus Point')</th>
                                                <th scope="col">@changeLang('Attendance Status')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($employeedata_week['brandpromoter'] as $employee)
                                                <tr>
                                                    <td class="text-center">{{ $employee->created_at->format('d M Y') }}
                                                    </td>
                                                    <td class="text-center">{{ $employee->employee_id }}</td>
                                                    <td class="text-center">{{ $employee->user->fname }}</td>

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
                                                            <span class="badge bg-success"><a
                                                                    href="{{ route('view.image', $employee->id) }}">Checked
                                                                    In</a></span>
                                                        @else
                                                            <span class="badge bg-danger">Not Checked In</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($employeedata_week['brandpromoter']->hasPages())
                                    {{ $employeedata_week['brandpromoter']->links('admin.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month_tab">

                                <div class="table-responsive">
                                    <table class="table table-striped" style="min-width: 1000px;">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 140px">@changeLang('Date')</th>
                                                <th scope="col">@changeLang('Employee ID')</th>
                                                <th scope="col">@changeLang('Name')</th>

                                                <th scope="col">@changeLang('Daily Target')</th>
                                                <th scope="col">@changeLang('Target Achieve')</th>
                                                <th scope="col">@changeLang('Target Extra Achieve')</th>
                                                <th scope="col">@changeLang('Target Non Achieve')</th>
                                                <th scope="col">@changeLang('Total Final Achieve')</th>
                                                <th scope="col">@changeLang('Final Non Achieve')</th>
                                                <th scope="col">@changeLang('Bonus Point')</th>
                                                <th scope="col">@changeLang('Attendance Status')</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($employeedata_month['brandpromoter'] as $emp)
                                                <tr>
                                                    <td class="text-center">{{ $emp->created_at->format('d M Y') }}</td>
                                                    <td class="text-center">{{ $emp->employee_id }}</td>
                                                    <td class="text-center">{{ $emp->user->fname }}</td>

                                                    <td class="text-center">{{ $employee->daily_target }}</td>
                                                    <td class="text-center">{{ $employee->target_achive }}</td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            {{ $emp->target_achive > $emp->daily_target ? $emp->target_achive - $employee->daily_target : 0 }}
                                                        @else
                                                            {{ $emp->target_extra_achive }}
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            {{ $emp->daily_target > $emp->target_achive ? $employee->daily_target - $employee->target_achive : 0 }}
                                                        @else
                                                            {{ $emp->target_non_achive }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            TBD
                                                        @else
                                                            {{ $emp->total_final_achive }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            TBD
                                                        @else
                                                            {{ $emp->final_non_achive }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                                                            TBD
                                                        @else
                                                            {{ $emp->bonus_point }}
                                                        @endif

                                                    </td>
                                                    <td class="text-center">
                                                        @if ($emp->attendence_selfie)
                                                            <span class="badge bg-success"><a
                                                                    href="{{ route('view.image', $emp->id) }}">Checked
                                                                    In</a></span>
                                                        @else
                                                            <span class="badge bg-danger">Not Checked In</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                    </tr>
                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($employeedata_month['brandpromoter']->hasPages())
                                    {{ $employeedata_month['brandpromoter']->links('admin.partials.paginate') }}
                                @endif
                            </div>
                            <div class="tab-pane fade" id="micro" role="tabpanel" aria-labelledby="micro_tab">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
