@extends('employee.layout.master')

@section('page_title', 'ইমপ্লয়ী ওয়ার্ক শিট')

@section('employee_content')
    <h1>{{ $pageTitle }}</h1>

    <div class="table-responsive" style="overflow-x: auto;">
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
            @php
                // dd($employeetdata);
            @endphp
            <tbody>
                @foreach ($employeetdata as $employee)
                    <tr>
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
                            {{ $employee->daily_target > $employee->target_achive ? $employee->daily_target - $employee->target_achive: 0  }}
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
                                <span class="badge bg-success"><a href="{{ route('view.image',$employee->id)}}">Checked In</a></span>
                            @else
                                <span class="badge bg-danger">Not Checked In</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($employee->created_at->format('Y-m-d') === now()->format('Y-m-d'))
                            <a class="btn btn-sm btn-primary" href="{{ route('upload2.selfie', $employee->id) }}"><i
                                    class="fa-solid fa-camera"></i></a>
                            @else

                            @if ($employee->attendence_selfie)
                            <span class="badge bg-success"><a href="{{ route('view.image',$employee->id)}}"><i class="fa-solid fa-image"></i></a></span>
                        @else
                        <i class="fa-solid fa-eye-low-vision" style="color: #111d32;"></i>
                        @endif


                             @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $employeetdata->links('agent.partials.paginate') }}
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
        });
    </script>
@endpush
