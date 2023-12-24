@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Update Sub-Admin')</h1>
        </div>
    </section>



@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                        <form action="{{ route('admin.sub-admin.update',$subadmin) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <table class="table table-bordered">
                             
                                <tr>
                                    <td class="w-50">@changeLang('User Name')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ $subadmin->username }}" class="form-control"
                                            name="username" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="w-50">@changeLang('Email')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="email" value="{{ $subadmin->email }}" class="form-control"
                                            name="email" required>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                           
                            </table>
                            <button type="submit" class="btn btn-primary">@changeLang('Update Sub-Admin')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('js')

    @endpush --}}

@endsection

