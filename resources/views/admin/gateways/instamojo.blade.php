@extends('admin.layout.master')

@section('breadcrumb')
 <section class="section">
          <div class="section-header">

            <h1>@changeLang('Instamojo Payment Gateway')</h1>

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
                                <label class="col-form-label">@changeLang('Instamojo Image')</label>

                                <div id="image-preview" class="image-preview"
                                    style="background-image:url({{ getFile('gateways' , @$instamojo->image) }});">
                                    <label for="image-upload" id="image-label">@changeLang('Choose File')</label>
                                    <input type="file" name="instamojo_image" id="image-upload" />
                                </div>

                            </div>

                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">@changeLang('Acount Mode')</label>
                                            <select name="account_mode" id="" class="form-control">
                                                <option {{ $instamojo->account_mode== 'Sandbox' ? 'selected':'' }} value="Sandbox">@changeLang('Sandbox')</option>
                                                <option {{ $instamojo->account_mode== 'Live' ? 'selected':'' }} value="Live">@changeLang('Live')</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">@changeLang('Api Key')</label>
                                            <input type="text" class="form-control" name="api_key" value="{{ $instamojo->api_key }}">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">@changeLang('Auth token')</label>
                                            <input type="text" class="form-control" name="auth_token" value="{{ $instamojo->auth_token }}">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">@changeLang('Currency Rate') (@changeLang('Per') {{ $setting->site_currency }})</label>
                                            <input type="text" class="form-control" value="{{ $instamojo->currency_rate }}" name="currency_rate">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">@changeLang('Status')</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $instamojo->status==1 ? 'selected':'' }} value="1">@changeLang('Active')</option>
                                                <option {{ $instamojo->status==0 ? 'selected':'' }} value="0">@changeLang('Inactive')</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">@changeLang('Update Instamojo Information')</button>

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
