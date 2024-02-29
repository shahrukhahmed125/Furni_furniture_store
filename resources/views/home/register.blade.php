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
                                <h1>Register Account</h1>
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
                    Already had an account <a href="{{route('login')}}">Click here</a> to login.
                </div>
    
              <form>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="fname">First name</label>
                      <input type="text" class="form-control" id="fname">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="lname">Last name</label>
                      <input type="text" class="form-control" id="lname">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="text-black" for="email">Email address</label>
                  <input type="email" class="form-control" id="email">
                </div>
    
                <div class="form-group">
                  <label class="text-black" for="password">Password</label>
                  <input type="password" class="form-control" id="password">
                </div>

                <div class="form-group mb-5">
                  <label class="text-black" for="password">Confirm Password</label>
                  <input type="password" class="form-control" id="password">
                </div>
    
                <button type="submit" class="btn btn-primary-hover-outline mb-5">Sign Up</button>

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