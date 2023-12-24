@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            {{-- @if (request()->routeIs('admin.user'))
                <h1>@changeLang('All Employees')</h1>
            @else
                <h1>@changeLang('Disabled Employees')</h1>
            @endif --}}
            <h1>@changeLang('All Employees')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4></h4>
                    <div class="card-header-form">
                        <form method="GET" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@changeLang('Sl')</th>
                                    <th>@changeLang('Full Name')</th>
                                    <th>@changeLang('Employee Role')</th>
                                    <th>@changeLang('Phone')</th>
                                    <th>@changeLang('Referral Code')</th>
                                    <th>@changeLang('Location')</th>
                                    <th>@changeLang('Status')</th>
                                    <th>@changeLang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $key + $employees->firstItem() }}</td>
                                        <td>{{ __($employee->fullname) }}</td>
                                        <td>{{ __($employee->employee_role) }}</td>
                                        <td>{{ __($employee->mobile) }}</td>
                                        <td>{{ __($employee->referral) }}</td>
                                        <td>{{ __(@$employee->division->bn_name,) }}, {{@$employee->district->bn_name}}, {{@$employee->upazila->bn_name}}, {{@$employee->union->bn_name}}</td>
                                        <td>
                                            @if ($employee->status)
                                                <span class='badge badge-success'>@changeLang('Active')</span>
                                            @else
                                                <span class='badge badge-danger'>@changeLang('Inactive')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.employee.edit', $employee->id) }}" class="btn btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                                <a href="{{ route('admin.employee.show', $employee) }}" class="btn btn-info mr-2"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.worksheet.view',$employee)}}"class="btn btn-success mr-2" ><i class="fa fa-user"></i></a>
                                                <a href="#" class="btn btn-icon btn-danger delete"
                                                data-url="{{ route('admin.employee.destroy', $employee) }}"><i
                                                    class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No users Found')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($employees->hasPages())
                    <div class="card-footer">
                        {{ $employees->links('admin.partials.paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@changeLang('Delete Page')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf

                        <p>@changeLang('Are You Sure To Delete Pages')?</p>

                        <div class="d-flex justify-content-end">
                            {{-- <button type="button" class="btn btn-secondary mr-3"
                                data-dismiss="modal">@changeLang('Close')</button> --}}

                                <form action="{{ route('admin.employee.destroy', $employees) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>

                            {{-- <button type="submit" class="btn btn-danger">@changeLang('Delete Page')</button> --}}
                        </div>

                    </form>
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
            })
        })
    </script>

@endpush
