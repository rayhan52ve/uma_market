@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Preview Image ')</h1>
        </div>
    </section>
@endsection
@section('content')

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
