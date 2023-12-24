@extends('employee.layout.master')

@section('page_title','চেঞ্জ পাসওয়ার্ড')

@section('employee_content')
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
    
                    @if (session('message'))
                        <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                    @endif
    
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
    
                    <div class="card shadow">
                        <div class="card-header bg-info">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="mb-0 text-white">@changeLang('Change Password')</h4>
                                </div>
                                
                            </div>
                           
                        </div>
                        <div class="card-body">
                            <form action="{{ route('changePassword') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>@changeLang('Current Password')</label>
                                    <input type="password" name="current_password" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>@changeLang('New Password')</label>
                                    <input type="password" name="password" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>@changeLang('Confirm Password')</label>
                                    <input type="password" name="password_confirmation" class="form-control" />
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-info">@changeLang('Update')</button>
                                    {{-- <a  href="{{route('employee.profile')}}" type="button" class="btn btn-info">Back</a> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


