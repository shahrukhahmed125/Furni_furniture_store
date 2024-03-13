<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('admin.add_user');
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
        $data->fill($request->all());
        $data->save();

        return redirect()->back()->with('msg','User added successfully!');
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
}
