@extends('admin.masterpage')
@section('title', 'Add Products')
@section('css')


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
    </style>
    <style>
        .top-right-conner {
            position: fixed;
            top: 8%;
            right: 0;
            z-index: 999;
            /* Ensure it's above other content */
            margin-top: 20px;
            /* Adjust if necessary */
            margin-right: 20px;
            /* Adjust if necessary */
        }
    </style>
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->

@stop

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            @if (session()->has('msg'))
                <div class="container" style="z-index: 11;">
                    <div class="top-right-conner">

                        <div class="toast show bg-success" id="toast"
                            style="background-color:#00AC4A;color:white;font-size:18px;font-weight:800;border:none;">
                            <div class="toast-header bg-light">
                                Message
                                <button type="button" class="btn btn-close" data-bs-dismiss="toast"></button>
                            </div>
                            <div class="toast-body">
                                {{ session()->get('msg') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="page-header">
                <h3 class="page-title">Product Complete Details</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Products</li>
                    </ol>
                </nav>
            </div>
            <form action="{{ route('add_product_post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Products</h4>
                                <p class="card-description"> Product title must be in <code>string</code>, no
                                    <code>numbers</code>
                                    and <code>special characters</code> are allowed.
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Title*</label>
                                            <input type="text" class="form-control form-control-lg" name="title"
                                                value="{{ old('title') }}" placeholder="Ex: Nordic Chair">
                                            @error('title')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <label>Description*</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="6" name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Category*</label>
                                            <div class="">
                                                <select class="form-control form-control-lg" name="category">
                                                    <option>Select Category</option>
                                                    @foreach ($data as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Quantity*</label>
                                            <input type="number" min="0" class="form-control form-control-lg"
                                                name="quantity" placeholder="Ex: 30">
                                            @error('quantity')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Price*</label>
                                            <input type="number" class="form-control form-control-lg" name="price"
                                                placeholder="Rs.1000">
                                            @error('price')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Discount Price</label>
                                            <input type="number" class="form-control form-control-lg" name="discount_price"
                                                placeholder="Rs.50">
                                            @error('discount_price')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg mt-3">Create Product</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Upload Product Image</h4>
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
                                    <button id="removeImage" class="btn btn-danger btn-block btn-md rounded">Reset</button>
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
        <script>
            const myTimeout = setTimeout(closeAlert, 3000);

            function closeAlert() {
                document.getElementById("toast").style.display = 'none';
            }
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

    @stop
