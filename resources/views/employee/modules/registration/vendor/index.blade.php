@extends('employee.layout.master')

@section('page_title', 'প্রভাইডার লিস্ট')

@section('employee_content')
    <div class="container-fluid">
        <div class="row ">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3><i class="fa-regular fa-calendar-days"></i> প্রভাইডার লিস্ট</h3>
                            <a class="btn btn-success m-2 " href="{{ route('vendor.create') }}">@changeLang('Register New Vendor')</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">@changeLang('Sl')</th>
                                        <th scope="col">@changeLang('Full Name')</th>
                                        <th scope="col">@changeLang('Phone')</th>
                                        <th scope="col">@changeLang('Email')</th>
                                        <th scope="col">@changeLang('Location')</th>
                                        <th scope="col">@changeLang('Status')</th>
                                        <th scope="col">@changeLang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1 @endphp
                                    @foreach ($vendors as $vendor)
                                        <tr>

                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $vendor->fname }}</td>
                                            <td>{{ $vendor->mobile }}</td>
                                            <td>{{ $vendor->email }}</td>
                                            <td>{{ @$vendor->division->bn_name }}, {{ @$vendor->district->bn_name }},
                                                {{ @$vendor->upazila->bn_name }}, {{ @$vendor->union->bn_name }}</td>
                                            <td>{!! $vendor->status == 1
                                                ? "<strong class='text-success' >Active</strong>"
                                                : "<strong class='text-danger' >Inactive</strong>" !!}</td>
                                            <td>
                                                <a href="{{ route('vendor.show', $vendor) }}"
                                                    class="btn btn-info btn-sm ml-1 mt-1"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <form id="{{ 'form_' . $vendor->id }}"
                                                    action="{{ route('vendor.destroy', $vendor->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-id="{{ $vendor->id }}"
                                                        class="delete btn btn-danger btn-sm ml-1 mt-1" type="button"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            @if ($vendors->hasPages())
                                {{ $vendors->links('admin.partials.paginate') }}
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
