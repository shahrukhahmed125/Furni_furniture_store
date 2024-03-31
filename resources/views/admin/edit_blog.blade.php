@extends('admin.masterpage')
@section('title', 'Edit Blogs')
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
    <link rel="stylesheet" href="{{asset('admin/assets/libs/quill/dist/quill.snow.css')}}">
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
                <h3 class="page-title">Blog Complete Details</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
                    </ol>
                </nav>
            </div>
            <form action="{{ url('/blog_update') }}/{{$data->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Blog</h4>
                                <p class="card-description"> Blog title must be in <code>string</code>.
                                </p>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Title*</label>
                                            <input type="text" class="form-control form-control-lg" name="title"
                                                value="{{ $data->title }}" placeholder="Ex: How To Keep Your Furniture Clean">
                                            @error('title')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group my-3">
                                    <label>Content*</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="6" name="content">{{ old('content') }}</textarea>
                                </div> --}}
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Category*</label>
                                            <div class="">
                                                <select class="form-control form-control-lg" name="category">
                                                    <option>Select Category</option>
                                                    @foreach ($data_cat as $data_cat)

                                                        @if ($data->category_id == $data_cat->id)
                                                            <option selected value="{{ $data_cat->id }}">
                                                                {{ $data_cat->name }}</option>
                                                        @else
                                                            <option value="{{ $data_cat->id }}">{{ $data_cat->name }}
                                                            </option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                          <div class="form-group my-3">
                                            <!-- Create the editor container -->
                                            <label for="">Content*</label>
                                            @error('content')
                                                <code>{{ '*' . $message }}</code>
                                            @enderror  
                                            <div id="editor" style="height: 500px">
                                                {!!$data->content!!}
                                            </div>
                                            <!-- Hidden input to store Quill editor content -->
                                            <input type="hidden" name="content" id="content">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg mt-3">Update Blog</button>
                                <a href="{{route('all_product')}}" class="btn btn-danger btn-lg mt-3">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Upload Blog Cover Image</h4>
                                <p class="card-description">Image must be in <code>jpg</code>, <code>jpeg</code>
                                    and <code>png</code>.</p><br>
                                <div class="text-center image-area mt-4"">
                                    @if ($data->blog_img)
                                        <img src="{{ asset('admin/assets/blog_img') }}/{{ $data->blog_img }}"
                                            class="img-fluid rounded shadow-sm mx-auto d-block" id="imageResult">
                                    @else
                                        <img src="#" class="img-fluid rounded shadow-sm mx-auto d-block"
                                            id="imageResult">
                                    @endif

                                </div><br>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img" class="file-upload-default"
                                    value="{{ $data->blog_img }}" onchange="readURL(this);" id="upload">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image" value="{{ $data->blog_img }}">
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
        <script src="{{asset('admin/assets/libs/quill/dist/quill.min.js')}}"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <!-- End custom js for this page -->

        <script>
            var quill = new Quill("#editor", {
            theme: "snow",
            });

            // Get the hidden input field
            var contentInput = document.querySelector('#content');


            // Function to extract HTML while preserving font features
            function extractHTMLWithFontFeatures(html) {
                var temporalDivElement = document.createElement("div");
                temporalDivElement.innerHTML = html;
                var fonts = temporalDivElement.querySelectorAll('*[style*="font"]');
                fonts.forEach(function(node) {
                    node.style.fontWeight = '';
                    node.style.fontStyle = '';
                    node.style.fontSize = '';
                });
                return temporalDivElement.innerHTML;
            }

            // Listen for changes in the Quill editor
            quill.on('text-change', function() {
                // Get the content from the Quill editor and preserve font features
                var htmlWithFontFeatures = extractHTMLWithFontFeatures(quill.root.innerHTML);

                // Set the value of the hidden input field to the HTML content with font features preserved
                contentInput.value = htmlWithFontFeatures;
            });
        </script>
    @stop
