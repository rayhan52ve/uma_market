@extends('agent.layout.master')

@section('page_title','Edit Vendor Registration')

@section('agent_content')
<div class="container-fluid col-md-8 mt-2">
    <div class="row justify-content-center">
        <div class="card m-4" >
            <div class="card-header">
              <h3>Edit Vendor Info</h3>
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
                    <form action="{{ route('vendor.update',$vendor->id) }}" method="POST" class="needs-validation"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row ">

                        <div class="form-group col-md-6" id="fname">

                            <label for="">@changeLang('First Name') <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="fname" class="form-control" value="{{$vendor->fname}}">

                        </div>


                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Email Address')<span class="text-danger"></span></label>
                            <input type="email" name="email" class="form-control" value="{{$vendor->email}}">

                        </div>

                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Phone')<span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" value="{{$vendor->mobile}}">

                        </div>

                        <div class="form-group col-md-6" id="nidno">

                            <label for="">জাতীয় পরিচয়পত্র নং<span class="text-danger">*</span></label>
                            <input type="text" name="nid_no" class="form-control" value="{{$vendor->userDetails->nid_no}}">

                        </div>
                        <div class="form-group col-md-6">

                            <label for="">@changeLang('Password')<span class="text-danger">*</span></label>
                            <div>
                                <span class="show-hide-password">
                                    <i class="fa fa-eye" style="position: absolute; right: 23; top: 45;"></i>
                                </span>
                                <input type="password" name="password" class="form-control password" value="{{$vendor->password}}">
                            </div>

                        </div>

                        <div class="form-group col-md-6" id="nidimagefront">

                            <label for="">জাতীয় পরিচয়পত্রের ছবি (সামনের অংশ)<span
                                    class="text-danger">*</span></label>
                            {{-- <div class="custom-file">
                                <input type="file" name="nid_front" class="custom-file-input"
                                    id="customFile1" value="">
                                <label class="custom-file-label" for="customFile1">Choose file</label>
                            </div> --}}
                            <div id="image-preview2" class="image-preview w-100">
                                <label for="image-upload2" id="image-label2">@changeLang('Choose File')</label>
                                <input type="file" name="nid_front" id="image-upload2" value="{{$vendor->userDetails->nid_front}}" />
                            </div>

                        </div>
                        <div class="form-group col-md-6" id="nidimageback">

                            <label for="">জাতীয় পরিচয়পত্রের ছবি (পিছনের অংশ)<span
                                    class="text-danger">*</span></label>
                            {{-- <div class="custom-file">
                                <input type="file" name="nid_back" class="custom-file-input"
                                    id="customFile2" value="">
                                <label class="custom-file-label" for="customFile2">Choose file</label>
                            </div> --}}
                            <div id="image-preview3" class="image-preview w-100">
                                <label for="image-upload3" id="image-label3">@changeLang('Choose File')</label>
                                <input type="file" name="nid_back" id="image-upload3" value="{{$vendor->userDetails->nid_back}}" />
                                <img src="{{$vendor->userDetails->nid_back}}" alt="">
                            </div>
                        </div>

                        {{-- <div class="form-group col-md-6">

                            <label for="">@changeLang('Confirm Password')<span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control">

                        </div> --}}
                        <input type="hidden" name="created_by" value="{{Auth::user()->id}}" >
                        <input type="hidden" name="user_type" value="2" >

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

