@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('All Targets')</h1>
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
                        {{-- <a href="{{ route('admin.set.create') }}" class="btn btn-outline-primary" style="float:left;">Add Bonus</a> --}}
                        <form method="GET" action="" style="float: right;">
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
                                    <th>@changeLang('Phone')</th>
                                    <th>@changeLang('location')</th>
                                    <th>@changeLang('Target')</th>
                                    <th>@changeLang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $key + $employees->firstItem() }}</td>
                                        <td>{{ __($employee->fullname) }}</td>
                                        <td>{{ __($employee->mobile) }}</td>
                                        <td>
                                            {{ $employee->division->bn_name }},
                                            {{ $employee->district->bn_name }},
                                            {{ $employee->upazila->bn_name }},

                                        </td>
                                        <td>
                                           @if ($employee->target == NULL)
                                           No target
                                           @else
                                           {{$employee->target}}
                                           @endif

                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.set.edit', $employee->email) }}" class="btn btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Bonas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
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

                            <form action="" method="POST">
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
