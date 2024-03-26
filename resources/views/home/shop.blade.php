@extends('home.masterpage')
@section('meta-description-keywords')

<meta name="description" content="" />
<meta name="keywords" content="bootstrap, bootstrap4" />

@stop
@section('title','Shop All Furniture and Interior Design Products')
@section('css')


@stop

@section('content')

		<!-- Start Hero Section -->
        <div class="hero">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-5">
                        <div class="intro-excerpt">
                            <h1>Shop</h1>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        
                    </div>
                </div>
            </div>
        </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
              <div class="row">

                  <!-- Start Column 1 -->
                  @foreach ($data as $product)
                    
                  <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                      <a class="product-item" href="cart.html">
                          <img src="{{ asset('admin/assets/product_img') }}/{{ $product->product_img }}" class="img-fluid product-thumbnail">
                          <h3 class="product-title">{{$product->title}}</h3>
                          @if ($product->discount_price == null)
                              
                          <strong class="product-price">{{'Rs.'.$product->price}}</strong>
  
                          @else
  
                          <strong class="product-price">{{'Rs.'.$product->discount_price}}</strong>
  
                          @endif
  
                          <span class="icon-cross">
                              <img src="{{asset('home/images/cross.svg')}}" class="img-fluid">
                          </span>
                      </a>
                  </div> 
                  @endforeach 
                <!-- End Column 1 -->

              </div>
        </div>
    </div>



@stop

@section('js')


@stop
