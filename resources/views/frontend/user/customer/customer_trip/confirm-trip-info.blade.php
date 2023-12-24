@extends('frontend.layout.customer')
@section('customer-breadcumb', 'তথ্য নির্বাচন করুন')
@section('customer-content')
    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <table class="table">

                            <tbody>
                                <tr>
                                    <th>লোড লোকেশন:</th>
                                    <td>{{ $trip->start_location }} </td>
                                </tr>

                                <tr>
                                    <th>আনলোড লোকেশন:</th>
                                    <td>{{ $trip->end_location }} </td>
                                </tr>


                                <tr>
                                    <th>পণ্য গ্রহণকারীর মোবাইল নম্বর:</th>
                                    <td>{{ $trip->receiver_mobile }} </td>
                                </tr>

                                <tr>
                                    <th>লোডের তারিখ / সময়:</th>
                                    <td>{{ $trip->starting_date }} / {{ $trip->starting_time }}</td>
                                </tr>

                                <tr>
                                    <th>ট্রাক এর ধরণ:</th>
                                    <td>{{ $trip->truck->name }} </td>
                                </tr>

                                <tr>
                                    <th>টন:</th>
                                    <td>{{ $trip->ton }} </td>
                                </tr>

                                <tr>
                                    <th>ফিট:</th>
                                    <td>{{ $trip->feet }} </td>
                                </tr>

                                <tr>
                                    <th>পণ্যের বিবরণ:</th>
                                    <td>{{ $trip->product_description }}</td>
                                </tr>

                                @if ($trip->second_load == 1)
                                    @if (!empty($trip->second_load_location))
                                        <tr>
                                            <th>দ্বিতীয় লোড লোকেশন:</th>
                                            <td>{{ $trip->second_load_location }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($trip->second_provider_mobile))
                                        <tr>
                                            <th>দ্বিতীয় পণ্য প্রদানকারীর মোবাইল নম্বর:</th>
                                            <td>{{ $trip->second_provider_mobile }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($trip->second_unload_location))
                                        <tr>
                                            <th>দ্বিতীয় আনলোড লোকেশন</th>
                                            <td>{{ $trip->second_unload_location }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($trip->second_receiver_mobile))
                                        <tr>
                                            <th>দ্বিতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর:</th>
                                            <td>{{ $trip->second_receiver_mobile }}</td>
                                        </tr>
                                    @endif


                                    @if (!empty($trip->third_load_location))
                                        <tr>
                                            <th>তৃতীয় লোড লোকেশন:</th>
                                            <td>{{ $trip->third_load_location }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($trip->third_provider_mobile))
                                        <tr>
                                            <th>তৃতীয় পণ্য প্রদানকারীর মোবাইল নম্বর:</th>
                                            <td>{{ $trip->third_provider_mobile }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($trip->third_unload_location))
                                        <tr>
                                            <th>তৃতীয় আনলোড লোকেশন</th>
                                            <td>{{ $trip->third_unload_location }}</td>
                                        </tr>
                                    @endif

                                    @if (!empty($trip->third_receiver_mobile))
                                        <tr>
                                            <th>তৃতীয় পণ্য গ্রহণকারীর মোবাইল নম্বর:</th>
                                            <td>{{ $trip->third_receiver_mobile }}</td>
                                        </tr>
                                    @endif
                                @endif


                            </tbody>
                        </table>
                    </div>


                    <div class="card-footer">

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('user.trip-info.create-step-one') }}?vehicle_id=1"
                                    class="btn btn-primary btn-block btn-lg">Edit</a>
                            </div>
                            <div class="col-md-6">


                                <form action="{{ route('user.trip-info.create-step-two.post') }}" method="POST">
                                    @csrf

                                    <button class="btn btn-success btn-block btn-lg" type="submit">Confirm</button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
