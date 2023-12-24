@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Create Sub-Admin')</h1>
        </div>
    </section>



@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                        <form action="{{ route('admin.sub-admin.store') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <tr>
                                    <td class="w-50">@changeLang('User Name')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ old('username') }}" class="form-control"
                                            name="username" placeholder="@changeLang('User Name')" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-50">@changeLang('Email')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="email" value="{{ old('email') }}" class="form-control"
                                            name="email" placeholder="@changeLang('Email')" required>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50">@changeLang('Password')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="password" class="form-control" name="password" placeholder="@changeLang('Password')"
                                            required>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <input type="hidden" name="role" value="2" >
                            </table>
                            <button type="submit" class="btn btn-primary">@changeLang('Create Sub-Admin')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('js')

    @endpush --}}

@endsection

