@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Coupons')</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@changeLang('Coupon Code')</th>
                            <th>@changeLang('Redeem Type')</th>
                            <th>@changeLang('Redeem Amount')</th>
                            <th>@changeLang('Number of Uses')</th>
                            <th>@changeLang('Total Uses Per Users')</th>
                            <th>মেয়াদ শেষ</th>
                            <th>@changeLang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->coupon_code }}</td>
                                <td>{{ $coupon->coupon_type }}</td>
                                <td>{{ $coupon->redeem_amount }}</td>
                                <td>{{ $coupon->number_of_uses }}</td>
                                <td>{{ $coupon->number_of_uses_per_users }}</td>
                                <td>{{ $coupon->expired_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- <div class="d-inline-block">
                                        <form action="{{ route('admin.coupon.destroy', $coupon->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div> --}}


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
