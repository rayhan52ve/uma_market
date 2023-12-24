@extends('admin.layout.master')

@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>এডিট কুপন</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.coupon.update',$coupon->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="coupon_code">@changeLang('Coupon Code')<span class="text-danger">*</span></label>
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ $coupon->coupon_code }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="coupon_type">@changeLang('Redeem Type')<span class="text-danger">*</span></label>
                            <select name="coupon_type" id="coupon_type" class="form-control">
                                <option value="flat_amount" {{ $coupon->coupon_type === 'flat_amount' ? 'selected' : '' }}>Flat Amount</option>
                                <option value="percentage" {{ $coupon->coupon_type === 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="full_amount" {{ $coupon->coupon_type === 'full_amount' ? 'selected' : '' }}>Full Amount</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="redeem_amount">@changeLang('Redeem Amount')</label>
                            <input type="text" name="redeem_amount" id="redeem_amount" class="form-control" value="{{ $coupon->redeem_amount }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="number_of_uses">@changeLang('Number of Uses')<span class="text-danger">*</span></label>
                            <input type="text" name="number_of_uses" id="number_of_uses" class="form-control" value="{{ $coupon->number_of_uses }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="number_of_uses_per_users">@changeLang('Total Uses Per Users')<span class="text-danger">*</span></label>
                            <input type="text" name="number_of_uses_per_users" id="number_of_uses_per_users" class="form-control" value="{{ $coupon->number_of_uses_per_users }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expired_at">মেয়াদ শেষ<span class="text-danger">*</span></label>
                            <input type="date" name="expired_at" id="expired_at" class="form-control" value="{{ $coupon->expired_at }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <button type="submit" class="btn btn-primary">@changeLang('Update')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
