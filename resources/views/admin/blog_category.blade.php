@extends('admin.masterpage')
@section('title','Add Blog Category')
@section('css')

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
        <h3 class="page-title"> Blog Categories </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog Categories</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Add Category</h4>
                <p class="card-description"> Category examples like <code>Fashion</code> and <code>Trends</code>.</p>

                <form action="{{route('blog_category_post')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" name="name" value="{{old('name')}}">
                        @error('name')
                            <code>{{'*'.$message}}</code>
                        @enderror
                      <br>
                      <button type="submit" class="btn btn-success btn-lg mt-3">Create</button>
                    </div>
                </form>

              </div>
            </div>
          </div>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body p-5">
                <h4 class="card-title">All Categories</h4>
              </p>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Id </th>
                      <th> Name </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $data)
                        
                    <tr>
                      <td>{{$data->id}}</td>
                      <td> {{$data->name}} </td>
                      <td>
                        <a href="{{url('/blog_category_delete')}}/{{$data->id}}" class="badge badge-danger"><i class="mdi mdi-delete" style="font-size: 20px"></i></a>
                        <a href="#" class="badge badge-primary"><i class="mdi mdi-grease-pencil" style="font-size: 20px"></i></a>
                      </td>
                    </tr>

                    @endforeach
                  </tbody>
                </table>
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
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
      </div>
    </footer>
    <!-- partial -->
</div>


@stop

@section('js')

<script>
  const myTimeout = setTimeout(closeAlert, 3000);

  function closeAlert() {
      document.getElementById("toast").style.display = 'none';
  }
</script>

@stop