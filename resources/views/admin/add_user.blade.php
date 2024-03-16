@extends('admin.masterpage')
@section('title', 'Add Users')
@section('css')

    <style>
        #datepicker {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <style>
        #upload {
            opacity: 0;
        }

        .image-area {
            border: 2px dashed rgba(255, 255, 255, 0.7);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
            position: relative;
        }

        /* .remove_btn{
                                    /* display: none; */
        position: fixed;
        left: 95%;
        bottom: 65%;
        z-index: 1000;

        }

        */
    </style>

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->

@stop

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Users Complete Details</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Users</li>
                    </ol>
                </nav>
            </div>
            <form action="{{ route('add_users_post') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Users</h4>
                                <p class="card-description"> User name must be in <code>string</code>, no
                                    <code>numbers</code>
                                    and <code>special characters</code> are allowed.
                                </p>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>First Name*</label>
                                            <input type="text" class="form-control form-control-lg" name="fname"
                                                value="{{ old('lname') }}" placeholder="Ex: John">
                                            @error('fname')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Last Name*</label>
                                            <input type="text" class="form-control form-control-lg" name="lname"
                                                value="{{ old('lname') }}" placeholder="Ex: Doe">
                                            @error('lname')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" class="form-control form-control-lg" name="email"
                                                value="{{ old('email') }}" placeholder="Ex: John@gmail.com">
                                            @error('email')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control form-control-lg" name="phone"
                                                value="{{ old('phone') }}" placeholder="Ex: 03xxxxxxxxx">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Role & Permission*</label>
                                            <div class="">
                                                <select class="form-control form-control-lg" name="user_type">
                                                    <option>Select Role</option>
                                                    @foreach ($data as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <div class="input-group date">
                                                <input type="text" class="form-control form-control-lg"
                                                    id="datepicker" name="date"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Address</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="6" name="address">{{ old('address') }}</textarea>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password*</label>
                                            <input type="password" class="form-control form-control-lg" name="password"
                                                placeholder="xxxxxxxxxxx">
                                            @error('password')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Confirm Password*</label>
                                            <input type="password" class="form-control form-control-lg"
                                                name="password_confirmation" placeholder="xxxxxxxxxxx">
                                            @error('password_confirmation')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg">Create User</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Upload Users Image</h4>
                                <p class="card-description">Image must be in <code>jpg</code>, <code>jpeg</code>
                                    and <code>png</code>.</p><br>
                                <div class="text-center image-area mt-4"">
                                    <img src="#" class="img-fluid rounded shadow-sm mx-auto d-block"
                                        id="imageResult">

                                </div><br>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img" class="file-upload-default"
                                        value="{{ old('img') }}" onchange="readURL(this);" id="upload">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div><br>
                                    <button id="removeImage"
                                        class="btn btn-danger btn-block btn-md rounded">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                        bootstrapdash.com 2020</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                            href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                            templates</a> from Bootstrapdash.com</span>
                </div>
            </footer>
            <!-- partial -->
        </div>

    @stop

    @section('js')

        <script>
            /*  ==========================================
                                                                    SHOW UPLOADED IMAGE
                                                                * ========================================== */
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#imageResult')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(function() {
                $('#upload').on('change', function() {
                    readURL(input);
                });
            });
            /*  ==========================================
                    SHOW UPLOADED IMAGE NAME
                * ========================================== */
            var input = document.getElementById('upload');
            var infoArea = document.getElementById('upload-label');

            input.addEventListener('change', showFileName);

            function showFileName(event) {
                var input = event.srcElement;
                var fileName = input.files[0].name;
                infoArea.textContent = 'File name: ' + fileName;
            }

            $(function() {
                var input = document.getElementById('upload');
                var infoArea = document.getElementById('upload-label');

                input.addEventListener('change', function(event) {
                    readURL(event.target);

                    // Show the "Remove Image" button
                    // removeButton.style.display = 'block';
                });

                $('#removeImage').on('click', function() {
                    // Reset the input field and clear the image preview
                    $('#upload').val('');
                    $('#imageResult').attr('src', '#');
                    infoArea.textContent = 'Choose a file';

                    // Hide the "Remove Image" button
                    // removeButton.style.display = 'none';
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#imageResult').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(input.files[0]);

                        // Display the file name
                        var fileName = input.files[0].name;
                        infoArea.textContent = 'File name: ' + fileName;
                    }
                }
            });
        </script>

        <!-- Plugin js for this page -->
        <script src="{{ asset('admin/assets/vendors/select2/select2.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
        <!-- End plugin js for this page -->

        <!-- Custom js for this page -->
        <script src="{{ asset('admin/assets/js/file-upload.js') }}"></script>
        <script src="{{ asset('admin/assets/js/typeahead.js') }}"></script>
        <script src="{{ asset('admin/assets/js/select2.js') }}"></script>
        <!-- End custom js for this page -->
        <script>
            // JavaScript to activate the datepicker
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the datepicker input
                var datepickerInput = document.getElementById('datepicker');

                // When the datepicker input is focused, show the datepicker
                datepickerInput.addEventListener('focus', function() {
                    // Create a datepicker element
                    var datepicker = document.createElement('input');
                    datepicker.type = 'date';
                    datepicker.style.position = 'absolute';
                    datepicker.style.zIndex = '1000';

                    // Position the datepicker below the input
                    var rect = datepickerInput.getBoundingClientRect();
                    datepicker.style.top = rect.bottom + 'px';
                    datepicker.style.left = rect.left + 'px';

                    // Append the datepicker to the body
                    document.body.appendChild(datepicker);

                    // When a date is selected, update the input value and remove the datepicker
                    datepicker.addEventListener('change', function() {
                        datepickerInput.value = datepicker.value;
                        document.body.removeChild(datepicker);
                    });

                    // When clicking outside the datepicker, remove it
                    document.addEventListener('click', function(event) {
                        if (!datepicker.contains(event.target) && event.target !== datepickerInput) {
                            document.body.removeChild(datepicker);
                        }
                    });
                });
            });
        </script>
    @stop
