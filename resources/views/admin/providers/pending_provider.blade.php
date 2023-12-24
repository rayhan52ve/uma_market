 @extends('admin.layout.master')
 @section('breadcrumb')
     <section class="section">
         <div class="section-header">
             @if (request()->routeIs('admin.provider'))
                 <h1>@changeLang('All Providers')</h1>
             @else
                 <h1>@changeLang('Pending Providers')</h1>
             @endif


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
                         <form method="GET" action="{{ route('admin.provider.search') }}">
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
                                     <th>@changeLang('Email')</th>
                                     <th>@changeLang('Status')</th>
                                     <th>@changeLang('Action')</th>

                                 </tr>

                             </thead>

                             <tbody>

                                 @forelse($providers as $key => $provider)
                                     <tr>
                                         <td>{{ $key + $providers->firstItem() }}</td>
                                         <td>{{ __($provider->fullname) }}</td>
                                         <td>{{ __($provider->mobile) }}</td>
                                         <td>{{ __($provider->email) }}</td>

                                         @if (auth()->guard('admin')->user()->role == 1)
                                             <td>
                                                 <a href="{{ route('admin.providerStatus', $provider->id) }}"
                                                     class='badge badge-{{ $provider->status ? 'success' : 'danger' }}'>{{ $provider->status ? 'Active' : 'Inactive' }}</a>
                                             </td>
                                         @elseif (auth()->guard('admin')->user()->role == 2)
                                             <td>
                                                 <span
                                                     class='badge badge-{{ $provider->status ? 'success' : 'danger' }}'>{{ $provider->status ? 'Active' : 'Inactive' }}</span>
                                             </td>
                                         @endif

                                         <td>

                                             <a href="{{ route('admin.provider.details', $provider) }}"
                                                 class="btn btn-primary"><i class="fa fa-pen"></i></a>


                                         </td>


                                     </tr>
                                 @empty


                                     <tr>

                                         <td class="text-center" colspan="100%">@changeLang('No Providers Found')</td>

                                     </tr>
                                 @endforelse



                             </tbody>
                         </table>
                     </div>
                 </div>

                 @if ($providers->hasPages())
                     <div class="card-footer">

                         {{ $providers->links('admin.partials.paginate') }}
                     </div>
                 @endif

             </div>



         </div>


     </div>
 @endsection
