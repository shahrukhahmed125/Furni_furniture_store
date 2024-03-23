@extends('admin.masterpage')
@section('title','All Products')
@section('css')


@stop

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> All Products </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
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
                    @foreach ($data as $data)
                        
                    <tr>
                      <td class="py-1">
                        @if ($data->product_img == null)
                        <img src="{{asset('admin\assets\images\faces-clipart\pic-1.png')}}" alt="image" />
                        @else
                        <img src="{{asset('admin/assets/user_img/')}}/{{$data->product_img}}" alt="image" />
                        @endif
                      </td>
                      <td> {{$data->title}} </td>
                      <td class="text-wrap"> {{$data->description}} </td>

                      <td> {{$data->category}} </td>

                      <td> {{$data->quantity}} </td>
                      <td> {{'Rs.'.$data->price}} </td>
                      <td> {{'Rs.'.$data->discount_price}} </td>
                      <td class="text-white"> {{($data->user)->name}} 
                        <br>
                        <span> {{$data->user->role->name}} </span>
                      </td>
                      <td> {{$data->created_at->format('F j, Y')}} </td>
                      <td> 
                        <a href="{{url('/user_delete')}}/{{$data->id}}" class="badge badge-danger"><i class="mdi mdi-delete" style="font-size: 20px"></i></a>
                        <a href="{{url('/user_edit')}}/{{$data->id}}" class="badge badge-primary"><i class="mdi mdi-grease-pencil" style="font-size: 20px"></i></a>
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