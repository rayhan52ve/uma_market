@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('All subadmins')</h1>
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
                                    <th>@changeLang('Email')</th>
                                    <th>@changeLang('Created At')</th>
                                    <th>@changeLang('Updated At')</th>
                                    <th>@changeLang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subadmins as $key => $subadmin)
                                    <tr>
                                        <td>{{ $key + $subadmins->firstItem() }}</td>
                                        <td>{{ __($subadmin->username) }}</td>
                                        <td>{{ __($subadmin->email) }}</td>
                                        <td>{{ __($subadmin->created_at->toDayDateTimeString()) }}</td>
                                        <td>{{ __($subadmin->created_at != $subadmin->updated_at ? $subadmin->updated_at->toDayDateTimeString():'Not Updated') }}</td>
                     
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.sub-admin.edit', $subadmin) }}" class="btn btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                                <a href="#" class="btn btn-icon btn-danger delete"
                                                data-url="{{ route('admin.sub-admin.destroy', $subadmin) }}"><i
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
                @if ($subadmins->hasPages())
                    <div class="card-footer">
                        {{ $subadmins->links('admin.partials.paginate') }}
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
                            <button type="button" class="btn btn-secondary mr-3"
                                data-dismiss="modal">@changeLang('Close')</button>

                                <form action="{{ route('admin.sub-admin.destroy', $subadmins) }}" method="POST">
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
