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
