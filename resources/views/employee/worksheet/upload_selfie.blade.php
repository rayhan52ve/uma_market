@extends('employee.layout.master')

@section('page_title', 'Upload Image')

@section('employee_content')
    {{-- <h1>{{ $pageTitle }}</h1> --}}

    <div class="container ">
        <div class="row">
            {{-- <div class="col-md-12"> --}}
                <div class="col-md-6">
                    <form action="{{ route('upload.selfie', $employeeid->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            {{-- <label for="selfie" class="form-label">Upload Selfie</label> --}}
                            <input type="file" class="form-control" id="selfie" name="selfie" accept="image/*"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <div class="col-md-6">
                    @if ($employeeid->attendence_selfie)
                        <div >

                            <img src="{{ asset($employeeid->attendence_selfie) }}" alt="Uploaded Selfie" class="img-fluid"
                                width="300px">
                        </div>
                    @endif
                </div>
            {{-- </div> --}}
        </div>
    </div>
    </div>

@endsection

@push('custom-script')
    <script>
        $(function() {

            $('.delete').on('click', function() {
                const modal = $('#deleteModal');

                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            })
        })
    </script>
@endpush
