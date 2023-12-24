
@extends('agent.layout.master')

@section('page_title','Customer Registration')

@section('agent_content')
<div class="container-fluid col-md-8 mt-2">
    <div class="row justify-content-center">
        <div class="card m-4" >
            <div class="card-header">
              <h3>Edit Customer Info</h3>
            </div>
                <div class="card-body">
                    @if($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <form action="{{ route('employee-customer.update',$customer->id) }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row ">

                        <div class="form-group col-md-6" id="fname">

                            <label for="">@changeLang('First Name') <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="fname" class="form-control" value="{{$customer->fname}}">

                        </div>


                        {{-- <div class="form-group col-md-6">

                            <label for="">@changeLang('Email Address')<span class="text-danger"></span></label>
                            <input type="email" name="email" class="form-control" value="{{$customer->email}}">

                        </div>

                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Phone')<span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" value="{{$customer->mobile}}">

                        </div> --}}
                        {{-- <input type="hidden" name="created_by" value="{{Auth::user()->id}}" >
                        <input type="hidden" name="user_type" value="2" > --}}

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-outline-info form-control">@changeLang('Register Now')</button>
                        </div>

                    </div>


                </form>
                </div>
            
        </div>
    </div>
        
</div>  
@endsection

