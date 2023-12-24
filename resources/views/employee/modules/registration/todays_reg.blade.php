@extends('employee.layout.master')

@section('page_title', 'আজকের রেজিস্ট্রেশন লিস্ট')

@section('employee_content')

<div class="row">

    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                    <div class="mb-3">
                        <h3><i class="fa-regular fa-calendar-days"></i> আজকের রেজিস্ট্রেশন লিস্ট</h3>
                    </div>

                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="customer_tab" data-toggle="tab" href="#customer" role="tab"
                            aria-controls="customer" aria-selected="true">@changeLang('Customer')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="vendor_tab" data-toggle="tab" href="#vendor" role="tab"
                            aria-controls="vendor" aria-selected="false">@changeLang('Vendor')</a>
                    </li>


                </ul>


            </div>
            <div class="card-body text-center">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="customer" role="tabpanel" aria-labelledby="customer_tab">

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">@changeLang('Sl')</th>
                                        <th scope="col">@changeLang('Full Name')</th>
                                        <th scope="col">@changeLang('User Type')</th>
                                        <th scope="col">@changeLang('Phone')</th>
                                        <th scope="col">@changeLang('Email')</th>
                                        <th scope="col">@changeLang('Location')</th>
                                        <th scope="col">@changeLang('Status')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1 @endphp
                                    @foreach ($todays_regs['customer'] as $todays_reg)
                                        <tr>

                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $todays_reg->fname }}</td>
                                            <td>
                                                @if ($todays_reg->user_type==2)
                                                    @changeLang('Vendor')
                                                    @else
                                                    @changeLang('Customer')
                                                @endif
                                            </td>
                                            <td>{{ $todays_reg->mobile }}</td>
                                            <td>{{ $todays_reg->email }}</td>
                                            <td>{{ @$todays_reg->division->bn_name }}, {{ @$todays_reg->district->bn_name }},
                                                {{ @$todays_reg->upazila->bn_name }}, {{ @$todays_reg->union->bn_name }}</td>
                                            <td>{!! $todays_reg->status == 1
                                                ? "<strong class='text-success' >Active</strong>"
                                                : "<strong class='text-danger' >Inactive</strong>" !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($todays_regs['customer']->hasPages())
                                {{ $todays_regs['customer']->links('admin.partials.paginate') }}
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="vendor_tab">

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">@changeLang('Sl')</th>
                                        <th scope="col">@changeLang('Full Name')</th>
                                        <th scope="col">@changeLang('User Type')</th>
                                        <th scope="col">@changeLang('Phone')</th>
                                        <th scope="col">@changeLang('Email')</th>
                                        <th scope="col">@changeLang('Location')</th>
                                        <th scope="col">@changeLang('Status')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1 @endphp
                                    @foreach ($todays_regs['vendor'] as $todays_reg)
                                        <tr>

                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $todays_reg->fname }}</td>
                                            <td>
                                                @if ($todays_reg->user_type==2)
                                                    @changeLang('Vendor')
                                                    @else
                                                    @changeLang('Customer')
                                                @endif
                                            </td>
                                            <td>{{ $todays_reg->mobile }}</td>
                                            <td>{{ $todays_reg->email }}</td>
                                            <td>{{ @$todays_reg->division->name }}, {{ @$todays_reg->district->name }},
                                                {{ @$todays_reg->upazila->name }}, {{ @$todays_reg->union->name }}</td>
                                            <td>{!! $todays_reg->status == 1
                                                ? "<strong class='text-success' >Active</strong>"
                                                : "<strong class='text-danger' >Inactive</strong>" !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($todays_regs['vendor']->hasPages())
                                {{ $todays_regs['vendor']->links('admin.partials.paginate') }}
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>



        @if (session()->has('msg'))
            @push('js')
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: '{{ session('cls') }}',
                        toast: 'true',
                        title: '{{ session('msg') }}',
                        showConfirmButton: false,
                        timer: 8000
                    })
                </script>
            @endpush
        @endif


        @push('js')
            <script>
                $('.delete').on('click', function() {
                    let id = $(this).attr('data-id')
                    // console.log(id)

                    Swal.fire({
                        title: 'Are you sure you want to delete?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(`#form_${id}`).submit()

                        }
                    })
                })
            </script>
        @endpush

    @endsection
