@extends('admin.layout.master')

@section('breadcrumb')
 <section class="section">
          <div class="section-header">

            <h1>@changeLang('Mollie Payment Gateway')</h1>

          </div>
</section>
@endsection
@section('content')

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-3 mb-3">
                                <label class="col-form-label">@changeLang('Mollie Image')</label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ getFile('gateways' , @$mollie->image) }});">
                                    <label for="image-upload" id="image-label">@changeLang('Choose File')</label>
                                    <input type="file" name="mollie_image" id="image-upload" />
                                </div>

                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">@changeLang('Mollie Key')</label>
                                            <input type="text" class="form-control" name="mollie_key" value="{{ $mollie->mollie_key }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">@changeLang('Country')</label>
                                            <select name="country_code" id="" class="form-control select2">
                                                <option value="">@changeLang('Select Country')
                                                </option>
                                                @foreach ($countires as $country)
                                                <option {{ $mollie->country_code == $country->code ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">@changeLang('Currency')</label>
                                            <select name="currency_code" id="" class="form-control select2">
                                                <option value="">@changeLang('Select Currency')
                                                </option>
                                                @foreach ($currencies as $currency)
                                                <option {{ $mollie->currency_code == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">@changeLang('Currency Rate') (@changeLang('Per') {{ $setting->site_currency }})</label>
                                            <input type="text" class="form-control" value="{{ $mollie->currency_rate }}" name="currency_rate">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">@changeLang('Status')</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $mollie->status==1 ? 'selected':'' }} value="1">@changeLang('Active')</option>
                                                <option {{ $mollie->status==0 ? 'selected':'' }} value="0">@changeLang('Inactive')</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">@changeLang('Update Mollie Information')</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection


@push('custom-script')

    <script>
     $(function(){
         'use strict'
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "{{changeDynamic('Choose File')}}", // Default: Choose File
            label_selected: "{{changeDynamic('Update Image')}}", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
     })
    </script>

@endpush
