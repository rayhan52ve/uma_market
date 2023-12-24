


 @extends('agent.layout.master')

@section('page_title','Agent Search')

@section('agent_content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4></h4>
                <div class="card-header-form">
                    <form method="GET" action="{{ route('agent.search') }}">
                        <div class="input-group">
                            <input type="text" placeholder="Enter Referral Code " class="form-control" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection

