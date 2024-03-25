<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function users()
    {
        $data = User::with('role')->get();

        return view('admin.user',compact('data'));
    }

    public function add_users()
    {
        $data  = Role::all();
        return view('admin.add_user', compact('data'));
    }

    public function add_users_post(Request $request)
    {
        $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|unique:users,email|email',
                'password'=>'required|min:8|confirmed',
            ]
        );

        $data = new User;
        $name = $request->fname.' '.$request->lname;
        $data->name = $name;
        $data->phone = $request->phone;
        $data->user_type = $request->user_type;
        $data->email_verified_at = $request->date;
        $data->address = $request->address;
        $data->fill($request->all());
        
        if($request->hasFile('img'))
        {

            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->img->move(public_path('admin/assets/user_img'), $imageName);
            $data->profile_img = $imageName;
        }

        $data->save();

        return redirect()->back()->with('msg','User added successfully!');
    }

    public function user_edit($id)
    {
        $data_role = Role::all();
        
        $data = User::findOrfail($id);
        $nameParts = explode(' ',$data->name);
        $fname = $nameParts[0];
        $lname = $nameParts[1];

        return view('admin.edit_user', compact('data','fname', 'lname', 'data_role'));
    }

    public function user_update(Request $request, $id)
    {
        $request->validate(
            [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required|unique:users,email|email',
                'password'=>'required|min:8|confirmed',
            ]
        );

        $data = User::findOrfail($id);
        $name = $request->fname.' '.$request->lname;
        $data->name = $name;
        $data->phone = $request->phone;
        $data->user_type = $request->user_type;
        $data->email_verified_at = $request->date;
        $data->address = $request->address;
        $data->fill($request->all());
        
        if($request->hasFile('img'))
        {

            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->img->move(public_path('admin/assets/user_img'), $imageName);
            $data->profile_img = $imageName;
        }

        $data->save();

        return redirect('/users')->with('msg','User updated successfully!');
    }

    public function user_delete($id)
    {
        $data = User::findOrfail($id);
        $data->delete();

        return redirect()->back()->with('msg', 'User deleted successfully!');
    }

    public function add_roles(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ]
        );

        $data = new Role;
        $data->fill($request->all());
        $data->save();
        
        return redirect()->back()->with('msg','Role added successfully!');

    }

    public function roles()
    {
        $data = Role::all();

        return view('admin.role',compact('data'));
    }

    public function role_delete($id)
    {
        $data = Role::findOrfail($id);
        $data->delete();

        return redirect()->back()->with('msg','Role deleted successfully!');
    }

    public function category()
    {
        $data = Category::all();

        return view('admin.category', compact('data'));
    }

    public function categoryPost(Request $request)
    {
        $data = new category;
        $data->fill($request->all());

        $data->save();

        return redirect()->back()->with('msg','Category added successfully!');
    }

    public function add_product()
    {
        $data = Category::all();
        return view('admin.add_product', compact('data'));
    }

    public function add_product_post(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'quantity' => 'required|integer',
                'price' => 'required|integer',
            ]
        );

        $data = new Product;
        $data->fill($request->all());
        $data->category = $request->category;

        $user = Auth::id();
        if($user)
        {
            $data->user_id = $user;
        }

        if($request->hasFile('img'))
        {
            $image = $request->file('img');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->img->move(public_path('admin/assets/product_img'), $imageName);
            $data->product_img = $imageName;
        }

        $data->save();

        return redirect()->back()->with('msg', 'Product added successfully!');

    }

    public function all_product()
    {
        // $data = Product::with(['user' => function ($query){
        //     $query->with('role');
        // },'category'])->get();
        $data = Product::with(['user.role', 'category'])->get();

        // dd($data->category);

        return view('admin.all_product', compact('data'));
    }
}
