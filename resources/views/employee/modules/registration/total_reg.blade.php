@extends('employee.layout.master')

@section('page_title', 'টোটাল রেজিস্ট্রেশন লিস্ট')

@section('employee_content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3><i class="fa-regular fa-calendar-days"></i> টোটাল রেজিস্ট্রেশন লিস্ট</h3>
                            {{-- <a class="btn btn-sm btn-success m-2 " href="{{route('total_reg.create')}}">@changeLang('Register New total_reg')</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
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
                                    @foreach ($total_regs as $total_reg)
                                        <tr>

                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $total_reg->fname }}</td>
                                            <td>
                                                @if ($total_reg->user_type == 2)
                                                    @changeLang('Vendor')
                                                @else
                                                    @changeLang('Customer')
                                                @endif
                                            </td>
                                            <td>{{ $total_reg->mobile }}</td>
                                            <td>{{ $total_reg->email }}</td>
                                            <td>{{ @$total_reg->division->bn_name }}, {{ @$total_reg->district->bn_name }},
                                                {{ @$total_reg->upazila->bn_name }}, {{ @$total_reg->union->bn_name }}</td>
                                            <td>{!! $total_reg->status == 1
                                                ? "<strong class='text-success' >Active</strong>"
                                                : "<strong class='text-danger' >Inactive</strong>" !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($total_regs->hasPages())
                                {{ $total_regs->links('admin.partials.paginate') }}
                            @endif
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
