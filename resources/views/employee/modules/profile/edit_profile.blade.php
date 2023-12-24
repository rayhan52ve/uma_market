@extends('employee.layout.master')

@section('page_title', 'এডিট প্রোফাইল')

@section('employee_content')

    @push('css')
        <style>
            .image {
                display: block;
                width: 60vw;
                max-width: 100px;
                /* background-color: cornflowerblue; */
                border-radius: 2px;
                font-size: 1em;
                line-height: 2.5em;
                text-align: center;
            }

            .image:hover {
                background-color: rgb(219, 243, 219);
            }

            .image:active {
                background-color: mediumaquamarine;
            }

            #imageInput {
                border: 0;
                clip: rect(1px, 1px, 1px, 1px);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
        </style>
    @endpush

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>এডিট এমপ্লয়ী ইনফো</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employee.updateProfile', Auth::user()->id) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fname">@changeLang('First Name')</label>
                                    <input value="{{ Auth::user()->fname }}" type="text" class="form-control"
                                        Name="fname">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lname">@changeLang('Last Name')</label>
                                    <input value="{{ Auth::user()->lname }}" type="text" class="form-control"
                                        Name="lname">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">@changeLang('User Name')</label>
                                    <input value="{{ Auth::user()->username }}" type="text" class="form-control"
                                        Name="username">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">@changeLang('Email')</label>
                                    <input value="{{ Auth::user()->email }}" type="email" class="form-control"
                                        Name="email">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="mobile">@changeLang('Mobile')</label>
                                    <input value="{{ Auth::user()->mobile }}" type="text" class="form-control"
                                        Name="mobile">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="designation">@changeLang('Designition')</label>
                                    <input value="{{ Auth::user()->designation }}" type="text" class="form-control"
                                        Name="designation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="details">@changeLang('Details')</label>
                                    <input value="{{ Auth::user()->details }}" type="text" class="form-control"
                                        Name="details">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="experience">@changeLang('Experience')</label>
                                    <input value="{{ Auth::user()->experience }}" type="text" class="form-control"
                                        Name="experience">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="qualification">@changeLang('Qualifications')</label>
                                    <input value="{{ Auth::user()->qualification }}" type="text" class="form-control"
                                        Name="qualification">
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label class="image" for="imageInput">@changeLang('Upload Photo')
                                        <input type="file" id="imageInput" name="image" class="form-control">
                                        <img id="profileImage" src="{{ asset(Auth::user()->image) }}" height="100"
                                            width="100">
                                    </label>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary mt-2">@changeLang('Update')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Get references to the input and img elements
            var imageInput = document.getElementById("imageInput");
            var profileImage = document.getElementById("profileImage");

            // Add an event listener to the input element
            imageInput.addEventListener("change", function() {
                // Check if a file has been selected
                if (imageInput.files && imageInput.files[0]) {
                    var reader = new FileReader();

                    // When the file is loaded, set the src attribute of the img element
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };

                    // Read the selected file as a data URL
                    reader.readAsDataURL(imageInput.files[0]);
                }
            });
        </script>
    @endpush

@endsection
