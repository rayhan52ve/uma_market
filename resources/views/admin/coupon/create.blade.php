@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Add Coupon')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.coupon.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="coupon_code" class="col-md-6 col-form-label">@changeLang('Coupon Code')<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" required name="coupon_code" id="coupon_code" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="coupon_type" required class="col-md-6 col-form-label">@changeLang('Redeem Type')<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select name="coupon_type" id="coupon_type" class="form-control">
                                    <option value="flat_amount">@changeLang('Flat Amount')</option>
                                    <option value="percentage">@changeLang('Percentage')</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="redeem_amount" class="col-md-6 col-form-label">@changeLang('Redeem Amount')</label>
                            <div class="col-md-6">
                                <input type="text" name="redeem_amount" id="coupon_code" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="coupon_code" class="col-md-6 col-form-label">@changeLang('Number of uses')<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text"  required name="number_of_uses" id="coupon_code" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="coupon_code" class="col-md-6 col-form-label">@changeLang('Total Uses Per Users')<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="text" required name="number_of_uses_per_users" id="coupon_code" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="expired_at" required class="col-md-6 col-form-label">মেয়াদ শেষ <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="date" name="expired_at" id="expired_at" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Repeat the same structure for the other form groups -->

                <div class="row">
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">@changeLang('Create Coupon')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
