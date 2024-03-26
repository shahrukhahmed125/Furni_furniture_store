@extends('admin.masterpage')
@section('title', 'Change Password')
@section('css')


@stop

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> User Change Password </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Change Password</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Update Password</h4>
                <p class="card-description"> Password must be <code>8 characters</code> and also use <code>special characters</code> and <code>numbers</code>.</p>

                <form action="{{route('change_password_post')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Current Password</label>
                              <input type="password" class="form-control form-control-lg" name="old_password" required>
                                @error('old_password')
                                    <code>{{ '*' . $message }}</code>
                                @enderror
                              <br>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>New Password</label>
                              <input type="password" class="form-control form-control-lg" name="new_password" required>
                                @error('new_password')
                                    <code>{{ '*' . $message }}</code>
                                @enderror
                              <br>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-success btn-lg">Update</button>
                        <a href="{{route('dashboard')}}" class="btn btn-danger btn-lg">Cancel</a>

                    </div>
                </form>

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
