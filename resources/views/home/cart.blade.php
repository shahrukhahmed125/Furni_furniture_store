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
                            <h1>Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        
                    </div>
                </div>
            </div>
        </div>
    <!-- End Hero Section -->

    

    <div class="untree_co-section before-footer-section">
      @if ($cart->isEmpty())
      
        <div class="conatiner p-5" >
          <div class="row">

            <div class="col-md-12 p-5" style="display: flex;align-items:center;justify-content:center;">
  
              <div class="intro-excerpt">
    
                <h1> No items in the cart!</h1>
              </div>
            </div>
            <div class="col-md-12 p-3" style="display: flex;align-items:center;justify-content:center;">
              <a class="btn btn-outline-black btn-sm btn-block" href="{{route('shop')}}">Continue Shopping</a>
            </div>
          </div>
        </div>

      @else
      
        <div class="container">
          <div class="row mb-5">
            <form class="col-md-12" method="post">
              <div class="site-blocks-table">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="product-thumbnail">Image</th>
                      <th class="product-name">Product</th>
                      <th class="product-price">Price</th>
                      <th class="product-quantity">Quantity</th>
                      <th class="product-total">Total</th>
                      <th class="product-remove">Remove</th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($cart as $data)
                        
                      
                        <tr>
                          <td class="product-thumbnail">
                            <img src="{{ asset('admin/assets/product_img') }}/{{$data->product->product_img}}" alt="Image" class="img-fluid">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-black">{{$data->product->title}}</h2>
                          </td>
                          @if ($data->product->discount_price == null)
                          <td>{{'Rs.'.$data->product->price}}</td>
                          @else
                          <td>{{'Rs.'.$data->product->discount_price}}</td>

                          @endif
                          <td>
                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                              </div>
                              <input type="text" class="form-control text-center quantity-amount" value="{{$data->quantity}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                              <div class="input-group-append">
                                <button class="btn btn-outline-black increase" type="button">&plus;</button>
                              </div>
                            </div>
        
                          </td>
                          @if ($data->product->discount_price == null)
                          
                          <td>{{'Rs.'.$data->product->price * $data->quantity}}</td>
                          @else
                          
                          <td>{{'Rs.'.$data->product->discount_price * $data->quantity}}</td>
                          @endif
                          <td><a href="{{route('remove_from_cart', ['id' => $data->id])}}" class="btn btn-black btn-sm">X</a></td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </form>
          </div>
    
          <div class="row">
            <div class="col-md-6">
              <div class="row mb-5">
                <div class="col-md-6 mb-3 mb-md-0">
                  <a class="btn btn-black btn-sm btn-block" href="{{route('clear_all_cart')}}">Clear Cart</a>
                </div>
                <div class="col-md-6">
                  <a class="btn btn-outline-black btn-sm btn-block" href="{{route('shop')}}">Continue Shopping</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label class="text-black h4" for="coupon">Coupon</label>
                  <p>Enter your coupon code if you have one.</p>
                </div>
                <div class="col-md-8 mb-3 mb-md-0">
                  <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                </div>
                <div class="col-md-4">
                  <button class="btn btn-black">Apply Coupon</button>
                </div>
              </div>
            </div>
            <div class="col-md-6 pl-5">
              <div class="row justify-content-end">
                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-12 text-right border-bottom mb-5">
                      <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Subtotal</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black">{{'Rs.'.$totalItems}}</strong>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <span class="text-black">Delivery charges</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black">{{'Rs.'.$tax}}</strong>
                    </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <span class="text-black">Total</span>
                    </div>
                    <div class="col-md-6 text-right">
                      <strong class="text-black">{{'Rs.'.$total_price}}</strong>
                    </div>
                  </div>
    
                  <div class="row">
                    <div class="col-md-12">
                      <a class="btn btn-black btn-lg py-3 btn-block" href="{{route('checkout',['id' => $id])}}">Proceed To Checkout</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
      @endif
      </div>

@stop

@section('js')


@stop
