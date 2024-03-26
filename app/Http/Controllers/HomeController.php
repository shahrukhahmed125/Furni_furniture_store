<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::paginate(3);
        return view('home.index', compact('data'));
    }
    public function shop()
    {
        $data = Product::all();
        return view('home.shop', compact('data'));
    }
    public function about()
    {
        return view('home.about');
    }
    public function blog()
    {
        return view('home.blog');
    }
    public function services()
    {
        return view('home.services');
    }
    public function contact()
    {
        return view('home.contact');
    }
    public function cart()
    {
        return view('home.cart');
    }
    public function checkout()
    {
        return view('home.checkout');
    }
    public function thankyou()
    {
        return view('home.thankyou');
    }

}
