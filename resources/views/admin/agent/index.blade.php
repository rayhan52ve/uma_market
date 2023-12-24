@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            {{-- @if (request()->routeIs('admin.user'))
                <h1>All Agents</h1>
                <h1>@changeLang('All Agents')</h1>
            @else
                <h1>Disabled Agents</h1>
                <h1>@changeLang('Disabled Agents')</h1>
            @endif --}}
            <h1>@changeLang('All Agents')</h1>
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
                                    <th>@changeLang('Phone')</th>
                                    <th>@changeLang('Referral Code')</th>
                                    <th>@changeLang('Address')</th>
                                    <th>@changeLang('Status')</th>
                                    <th>@changeLang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agents as $key => $agent)
                                    <tr>
                                        <td>{{ $key + $agents->firstItem() }}</td>
                                        <td>{{ __($agent->fullname) }}</td>
                                        <td>{{ __($agent->mobile) }}</td>
                                        <td>{{ __($agent->referral) }}</td>
                                        <td>{{ __(@$agent->division->bn_name) }}, {{ @$agent->district->bn_name }}, {{ @$agent->upazila->bn_name }}, {{ @$agent->union->bn_name }}</td>
                                        <td>
                                            @if ($agent->status)
                                                <span class='badge badge-success'>@changeLang('Active')</span>
                                            @else
                                                <span class='badge badge-danger'>@changeLang('Inactive')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.agent.edit', $agent) }}"
                                                    class="btn btn-primary mr-2"><i class="fa fa-pen"></i></a>
                                                <a href="{{ route('admin.agent.show', $agent) }}"
                                                    class="btn btn-info mr-2"><i class="fa fa-eye"></i></a>
                                                 {{--<form action="{{ route('admin.agent.destroy', $agent) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </form> --}}
                                                <a href="#" class="btn btn-icon btn-danger delete"
                                                data-url="{{ route('admin.agent.destroy', $agent) }}"><i
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
                @if ($agents->hasPages())
                    <div class="card-footer">
                        {{ $agents->links('admin.partials.paginate') }}
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

                        <p>@changeLang('Are You Sure To Delete Agent')?</p>
                       
                        <div class="d-flex justify-content-end">
                            {{-- <button type="button" class="btn btn-secondary mr-3"
                                data-dismiss="modal">@changeLang('Close')</button> --}}
                @forelse($agents as $key => $agent)
                      <form action="{{ route('admin.agent.destroy', $agent) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                 @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">@changeLang('No users Found')</td>
                                    </tr>
                                @endforelse
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
