@extends('admin.masterpage')
@section('title', 'All Products')
@section('css')

    <style>
        .btn3 {
            font-family: Arial, sans-serif;
            padding: 10px 15px;
            border: none;
            background: dodgerblue;
            color: white;
            border-radius: 4px;
            font-size: 15px;
        }
    </style>

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
                <h3 class="page-title"> All Products </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Products</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Product </th>
                                            <th> Title</th>
                                            <th> Description </th>
                                            <th> Category </th>
                                            <th> Quantity </th>
                                            <th> Price </th>
                                            <th> Discount Price </th>
                                            <th> User </th>
                                            <th> Date </th>
                                            <th> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $product)
                                            <tr>
                                                <td class="py-1">
                                                    @if ($product->product_img == null)
                                                        <img src="{{ asset('admin/assets/images/faces-clipart/pic-1.png') }}"
                                                            alt="image" />
                                                    @else
                                                        <img src="{{ asset('admin/assets/product_img/') }}/{{ $product->product_img }}"
                                                            alt="image" />
                                                    @endif
                                                </td>
                                                <td> {{ $product->title }} </td>
                                                <td class="text-wrap"> {{ $product->description }} </td>

                                                <td class="text-white">
                                                    {{ $cat ?? 'None' }}
                                                </td>

                                                <td> {{ $product->quantity }} </td>
                                                <td> {{ 'Rs.' . $product->price }} </td>
                                                <td> {{ 'Rs.' . $product->discount_price }} </td>
                                                <td class="text-white"> {{ $product->user->name }}
                                                    <br>
                                                    <span class="text-small"> {{ $product->user->role->name }} </span>
                                                </td>
                                                <td> {{ $product->created_at->format('F j, Y') }} </td>
                                                <td>
                                                    <a href="{{ url('/user_delete') }}/{{ $product->id }}"
                                                        class="badge badge-danger"><i class="mdi mdi-delete"
                                                            style="font-size: 20px"></i></a>
                                                    <a href="{{ url('/user_edit') }}/{{ $product->id }}"
                                                        class="badge badge-primary"><i class="mdi mdi-grease-pencil"
                                                            style="font-size: 20px"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button class="btn3">Button 3</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
                    2020</span>
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
        $('.btn3').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                animation: false
            }).then((result) => {
                if (result.value) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    Toast.fire({
                        type: 'success',
                        title: 'Signed in successfully'
                    })
                }
            })
        })
    </script>

@stop
