@extends('admin.masterpage')
@section('title', 'Roles & Permission')
@section('css')


@stop

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Roles & Permissions Tables </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles & Permissions tables</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Add Role</h4>
                <p class="card-description"> Roles examples like <code>admin</code> and <code>customer</code>.</p>

                <form action="{{url('/rolesPost')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg" name="name"><br>
                      <button type="submit" class="btn btn-success btn-lg">Create</button>
                    </div>
                </form>

              </div>
            </div>
          </div>
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body p-5">
                <h4 class="card-title">All Roles</h4>
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
                        <a href="{{url('/role_delete')}}/{{$data->id}}" class="badge badge-danger"><i class="mdi mdi-delete" style="font-size: 20px"></i></a>
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


@stop
