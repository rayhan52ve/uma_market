@extends('admin.layout.master')
@section('breadcrumb')
    <section class="section">
        <div class="section-header">
            <h1>@changeLang('Edit Target Data')</h1>
        </div>
    </section>
@endsection
@section('content')

<div>
    <form action="{{ route('admin.target.update',$worksheet->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="daily_target">@changeLang('Daily Target')</label>
            <input type="text" class="form-control" id="daily_target" name="daily_target" value="{{ $worksheet->daily_target }}">
        </div>

        <!-- Add other fields if needed -->

        <button type="submit" class="btn btn-primary">@changeLang('Update')</button>
    </form>
</div>

@endsection
