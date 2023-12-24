@extends('agent.layout.master')

@section('page_title', 'কাস্টমার লিস্ট')

@section('agent_content')

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3><i class="fa-regular fa-calendar-days"></i> @changeLang('Customer List')</h3>
                        <a class="btn btn btn-success m-2 "
                            href="{{ route('agent-customer.create') }}">@changeLang('Register New Customer')</a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">@changeLang('Sl')</th>
                                    <th scope="col">@changeLang('Full Name')</th>
                                    <th scope="col">@changeLang('Location')</th>
                                    <th scope="col">@changeLang('Mobile')</th>
                                    <th scope="col">@changeLang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sl = 1 @endphp
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $customer->fname }}</td>
                                        <td>{{ @$customer->division->bn_name }}, {{ @$customer->district->bn_name }},
                                            {{ @$customer->upazila->bn_name }}, {{ @$customer->union->bn_name }}</td>
                                        {{-- <td>
                                            @if (isset($employeeNames[$customer->created_by]))
                                                {{ $employeeNames[$customer->created_by] }}
                                            @else
                                                N/A
                                            @endif
                                        </td> --}}
                                        <td>{{$customer->mobile}}</td>
                                        <td>
                                            {{-- <a href="{{route('vendor.show', $vendor)}}" class="btn btn-info btn-sm ml-1 mt-1"><i class="fa-solid fa-eye"></i></a> --}}
                                            {{-- <a href="{{route('vendor.edit', $vendor->id)}}" class="btn btn-success btn-sm ml-1 mt-1"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                            <form id="{{ 'form_' . $customer->id }}"
                                                action="{{ route('agent-customer.destroy', $customer->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button data-id="{{ $customer->id }}"
                                                    class="delete btn btn-danger btn-sm ml-1 mt-1" type="button"><i
                                                        class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($customers->hasPages())
                        {{ $customers->links('admin.partials.paginate') }}
                    @endif
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
