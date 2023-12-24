@extends('admin.layout.master')
@section('breadcrumb')
 <section class="section">
          <div class="section-header">
           
                 <h1>{{changeDynamic($pageTitle)}}</h1>

           
          
        
          </div>
</section>
@endsection
@section('content')

<div class="row">

    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-success">
                    <i class="fas fa-th-list"></i>
                 </div>
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>@changeLang('Revenue This Month')</h4>
                     </div>
                     <div class="card-body">
                         {{number_format($revThisMonth,2).' '. $general->site_currency}}
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-4 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-success">
                    <i class="fas fa-th-list"></i>
                 </div>
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>@changeLang('Revenue Last Month')</h4>
                     </div>
                     <div class="card-body">
                         {{number_format($revPrevMonth,2).' '. $general->site_currency}}
                     </div>
                 </div>
             </div>
         </div> 
         <div class="col-lg-4 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-success">
                    <i class="fas fa-th-list"></i>
                 </div>
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>@changeLang('Revenue Last Year')</h4>
                     </div>
                     <div class="card-body">
                         {{number_format($revLastYear,2).' '. $general->site_currency}}
                     </div>
                 </div>
             </div>
         </div>


</div>

 <div class="row">

         <div class="col-md-12">

             <div class="card">

                 <div class="card-header">
                  

                     <div class="card-header-form">
                         <form method="GET" action="">
                             <div class="input-group">
                                 <input type="text" class="form-control" name="from" id="from" autocomplete="off" placeholder="@changeLang('From')">

                                  <input type="text" class="form-control" name="to" id="to" autocomplete="off" placeholder="@changeLang('To')">
                                
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

                                    
                                     <th>@changeLang('Transaction Id')</th>
                                     <th>@changeLang('Amount')</th>
                                     <th>@changeLang('Charge')</th>
                                     <th>@changeLang('Commission')</th>
                                     <th>@changeLang('Details')</th>
                                     <th>@changeLang('Date')</th>

                                 </tr>

                             </thead>

                             <tbody>

                                 @forelse($transactions as $key => $transaction)

                                        <tr>
                                           
                                            <td>{{$transaction->gateway_transaction ?? $transaction->trx}}</td>
                                           

                                            <td>

                                                {{$transaction->amount.' '.$transaction->currency}}
                                            
                                            </td>
                                            <td>

                                                {{number_format($transaction->charge,4).' '.$transaction->currency}}
                                            
                                            </td>
                                            <td>

                                                {{number_format($transaction->commission,4).' '.$transaction->currency}}
                                            
                                            </td>
                                            <td>

                                                {{$transaction->details}}
                                            
                                            </td>


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
                 </div>


                 @if($transactions->hasPages())

                    <div class="card-footer">

                        {{ $transactions->links('admin.partials.paginate') }}

                    </div>

                 @endif


             </div>



         </div>


     </div>


@endsection

@push('custom-script')

<script>
  $( function() {
    var dateFormat = "mm-dd-yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
          dateFormate:"mm-dd-yy"
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormate:"mm-dd-yy"
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>
    
@endpush

@push('custom-style')

<style>

    .card .card-header .btn:not(.note-btn),.card .card-header .form-control{
        border-radius:0px;
        border:1px solid #6777ef91
    }
    
  
</style>
    
@endpush