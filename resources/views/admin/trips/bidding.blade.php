@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">

            <h1>@changeLang('All Bidding')</h1>
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
                                    <th>@changeLang('Customer')</th>
                                    <th>@changeLang('Provider')</th>
                                    <th>@changeLang('Bid Amount')</th>
                                    <th>@changeLang('Status')</th>
                                    <th>@changeLang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($biddings as $key => $bidding)
                                    <tr>
                                        <td>{{ $key + $biddings->firstItem() }}</td>
                                        <td>{{ __(@$bidding->customer->fname) }}</td>
                                        <td>{{ __(@$bidding->provider->fname) }}</td>
                                        <td>{{ __($bidding->bid_amount) }}</td>
                                        <td>
                                            @if ($bidding->status==2)
                                             <span class='badge badge-danger'>Rejected</span>
                                            @elseif ($bidding->status==1)
                                             <span class='badge badge-success'>Accepted</span>
                                            @else
                                             <span class='badge badge-warning'>Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                           <a href="{{ route('admin.trips.show_provider',$bidding)}}" class="btn btn-info"> <i class="fa fa-eye" aria-hidden="true"></i></a>
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
                @if ($biddings->hasPages())
                    <div class="card-footer">
                        {{ $biddings->links('admin.partials.paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
