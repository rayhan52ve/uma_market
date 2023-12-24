@extends(auth()->user()->user_type == 2 ? 'frontend.layout.master' : 'frontend.layout.customer')
@if (auth()->user()->user_type == 2)
    @section('breadcrumb')
        <section class="section">

            <div class="section-header d-flex justify-content-between">

                <h1>@changeLang('All Transactions')</h1>

                    <a href="{{ route('user.dashboard') }}" class="btn btn-link">
                        <i class="fa fa-home"></i>
                    </a>
            </div>
        </section>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- </div> --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Transaction Id')</th>
                                        <th>@changeLang('Transaction Method')</th>
                                        <th>@changeLang('Name')</th>
                                        <th>@changeLang('Total Amount')</th>
                                        <th>@changeLang('Charge')</th>
                                        {{-- <th>@changeLang('Details')</th> --}}
                                        <th>@changeLang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $key => $transaction)
                                        <tr>
                                            <td>{{ $key + $transactions->firstItem() }}</td>
                                            <td>{{ $transaction->trx }}</td>
                                            <td>{{  $transaction->gateway_transaction }}</td>
                                            <td>

                                                {{ $transaction->user->fullname }}
                                            </td>
                                            <td>
                                                {{ $transaction->amount . ' ' . $transaction->currency }}

                                            </td>
                                            <td>
                                                {{ $transaction->charge . ' ' . $transaction->currency }}
                                            </td>
                                            {{-- <td>
                                                {{ $transaction->details }}
                                            </td> --}}
                                            <td>
                                                {{ $transaction->created_at->format('d F Y') }}
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
                    </div>

                    {{ $transactions->links() }}
                    {{-- @if ($transactions->hasPages())

                 <div class="card-footer">

                    {{ $transactions->links('frontend.partials.paginate') }}

                 </div>

                 @endif --}}

                </div>
            </div>
        </div>
    @endsection
@else
    @section('customer-breadcumb', 'পেমেন্ট হিস্ট্রি')
    @section('customer-content')
        <div class="team-page pt_30 pb_60">
            <div class="container">
                <div class="row py-5">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- </div> --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">@changeLang('Sl')</th>
                                                <th scope="col">@changeLang('Transaction Id')</th>
                                                <th scope="col">@changeLang('Name')</th>
                                                <th scope="col">@changeLang('Total Amount')</th>
                                                <th scope="col">@changeLang('Charge')</th>
                                                <th scope="col">@changeLang('Details')</th>
                                                <th scope="col">@changeLang('Date')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($transactions as $key => $transaction)
                                                <tr>
                                                    <th scope="col">{{ $key + $transactions->firstItem() }}</th>
                                                    <td>{{ $transaction->gateway_transaction ?? $transaction->trx }}</td>
                                                    <td>

                                                        {{ $transaction->user->fullname }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->amount . ' ' . $transaction->currency }}

                                                    </td>
                                                    <td>
                                                        {{ $transaction->charge . ' ' . $transaction->currency }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->details }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->created_at->format('d F Y') }}
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
                            </div>

                            {{ $transactions->links() }}
                            {{-- @if ($transactions->hasPages())

                             <div class="card-footer">

                                {{ $transactions->links('frontend.partials.paginate') }}

                             </div>

                             @endif --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
