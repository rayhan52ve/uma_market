<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        /* Sticky header for printing */
        @media print {
            table {
                page-break-before: always;
            }

            thead {
                display: table-header-group;
                position: sticky;
                top: 0;
            }
        }
    </style>

    <title>Total Due Payment Report</title>
</head>

<body>

    <div class="card">
        <div class="card-header">
            <h4></h4>

            <div class="card-header-form">
                <div class="">
                    <input class="btn btn-outline-success" type="button" onclick="printDiv('print-content')"
                        value="Print" />
                </div>

                <div class="d-flex justify-content-end" id="totalDuePayment">
                    <form method="GET" action="{{ route('admin.dueReport.search') }}">
                        <div class="input-group">
                            <select name="searchLocation" class="form-control form-select">
                                <option selected>Select Trip Location</option>
                                @foreach ($upazilas as $upazila)
                                    <option class="text-dark"
                                        @if ($search && $search == $upazila->bn_name) selected @endif
                                        value="{{ $upazila->bn_name }}">{{ $upazila->bn_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="input-group-btn">
                                <button class="btn btn-primary">Search</i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="card">
                <div id="print-content">
                    <form>

                        <div class="card-body text-center">

                            <div class="tab-content">

                                <div class="tab-pane fade active show" id="running" role="tabpanel"
                                    aria-labelledby="total_due">

                                    <div class="mt-5 p-2">

                                        <h1 class="d-flex justify-content-center">উমা মার্কেট</h1>
                                        <h5 class="d-flex justify-content-center"><b> {{$navbar['Address']}}: </b> {{__(@$contact->data->address)}}
                                        </h5>
                                        <h5 class="d-flex justify-content-center"><b> {{$navbar['Call']}}:</b> {{__(@$contact->data->phone)}}</h5>
                                        <h5 class="d-flex justify-content-center"><b>{{$navbar['Email']}}:</b>{{__(@$contact->data->email)}} </h5>
                                        <p class="d-flex justify-content-center"><b>Date:</b>
                                            {{ carbon\Carbon::today()->toDateString() }}</p>

                                    </div>

                                    <div class="table-responsive m-5 col-md-11">
                                        <table class="table table-striped">

                                            <thead>
                                                <tr class="text-left">
                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Customer')</th>
                                                    <th>@changeLang('Service Name')</th>
                                                    <th>@changeLang('Amount')</th>
                                                    <th>@changeLang('Start Location')</th>
                                                    <th>@changeLang('End Location')</th>
                                                    <th>@changeLang('Status')</th>
                                                    <th>@changeLang('Trip Type')</th>
                                                    <th>গ্রাহকের মোবাইল</th>
                                                    <th>@changeLang('Trip Date/Time')</th>

                                                </tr>
                                            </thead>
                                            @forelse ($all_trips['running'] as $all_trip)
                                                <tr class="text-left">
                                                    <td>{{ __($loop->iteration) }}</td>
                                                    <td> {{ __($all_trip->customer->fullname) }}</td>
                                                    <td> {{ __($all_trip->vehicle->name) }}</td>
                                                    <td> {{ __(@$all_trip->bidding->bid_amount) }}</td>
                                                    <td>{{ $all_trip->start_location }}</td>
                                                    <td>{{ $all_trip->end_location }}</td>
                                                    <td>{{ $all_trip->status }}</td>
                                                    <td>{{ $all_trip->trip_type }}</td>
                                                    <td>{{ $all_trip->receiver_mobile }}</td>
                                                    <td>{{ date('d-M-y', strtotime($all_trip->starting_date)) }} |
                                                        {{ date('h:i A', strtotime($all_trip->starting_time)) }}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="100%">@changeLang('No Data Found')</td>
                                                </tr>
                                            @endforelse
                                        </table>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="daily_due">


                                    <div class="mt-5 p-2">

                                        <h1 class="d-flex justify-content-center">উমা মার্কেট</h1>
                                        <h5 class="d-flex justify-content-center"><b> {{$navbar['Address']}}: </b> {{__(@$contact->data->address)}}
                                        </h5>
                                        <h5 class="d-flex justify-content-center"><b> {{$navbar['Call']}}:</b> {{__(@$contact->data->phone)}}</h5>
                                        <h5 class="d-flex justify-content-center"><b>{{$navbar['Email']}}:</b>{{__(@$contact->data->email)}} </h5>
                                        <p class="d-flex justify-content-center"><b>Date:</b>
                                            {{ carbon\Carbon::today()->toDateString() }}</p>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            w = window.open();
            w.document.write(
                '<html><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">'
            );
            w.document.write('<body >');
            w.document.write(printContents);
            w.document.write('</body></html>');
            w.print();
            w.window.close();
        }
    </script>
</body>

</html>
