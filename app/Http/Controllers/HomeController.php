<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\cart;
use App\Models\Like;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = Product::paginate(3);
        $blog = Blog::orderBy('created_at', 'desc')->paginate(3);
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
        $comment = Comment::where('blog_id', $id)->orderBy('created_at', 'desc')->get();
        $reply = Reply::orderBy('created_at', 'desc')->paginate(3);

        return view('home.blog_detail', compact('data', 'recent', 'comment', 'reply'));
    }

    public function comment_post(Request $request, $id)
    {
        $request->validate(
            [
                'content' => 'required|string',
            ]
        );

        $data = new Comment;
        $data->blog_id = $id;
        $data->fill($request->all());

        $user = Auth::id();
        if($user)
        {
            $data->user_id = $user;
            $data->save();

            return redirect()->back()->with('msg','Comment added successfully!');
            // return response()->json(['success' => true, 'message' => 'Comment added successfully!']);
        }
        else{
            return redirect()->back()->with('msg','Login required to comment!');
        }


    }

    public function reply_post(Request $request, $id)
    {
        $request->validate(
            [
                'reply' => 'required|string',
            ]
        );

        $data = new Reply;
        $data->comment_id = $id;
        $data->fill($request->all());

        $user = Auth::id();
        if($user)
        {
            $data->user_id = $user;
            $data->save();

            return redirect()->back()->with('msg','Reply is sent successfully!');
        }
        else{
            return redirect()->back()->with('msg','Login required to reply!');
        }


    }

    public function like(Request $request, Comment $comment)
    {
        
        if(Auth::check())
        {
            $request->validate([
                'user_id' => 'required|exists:users,id',
            ]);

            // Check if the user has already liked the comment
            if (!$comment->likes()->where('user_id', $request->user_id)->exists()) {
                $like = new Like();
                $like->user_id = $request->user_id;
                $comment->likes()->save($like);
        
                // Increment likes count for the comment
                $comment->increment('likes');
        
                return response()->json(['message' => 'Comment liked successfully', 'likes' => $comment->likes]);
            }
        
            return response()->json(['message' => 'Already liked!']);
        }
        else
        {

            return response()->json(['message' => 'Login required!']);
        }

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

    public function add_to_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $data = Product::findOrfail($id);

            $cart = new cart;
            $cart->user_id = $user->id;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;

            $cart->product_id = $data->id;
            $cart->product_title = $data->title;

            if($data->discount_price != null)
            {
                $cart->price = $data->discount_price;
            }
            else{
                $cart->price = $data->price;
            }
            $cart->product_img = $data->product_img;
            $cart->quantity = $data->quantity;
            $cart->save();

            return redirect()->back()->with('msg','Added to cart successfully!');

        }else{
        
            return redirect('/login');

        }
    }

    public function cart()
    {
        if(Auth::id())
        {

            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->get();
            // $total_price = $cart->price * $cart->quantity;
            // $totalItems = Cart::where('user_id','=',$id)->sum('quantity');

            return view('home.cart', compact('cart'));

        }else{

            return redirect('/login');
        }
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
