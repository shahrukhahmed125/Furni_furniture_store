@extends('home.masterpage')
@section('meta-description-keywords')
<meta name="description" content="" />
<meta name="keywords" content="bootstrap, bootstrap4" />

@stop
@section('title','Furniture and Interior Design Products')
@section('css')


@stop

@section('content')
    
    		<!-- Start Hero Section -->
            <div class="hero">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <div class="intro-excerpt">
                                <h1>Login Account</h1>
                                <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="hero-img-wrap">
                                <img src="images/couch.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Hero Section -->
    
        
        <!-- Start Contact Form -->
        <div class="untree_co-section">
      <div class="container">
    
        <div class="block">
          <div class="row justify-content-center">
    
    
            <div class="col-md-8 col-lg-8 pb-4">
                <div class="border p-4 rounded mb-5" role="alert">
                    Register an account <a href="{{route('register')}}">Click here.</a>
                </div>
    
              <form action="{{route('loginPost')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label class="text-black" for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                  @error('email')
                    <p class="badge bg-danger text-white rounded-pill">{{ '* ' . $message }}</p>
                  @enderror
                </div>
    
                <div class="form-group mb-5">
                  <label class="text-black" for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                  @error('password')
                    <p class="badge bg-danger text-white rounded-pill">{{ '* ' . $message }}</p>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary-hover-outline mb-5 px-5">Login</button>

              </form>
    
            </div>
    
          </div>
    
        </div>
    
      </div>
    
    
    </div>
    </div>
    
    <!-- End Contact Form -->
    
    


@stop

@section('js')


@stop