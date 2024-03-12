<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    public function login()
    {
        return view('home.auth.login');
    }

    public function loginPost(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email', 'password')))
        {
            $user_type = Auth::user()->user_type;
            if($user_type == 1)
            {
                return redirect('/AdminDashboard');
            }
            elseif($user_type = 3)
            {

                return redirect('/');
            }
        }

        return redirect('/login')->withErrors('Login details not found!');

    }

    public function register()
    {
        return view('home.auth.register');
    }
    public function registerPost(Request $request)
    {
        $request->validate(
            [
                'fname'=>'required',
                'lname'=>'required',
                'email'=>'required|unique:users,email|email',
                'password'=>'required|min:8|confirmed',
            ]
        );

        $data = new User;
        $name = $request->fname.' '.$request->lname;
        $data->name = $name;
        $data->fill($request->all());
        $data->save();

        return redirect('/');
    }
    public function logout(){
        session()->flush();
        Auth::logout();

        return redirect()->back();
    }
}
