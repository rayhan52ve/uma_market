@extends('admin.layout.master')
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

                 <div class="card-header">
                    <h4></h4>

                     <div class="card-header-form">
                         <form method="GET" action="">
                             <div class="input-group">
                                 <input type="text" class="form-control" value="{{old('search')}}" name="search">
                                 <div class="input-group-btn">
                                     <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                 </div>
                             </div>
                         </form>
                     </div>


                 </div>


                 <div class="card-body p-0">
   
                    <div class="card">
                        <div class="card-header">
        
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="all_tab" data-toggle="tab" href="#all" role="tab"
                                        aria-controls="all" aria-selected="true">@changeLang('All')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="day_tab" data-toggle="tab" href="#day" role="tab"
                                        aria-controls="day" aria-selected="false">@changeLang('Today')</a>
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
                                <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all_tab">
        
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
               
                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    {{-- <th>@changeLang('User Type')</th> --}}
                                                    <th>@changeLang('Amount')</th>
                                                    <th>@changeLang('Charge')</th>
                                                    {{-- <th>@changeLang('Details')</th> --}}
                                                    <th>@changeLang('Date')</th>
               
                                                </tr>
               
                                            </thead>
               
                                            <tbody>
               
                                                @forelse($transactions['all'] as $key => $transaction)
               
                                                       <tr>
                                                           <td>{{$key + $transactions['all']->firstItem()}}</td>
                                                           <td>{{$transaction->trx ?? $transaction->trx}}</td>
                                                           <td>{{$transaction->gateway_transaction ?? $transaction->gateway_transaction}}</td>
                                                           <td>
               
                                                               {{$transaction->user->fullname}}
               
                                                           </td>
               
                                                           {{-- <td>
               
                                                               @if($transaction->user->user_type == 2)
                                                                   <span class="badge badge-primary">@changeLang('Provider')</span>
                                                               @else
                                                                   <span class="badge badge-primary">@changeLang('user')</span>
                                                               @endif
                                                           
                                                           
                                                           </td> --}}
               
                                                           <td>
               
                                                               {{$transaction->amount.' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           <td>
               
                                                               {{number_format($transaction->charge,4).' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           {{-- <td>
               
                                                               {{$transaction->details}}
                                                           
                                                           </td> --}}
               
               
                                                           <td>
               
                                                               {{$transaction->created_at->format('d F Y')}}
                                                           
                                                           </td>
                                                       
                                                       </tr>
                                                   
                                                @empty
               
               
                                                    <tr>
               
                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>
               
                                                    </tr>
               
               
               
                                                @endforelse
               
               
               
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($transactions['all']->hasPages())

                                        <div class="card-footer">
                    
                                            {{ $transactions['all']->links('admin.partials.paginate') }}
                    
                                        </div>
                
                                    @endif
                                    {{-- @if ($day->hasPages())
                                    {{ $day->links('admin.partials.paginate') }}
                                @endif --}}
                                </div>
                                <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="day_tab">
        
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
               
                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    {{-- <th>@changeLang('User Type')</th> --}}
                                                    <th>@changeLang('Amount')</th>
                                                    <th>@changeLang('Charge')</th>
                                                    {{-- <th>@changeLang('Details')</th> --}}
                                                    <th>@changeLang('Date')</th>
               
                                                </tr>
               
                                            </thead>
               
                                            <tbody>
               
                                                @forelse($transactions['daily'] as $key => $transaction)
               
                                                       <tr>
                                                           <td>{{$key + $transactions['daily']->firstItem()}}</td>
                                                           <td>{{$transaction->trx ?? $transaction->trx}}</td>
                                                           <td>{{$transaction->gateway_transaction ?? $transaction->gateway_transaction}}</td>
                                                           <td>
               
                                                               {{$transaction->user->fullname}}
               
                                                           </td>
               
                                                           {{-- <td>
               
                                                               @if($transaction->user->user_type == 2)
                                                                   <span class="badge badge-primary">@changeLang('Provider')</span>
                                                               @else
                                                                   <span class="badge badge-primary">@changeLang('user')</span>
                                                               @endif
                                                           
                                                           
                                                           </td> --}}
               
                                                           <td>
               
                                                               {{$transaction->amount.' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           <td>
               
                                                               {{number_format($transaction->charge,4).' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           {{-- <td>
               
                                                               {{$transaction->details}}
                                                           
                                                           </td> --}}
               
               
                                                           <td>
               
                                                               {{$transaction->created_at->format('d F Y')}}
                                                           
                                                           </td>
                                                       
                                                       </tr>
                                                   
                                                @empty
               
               
                                                    <tr>
               
                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>
               
                                                    </tr>
               
               
               
                                                @endforelse
               
               
               
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($transactions['daily']->hasPages())

                                        <div class="card-footer">
                    
                                            {{ $transactions['daily']->links('admin.partials.paginate') }}
                    
                                        </div>
                
                                    @endif
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
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    {{-- <th>@changeLang('User Type')</th> --}}
                                                    <th>@changeLang('Amount')</th>
                                                    <th>@changeLang('Charge')</th>
                                                    {{-- <th>@changeLang('Details')</th> --}}
                                                    <th>@changeLang('Date')</th>
               
                                                </tr>
               
                                            </thead>
               
                                            <tbody>
               
                                                @forelse($transactions['weekly'] as $key => $transaction)
               
                                                       <tr>
                                                           <td>{{$key + $transactions['weekly']->firstItem()}}</td>
                                                           <td>{{$transaction->trx ?? $transaction->trx}}</td>
                                                           <td>{{$transaction->gateway_transaction ?? $transaction->gateway_transaction}}</td>
                                                           <td>
               
                                                               {{$transaction->user->fullname}}
               
                                                           </td>
               
                                                           {{-- <td>
               
                                                               @if($transaction->user->user_type == 2)
                                                                   <span class="badge badge-primary">@changeLang('Provider')</span>
                                                               @else
                                                                   <span class="badge badge-primary">@changeLang('user')</span>
                                                               @endif
                                                           
                                                           
                                                           </td> --}}
               
                                                           <td>
               
                                                               {{$transaction->amount.' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           <td>
               
                                                               {{number_format($transaction->charge,4).' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           {{-- <td>
               
                                                               {{$transaction->details}}
                                                           
                                                           </td> --}}
               
               
                                                           <td>
               
                                                               {{$transaction->created_at->format('d F Y')}}
                                                           
                                                           </td>
                                                       
                                                       </tr>
                                                   
                                                @empty
               
               
                                                    <tr>
               
                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>
               
                                                    </tr>
               
               
               
                                                @endforelse
               
               
               
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($transactions['weekly']->hasPages())

                                        <div class="card-footer">
                    
                                            {{ $transactions['weekly']->links('admin.partials.paginate') }}
                    
                                        </div>
                
                                    @endif
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
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    {{-- <th>@changeLang('User Type')</th> --}}
                                                    <th>@changeLang('Amount')</th>
                                                    <th>@changeLang('Charge')</th>
                                                    {{-- <th>@changeLang('Details')</th> --}}
                                                    <th>@changeLang('Date')</th>
               
                                                </tr>
               
                                            </thead>
               
                                            <tbody>
               
                                                @forelse($transactions['monthly'] as $key => $transaction)
               
                                                       <tr>
                                                           <td>{{$key + $transactions['monthly']->firstItem()}}</td>
                                                           <td>{{$transaction->trx ?? $transaction->trx}}</td>
                                                           <td>{{$transaction->gateway_transaction ?? $transaction->gateway_transaction}}</td>
                                                           <td>
               
                                                               {{$transaction->user->fullname}}
               
                                                           </td>
               
                                                           {{-- <td>
               
                                                               @if($transaction->user->user_type == 2)
                                                                   <span class="badge badge-primary">@changeLang('Provider')</span>
                                                               @else
                                                                   <span class="badge badge-primary">@changeLang('user')</span>
                                                               @endif
                                                           
                                                           
                                                           </td> --}}
               
                                                           <td>
               
                                                               {{$transaction->amount.' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           <td>
               
                                                               {{number_format($transaction->charge,4).' '.$transaction->currency}}
                                                           
                                                           </td>
                                                           {{-- <td>
               
                                                               {{$transaction->details}}
                                                           
                                                           </td> --}}
               
               
                                                           <td>
               
                                                               {{$transaction->created_at->format('d F Y')}}
                                                           
                                                           </td>
                                                       
                                                       </tr>
                                                   
                                                @empty
               
               
                                                    <tr>
               
                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>
               
                                                    </tr>
               
               
               
                                                @endforelse
               
               
               
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($transactions['monthly']->hasPages())

                                        <div class="card-footer">
                    
                                            {{ $transactions['monthly']->links('admin.partials.paginate') }}
                    
                                        </div>
                
                                    @endif
                                    {{-- @if ($week->hasPages())
                                    {{ $week->links('admin.partials.paginate') }}
                                @endif --}}
                                </div>
                            </div>
                        </div>
        
                    </div>


                 </div>


             </div>



         </div>


     </div>


@endsection
