@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Banner Settings')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.save.banner') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>@changeLang('Banner, Desktop View and Mobile View Banner setting')</legend>
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-form-label">@changeLang('Desktop Banner View')</label>
                                            <input type="file" name="desktop_banner" class="form-control-file">
                                            <div class="row">
                                                {{-- <div class="col-md-12"> --}}
                                                <div class="col-md-12 ">
                                                    @if ($general->desktop_banner)
                                                        <div>
                                                            <img src="{{ asset($general->desktop_banner) }}"
                                                                alt="Desktop View Banner" class="img-fluid" width="300px">
                                                        </div>
                                                    @endif
                                                </div>
                                                {{-- </div> --}}
                                            </div>


                                        </div>
                                        {{-- desktop2 --}}
                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-form-label">@changeLang('Desktop Banner View2')</label>
                                            <input type="file" name="desktop_banner2" class="form-control-file">
                                            <div class="row">
                                                {{-- <div class="col-md-12"> --}}
                                                <div class="col-md-12 ">
                                                    @if ($general->desktop_banner2)
                                                        <div>
                                                            <img src="{{ asset($general->desktop_banner2) }}"
                                                                alt="Desktop View Banner2" class="img-fluid" width="300px">
                                                        </div>
                                                    @endif
                                                </div>
                                                {{-- </div> --}}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-form-label">@changeLang('Mobile Banner View')</label>
                                            <input type="file" name="mobile_banner" class="form-control-file">
                                            <div class="row">
                                                {{-- <div class="col-md-12"> --}}
                                                <div class="col-md-12 ">
                                                    @if ($general->mobile_banner)
                                                        <div>
                                                            <img src="{{ asset($general->mobile_banner) }}"
                                                                alt="Mobile View Banner" class="img-fluid" width="300px">
                                                        </div>
                                                    @endif
                                                </div>
                                                {{-- </div> --}}
                                            </div>


                                        </div>
                                        {{-- mobileview2 --}}
                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-form-label">@changeLang('Mobile Banner View2')</label>
                                            <input type="file" name="mobile_banner2" class="form-control-file">
                                            <div class="row">
                                                {{-- <div class="col-md-12"> --}}
                                                <div class="col-md-12 ">
                                                    @if ($general->mobile_banner2)
                                                        <div>
                                                            <img src="{{ asset($general->mobile_banner2) }}"
                                                                alt="Mobile View Banner2" class="img-fluid" width="300px">
                                                        </div>
                                                    @endif
                                                </div>
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                    </div>





                                </fieldset>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">@changeLang('Update Banner')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
    <script></script>
@endpush
