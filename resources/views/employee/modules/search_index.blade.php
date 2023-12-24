@extends('employee.layout.master')

@section('page_title','Search Employee')


@section('employee_content')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4></h4>
                <div class="card-header-form">
                    <form method="GET" action="{{ route('search.employee') }}">
                        <div class="input-group">
                            <input type="text" placeholder="Enter Referral Code " class="form-control" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>







    {{-- aktar --}}

@endsection
