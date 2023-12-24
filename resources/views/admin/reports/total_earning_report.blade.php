<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Total Earning Report</title>
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
                <div class="d-flex justify-content-end">
                    <form method="GET" action="{{ route('admin.totalEarningReport.search') }}">
                        <div class="input-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <select id="division" name="division_id" class="form-control form-select"
                                        value="{{ old('division_id') }}" required>
                                        <option selected disabled>@changeLang('Select Division')</option>
                                        @foreach ($divisions as $division)
                                            <option class="text-dark" value="{{ $division->id }}">
                                                {{ $division->bn_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('division_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <select id="district" name="district_id" class="form-control form-select"
                                        value="{{ old('district_id') }}">
                                        <option selected>@changeLang('Select District')</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="upazila" name="upazila_id" class="form-control form-select"
                                        value="{{ old('upazila_id') }}">
                                        <option selected>@changeLang('Select Upazila')</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="union" name="union_id" class="form-control form-select"
                                        value="{{ old('union_id') }}">
                                        <option selected>@changeLang('Select Union')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-primary">Search</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>

        <div class="col-12 col-md-12 col-lg-12 mt-4 ">
            <div class="card">
                <div class="card-header">

                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" id="day_tab" data-toggle="tab" href="#day"
                                role="tab" aria-controls="day" aria-selected="true">@changeLang('Daily')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="week_tab" data-toggle="tab" href="#week" role="tab"
                                aria-controls="week" aria-selected="false">@changeLang('Weekly')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="month_tab" data-toggle="tab" href="#month" role="tab"
                                aria-controls="month" aria-selected="false">@changeLang('Monthly')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="year_tab" data-toggle="tab" href="#year" role="tab"
                                aria-controls="year" aria-selected="false">@changeLang('Yearly')</a>
                        </li>


                    </ul>


                </div>

                <div id="print-content">
                    <form>

                        <div class="card-body text-center">

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="day" role="tabpanel"
                                    aria-labelledby="day_tab">



                                    <div class="mt-5 p-2">

                                        <h1 class="d-flex justify-content-center">উমা মার্কেট</h1>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Address'] }}: </b>
                                            {{ __(@$contact->data->address) }}
                                        </h5>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Call'] }}:</b>
                                            {{ __(@$contact->data->phone) }}</h5>
                                        <h5 class="d-flex justify-content-center">
                                            <b>{{ $navbar['Email'] }}:</b>{{ __(@$contact->data->email) }} </h5>
                                        <p class="d-flex justify-content-center"><b>Date:</b>
                                            {{ carbon\Carbon::today()->toDateString() }}</p>
                                    </div>

                                    <div class="table-responsive m-5 col-md-11">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    <th>@changeLang('Total Earning')</th>
                                                    <th>@changeLang('Date')</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @forelse($transactions['daily'] as $key => $transaction)
                                                    <tr>
                                                        <td>{{ __($loop->iteration) }}</td>
                                                        <td>{{ $transaction->trx ?? $transaction->trx }}</td>
                                                        <td>{{ $transaction->gateway_transaction ?? $transaction->gateway_transaction }}
                                                        </td>
                                                        <td>

                                                            {{ $transaction->user->fullname }}

                                                        </td>

                                                        {{-- <td>

                                                                       @if ($transaction->user->user_type == 2)
                                                                           <span class="badge badge-primary">@changeLang('Provider')</span>
                                                                       @else
                                                                           <span class="badge badge-primary">@changeLang('user')</span>
                                                                       @endif


                                                                   </td> --}}

                                                        <td>

                                                            {{ $transaction->amount . ' ' . $transaction->currency }}

                                                        </td>


                                                        <td>

                                                            {{ $transaction->created_at->format('d F Y') }}

                                                        </td>

                                                    </tr>

                                                @empty


                                                    <tr>

                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>

                                                    </tr>
                                                @endforelse



                                            </tbody>
                                        </table>
                                    </div>
                                    


                                </div>
                                <div class="tab-pane fade" id="week" role="tabpanel"
                                    aria-labelledby="week_tab">



                                    <div class="mt-5 p-2">

                                        <h1 class="d-flex justify-content-center">উমা মার্কেট</h1>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Address'] }}: </b>
                                            {{ __(@$contact->data->address) }}
                                        </h5>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Call'] }}:</b>
                                            {{ __(@$contact->data->phone) }}</h5>
                                        <h5 class="d-flex justify-content-center">
                                            <b>{{ $navbar['Email'] }}:</b>{{ __(@$contact->data->email) }} </h5>
                                        <p class="d-flex justify-content-center"><b>Date:</b>
                                            {{ carbon\Carbon::today()->toDateString() }}</p>
                                    </div>

                                    <div class="table-responsive m-5 col-md-11">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    <th>@changeLang('Total Earning')</th>
                                                    <th>@changeLang('Date')</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @forelse($transactions['weekly'] as $key => $transaction)
                                                    <tr>
                                                        <td>{{ __($loop->iteration) }}</td>
                                                        <td>{{ $transaction->trx ?? $transaction->trx }}</td>
                                                        <td>{{ $transaction->gateway_transaction ?? $transaction->gateway_transaction }}
                                                        </td>
                                                        <td>

                                                            {{ $transaction->user->fullname }}

                                                        </td>

                                                        {{-- <td>

                                                                       @if ($transaction->user->user_type == 2)
                                                                           <span class="badge badge-primary">@changeLang('Provider')</span>
                                                                       @else
                                                                           <span class="badge badge-primary">@changeLang('user')</span>
                                                                       @endif


                                                                   </td> --}}

                                                        <td>

                                                            {{ $transaction->amount . ' ' . $transaction->currency }}

                                                        </td>


                                                        <td>

                                                            {{ $transaction->created_at->format('d F Y') }}

                                                        </td>

                                                    </tr>

                                                @empty


                                                    <tr>

                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>

                                                    </tr>
                                                @endforelse



                                            </tbody>
                                        </table>
                                    </div>
                                    


                                </div>
                                <div class="tab-pane fade" id="month" role="tabpanel"
                                    aria-labelledby="month_tab">


                                    <div class="mt-5 p-2">

                                        <h1 class="d-flex justify-content-center">উমা মার্কেট</h1>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Address'] }}: </b>
                                            {{ __(@$contact->data->address) }}
                                        </h5>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Call'] }}:</b>
                                            {{ __(@$contact->data->phone) }}</h5>
                                        <h5 class="d-flex justify-content-center">
                                            <b>{{ $navbar['Email'] }}:</b>{{ __(@$contact->data->email) }} </h5>
                                        <p class="d-flex justify-content-center"><b>Date:</b>
                                            {{ carbon\Carbon::today()->toDateString() }}</p>
                                    </div>

                                    <div class="table-responsive m-5 col-md-11">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    <th>@changeLang('Total Earning')</th>
                                                    <th>@changeLang('Date')</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @forelse($transactions['monthly'] as $key => $transaction)
                                                    <tr>
                                                        <td>{{ __($loop->iteration) }}</td>
                                                        <td>{{ $transaction->trx ?? $transaction->trx }}</td>
                                                        <td>{{ $transaction->gateway_transaction ?? $transaction->gateway_transaction }}
                                                        </td>
                                                        <td>

                                                            {{ $transaction->user->fullname }}

                                                        </td>

                                                        {{-- <td>

                                                                       @if ($transaction->user->user_type == 2)
                                                                           <span class="badge badge-primary">@changeLang('Provider')</span>
                                                                       @else
                                                                           <span class="badge badge-primary">@changeLang('user')</span>
                                                                       @endif


                                                                   </td> --}}

                                                        <td>

                                                            {{ $transaction->amount . ' ' . $transaction->currency }}

                                                        </td>


                                                        <td>

                                                            {{ $transaction->created_at->format('d F Y') }}

                                                        </td>

                                                    </tr>

                                                @empty


                                                    <tr>

                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>

                                                    </tr>
                                                @endforelse



                                            </tbody>
                                        </table>
                                    </div>
                                    


                                </div>
                                <div class="tab-pane fade" id="year" role="tabpanel"
                                    aria-labelledby="year_tab">


                                    <div class="mt-5 p-2">

                                        <h1 class="d-flex justify-content-center">উমা মার্কেট</h1>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Address'] }}: </b>
                                            {{ __(@$contact->data->address) }}
                                        </h5>
                                        <h5 class="d-flex justify-content-center"><b> {{ $navbar['Call'] }}:</b>
                                            {{ __(@$contact->data->phone) }}</h5>
                                        <h5 class="d-flex justify-content-center">
                                            <b>{{ $navbar['Email'] }}:</b>{{ __(@$contact->data->email) }} </h5>
                                        <p class="d-flex justify-content-center"><b>Date:</b>
                                            {{ carbon\Carbon::today()->toDateString() }}</p>
                                    </div>

                                    <div class="table-responsive m-5 col-md-11">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>

                                                    <th>@changeLang('Sl')</th>
                                                    <th>@changeLang('Transaction Id')</th>
                                                    <th>@changeLang('Transaction Method')</th>
                                                    <th>@changeLang('Name')</th>
                                                    <th>@changeLang('Total Earning')</th>
                                                    <th>@changeLang('Date')</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                @forelse($transactions['yearly'] as $key => $transaction)
                                                    <tr>
                                                        <td>{{ __($loop->iteration) }}</td>
                                                        <td>{{ $transaction->trx ?? $transaction->trx }}</td>
                                                        <td>{{ $transaction->gateway_transaction ?? $transaction->gateway_transaction }}
                                                        </td>
                                                        <td>

                                                            {{ $transaction->user->fullname }}

                                                        </td>

                                                        {{-- <td>

                                                                       @if ($transaction->user->user_type == 2)
                                                                           <span class="badge badge-primary">@changeLang('Provider')</span>
                                                                       @else
                                                                           <span class="badge badge-primary">@changeLang('user')</span>
                                                                       @endif


                                                                   </td> --}}

                                                        <td>

                                                            {{ $transaction->amount . ' ' . $transaction->currency }}

                                                        </td>


                                                        <td>

                                                            {{ $transaction->created_at->format('d F Y') }}

                                                        </td>

                                                    </tr>

                                                @empty


                                                    <tr>

                                                        <td class="text-center" colspan="100%">@changeLang('No Transactions Found')</td>

                                                    </tr>
                                                @endforelse



                                            </tbody>
                                        </table>
                                    </div>
                                    


                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    {{-- Location Script --}}
    <script>
        $(document).ready(function() {
            $('#division').change(function() {
                var divisionId = $(this).val();
                $('#district').empty();
                $('#upazila').empty();
                $('#union').empty();

                if (divisionId !== '') {
                    $.ajax({
                        url: '/getDistricts/' + divisionId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district').append(
                                '<option selected disabled >@changeLang('Select District')</option>');
                            data.forEach(function(district) {
                                $('#district').append('<option value="' + district.id +
                                    '">' + district.bn_name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#district').change(function() {
                var districtId = $(this).val();
                $('#upazila').empty();
                $('#union').empty();

                if (districtId !== '') {
                    $.ajax({
                        url: '/getUpazilas/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#upazila').append(
                                '<option selected disabled >@changeLang('Select Upazila')</option>');
                            data.forEach(function(upazila) {
                                $('#upazila').append('<option value="' + upazila.id +
                                    '">' + upazila.bn_name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#upazila').change(function() {
                var upazilaId = $(this).val();
                $('#union').empty();

                if (upazilaId !== '') {
                    $.ajax({
                        url: '/getUnions/' + upazilaId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#union').append(
                                '<option selected disabled >@changeLang('Select Union')</option>');
                            data.forEach(function(union) {
                                $('#union').append('<option value="' + union.id + '">' +
                                    union.bn_name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
