<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\cart;
use App\Models\Like;
use App\Models\Product;
use App\Models\Reply;
use App\Models\User;
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
            return redirect('/login')->with('msg','Login required to comment!');
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
            return redirect('/login')->with('msg','Login required to reply!');
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
            $cart->title = $data->title;
            if($data->discount_price != null)
            {

                $cart->price = $data->discount_price;
            }else{
                $cart->price = $data->price;

            }

            $cart->product_id = $data->id;
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->back()->with('msg','Added to cart successfully!');

        }else{
        
            return redirect('/login');

        }
    }

    public function remove_from_cart($id)
    {
        $data = cart::findOrfail($id);
        $data->delete();

        return redirect()->back()->with('msg', 'Item from cart deleted!');

    }

    public function clear_all()
    {
        if(Auth::id())
        {
            $id = Auth::user()->id;
            Cart::where('user_id','=',$id)->delete();

            return redirect()->back();
        }
    }

    public function cart()
    {
        if(Auth::id())
        {

            $id = Auth::user()->id;
            $cart = Cart::where('user_id','=',$id)->with(['user', 'product'])->get();
            $tax = 200;
            $totalItems = $cart->sum("price");
            $total_price = $totalItems + $tax;

            return view('home.cart', compact('cart', 'totalItems', 'total_price', 'tax', 'id'));

        }else{

            return redirect('/login')->with('msg','Login requied to view cart items!');
        }
    }

    public function checkout($id)
    {
        $user = User::findOrfail($id);
        $name = explode(' ',$user->name);
        $fname = $name[0];
        $lname = $name[1];

        $cart = Cart::where('user_id','=',$id)->with(['user', 'product'])->get();
        $tax = 200;
        $totalItems = $cart->sum("price");
        $total_price = $totalItems + $tax;
        
        $countries = [
            'Afghanistan',
            'Albania',
            'Algeria',
            'Andorra',
            'Angola',
            'Antigua and Barbuda',
            'Argentina',
            'Armenia',
            'Australia',
            'Austria',
            'Azerbaijan',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bhutan',
            'Bolivia',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'Brunei',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cabo Verde',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Central African Republic',
            'Chad',
            'Chile',
            'China',
            'Colombia',
            'Comoros',
            'Congo (Congo-Brazzaville)',
            'Costa Rica',
            'Croatia',
            'Cuba',
            'Cyprus',
            'Czechia (Czech Republic)',
            'Democratic Republic of the Congo',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Eswatini (fmr. "Swaziland")',
            'Ethiopia',
            'Fiji',
            'Finland',
            'France',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Greece',
            'Grenada',
            'Guatemala',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Holy See',
            'Honduras',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran',
            'Iraq',
            'Ireland',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            'Kuwait',
            'Kyrgyzstan',
            'Laos',
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Mauritania',
            'Mauritius',
            'Mexico',
            'Micronesia',
            'Moldova',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Morocco',
            'Mozambique',
            'Myanmar (formerly Burma)',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'North Korea',
            'North Macedonia',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Palestine State',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Poland',
            'Portugal',
            'Qatar',
            'Romania',
            'Russia',
            'Rwanda',
            'Saint Kitts and Nevis',
            'Saint Lucia',
            'Saint Vincent and the Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome and Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Korea',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Sweden',
            'Switzerland',
            'Syria',
            'Tajikistan',
            'Tanzania',
            'Thailand',
            'Timor-Leste',
            'Togo',
            'Tonga',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom',
            'United States of America',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Venezuela',
            'Vietnam',
            'Yemen',
            'Zambia',
            'Zimbabwe',
        ];
        

        return view('home.checkout',compact('cart', 'tax', 'totalItems', 'total_price', 'user', 'fname', 'lname', 'countries'));
    }
    
    public function thankyou()
    {
        return view('home.thankyou');
    }

}
