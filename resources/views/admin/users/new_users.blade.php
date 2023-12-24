@extends('admin.layout.master')

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('New Customers')</h1>
        </div>
    </section>
@endsection

@section('content')
<div class="row">

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
  
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="day_tab" data-toggle="tab" href="#day"
                            role="tab" aria-controls="day" aria-selected="true">Today</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="week_tab" data-toggle="tab" href="#week"
                            role="tab" aria-controls="week" aria-selected="false">This Week</a>
                    </li>
  
                    <li class="nav-item">
                        <a class="nav-link" id="month_tab" data-toggle="tab" href="#month"
                            role="tab" aria-controls="month" aria-selected="false">This Month</a>
                    </li>
  
  
                </ul>
  
  
            </div>
           
            <div class="card-body text-center">
  
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="day" role="tabpanel"
                        aria-labelledby="day_tab">
  
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
   
                                        <th>@changeLang('Sl')</th>
                                        <th>@changeLang('Full Name')</th>
                                        <th>@changeLang('Phone')</th>
                                        <th>@changeLang('Email')</th>
                                        <th>@changeLang('Status')</th>
                                        {{-- <th>@changeLang('Action')</th> --}}
   
                                    </tr>
   
                                </thead>
   
                                <tbody>
                                    @php
                                    $sl = 1;
                                    @endphp
                                    @forelse($newUser['daily'] as $user)
   
                                        <tr>
                                           <td>{{$sl++}}</td>
                                            <td>{{ __($user->fullname) }}</td>
                                            <td>{{ __($user->mobile) }}</td>
                                            <td>{{ __($user->email) }}</td>
                                            <td>
   
                                                @if ($user->status) <span
                                                    class='badge badge-success'>@changeLang('Active')</span> @else <span
                                                        class='badge badge-danger'>@changeLang('Inactive')</span> @endif
   
                                            </td>
   
                                            {{-- <td>
   
                                                <a href="{{ route('admin.user.details', $user) }}"
                                                    class="btn btn-primary"><i class="fa fa-pen"></i></a>
   
   
                                            </td> --}}
   
   
                                        </tr>
                                    @empty
   
   
                                        <tr>
   
                                            <td class="text-center" colspan="100%">@changeLang('No New User Found')</td>
   
                                        </tr>
   
   
   
                                    @endforelse
   
   
   
                                </tbody>
                            </table>
                        </div>
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
                                        <th>@changeLang('Full Name')</th>
                                        <th>@changeLang('Phone')</th>
                                        <th>@changeLang('Email')</th>
                                        <th>@changeLang('Status')</th>
                                        {{-- <th>@changeLang('Action')</th> --}}
   
                                    </tr>
   
                                </thead>
   
                                <tbody>
                                    @php
                                    $sl = 1;
                                    @endphp
                                    @forelse($newUser['weekly'] as $user)
   
                                        <tr>
                                           <td>{{$sl++}}</td>
                                            <td>{{ __($user->fullname) }}</td>
                                            <td>{{ __($user->mobile) }}</td>
                                            <td>{{ __($user->email) }}</td>
                                            <td>
   
                                                @if ($user->status) <span
                                                    class='badge badge-success'>@changeLang('Active')</span> @else <span
                                                        class='badge badge-danger'>@changeLang('Inactive')</span> @endif
   
                                            </td>
   
                                            {{-- <td>
   
                                                <a href="{{ route('admin.user.details', $user) }}"
                                                    class="btn btn-primary"><i class="fa fa-pen"></i></a>
   
   
                                            </td> --}}
   
   
                                        </tr>
                                    @empty
   
   
                                        <tr>
   
                                            <td class="text-center" colspan="100%">@changeLang('No New User Found')</td>
   
                                        </tr>
   
   
   
                                    @endforelse
   
   
   
                                </tbody>
                            </table>
                        </div>
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
                                        <th>@changeLang('Full Name')</th>
                                        <th>@changeLang('Phone')</th>
                                        <th>@changeLang('Email')</th>
                                        <th>@changeLang('Status')</th>
                                        {{-- <th>@changeLang('Action')</th> --}}
   
                                    </tr>
   
                                </thead>
   
                                <tbody>
                                    @php
                                    $sl = 1;
                                    @endphp
                                    @forelse($newUser['monthly'] as $user)
   
                                        <tr>
                                           <td>{{$sl++}}</td>
                                            <td>{{ __($user->fullname) }}</td>
                                            <td>{{ __($user->mobile) }}</td>
                                            <td>{{ __($user->email) }}</td>
                                            <td>
   
                                                @if ($user->status) <span
                                                    class='badge badge-success'>@changeLang('Active')</span> @else <span
                                                        class='badge badge-danger'>@changeLang('Inactive')</span> @endif
   
                                            </td>
   
                                            {{-- <td>
   
                                                <a href="{{ route('admin.user.details', $user) }}"
                                                    class="btn btn-primary"><i class="fa fa-pen"></i></a>
   
   
                                            </td> --}}
   
   
                                        </tr>
                                    @empty
   
   
                                        <tr>
   
                                            <td class="text-center" colspan="100%">@changeLang('No New User Found')</td>
   
                                        </tr>
   
   
   
                                    @endforelse
   
   
   
                                </tbody>
                            </table>
                        </div>
                        {{-- @if ($week->hasPages())
                            {{ $week->links('admin.partials.paginate') }}
                        @endif --}}
                    </div>
                </div>
            </div>
  
        </div>
    </div>
  </div>
@endsection

{{-- @push('custom-script')
    <script>
        $(function() {
            $('.delete').on('click', function() {
                const modal = $('#deleteModal');
                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            });

            // Handle tab switching behavior
            $('#today_works_tab').on('click', function() {
                $('#week').removeClass('show active');
                $('#today_works').addClass('show active');
            });

            $('#week_tab').on('click', function() {
                $('#today_works').removeClass('show active');
                $('#week').addClass('show active');
            });
        });
    </script>
@endpush --}}
<!-- Add this script at the bottom of your Blade template, after jQuery and Bootstrap scripts -->
{{-- @push('custom-script')
    <script>
        $(function() {
            $('.delete').on('click', function() {
                const modal = $('#deleteModal');
                modal.find('form').attr('action', $(this).data('url'));
                modal.modal('show');
            });

            // Handle tab switching behavior
            $('#today_works_tab').on('click', function() {
                $('#week').removeClass('show active');
                $('#today_works').addClass('show active');
            });

            $('#week_tab').on('click', function() {
                $('#today_works').removeClass('show active');
                $('#week').addClass('show active');
            });

            // Prevent default link behavior
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
            });
        });
    </script>
@endpush --}}

