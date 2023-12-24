@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Add Target')</h1>
        </div>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <div class="table-responsive">
                        @foreach ($employees as $item)


                        <form action="{{ route('admin.set.update', $item->id) }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <tr>
                                    <td class="w-50">@changeLang('Target')<span class="text-danger">*</span></td>
                                    <td class="w-50">
                                        <input type="text" value="{{ old('target') }}" class="form-control"
                                            name="target" placeholder="@changeLang('Target')" required>
                                        @error('target')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-primary">@changeLang('Add Target')</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
