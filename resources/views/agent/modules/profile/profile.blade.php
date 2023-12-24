@extends('agent.layout.master')

@section('page_title','প্রোফাইল')

@section('agent_content')

<div class="container">
    <div class="row justify-content-center ">
        <div class="col-sm-3 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>@changeLang('Agent Info')</h3>
                </div>
                <div class="card-body">
                  @if(session()->has('msg'))
                        <div class="alert alert-{{session('cls')}}">
                          {{session('msg')}}
                        </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <tbody>
                        <tr class="pb-6">
                          <td>
                          @if(auth()->user()->image)
                          <img src="{{asset(auth()->user()->image)}}" width="100px" height="100px">
                          @else
                          <img src="{{ asset('backend/img/profile/profile-6.webp') }}" width="100px" height="100px">
                          </td>
                          @endif
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Name')</th>
                          <td><b>{{auth()->user()->fname}} {{auth()->user()->lname}}<b></td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('User Name')</th>
                          <td><b>{{auth()->user()->fname}} {{auth()->user()->username}}<b></td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Email')</th>
                          <td>{{auth()->user()->email}}<td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Mobile')</th>
                          <td>{{auth()->user()->mobile}}</td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Designition')</th>
                          <td>{{auth()->user()->designation}}</td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Details')</th>
                          <td>{{auth()->user()->details}}</td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Experience')</th>
                          <td>{{auth()->user()->experience}}</td>
                        </tr>
                        <tr>
                          <th scope="col">@changeLang('Qualifications')</th>
                          <td>{{auth()->user()->qualification}}</td>
                        </tr>
                    </table>
                  </div> 
                  <a class="btn btn-primary " href="{{route('agent.editProfile',auth()->user()->id)}}">@changeLang('Edit')</a>            
                  <a class="btn btn-danger" href="{{route('agent.password')}}">@changeLang('Change Password')</a>            
                </div>
            </div>
       </div>
       </div>
    </div>
      
     
@endsection