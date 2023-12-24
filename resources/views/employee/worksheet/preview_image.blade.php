@extends('employee.layout.master')

@section('page_title', 'Employee Worksheet')

@section('employee_content')
    <h1>{{ $pageTitle }}</h1>

<div class="container ">
    <div class="row">
        {{-- <div class="col-md-12"> --}}
            <div class="col-md-12 text-center ">
                @if ($employeeid->attendence_selfie)
                    <div>

                        <img src="{{ asset($employeeid->attendence_selfie) }}" alt="Uploaded Selfie" class="img-fluid"
                            width="300px">
                    </div>
                @endif
            </div>
        {{-- </div> --}}
    </div>
</div>

@endsection
