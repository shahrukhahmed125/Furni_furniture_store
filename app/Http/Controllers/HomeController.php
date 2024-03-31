<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::paginate(3);
        $blog = Blog::paginate(3);
        return view('home.index', compact('data', 'blog'));
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
        $data = Blog::all();
        return view('home.blog', compact('data'));
    }
    public function blog_detail($id)
    {
        $data = Blog::findOrfail($id);
        $recent = Blog::orderBy('created_at', 'desc')->paginate(3);

        return view('home.blog_detail', compact('data', 'recent'));
    }
    public function services()
    {
        return view('home.services');
    }
    public function contact()
    {
        return view('home.contact');
    }
    public function contact_post(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = new Contact;
        $name = $request->fname. ' ' .$request->lname;
        $data->name = $name; 
        $data->fill($request->all());
        $data->save();

        return redirect()->back()->with('msg', 'Message sent successfully!');
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
