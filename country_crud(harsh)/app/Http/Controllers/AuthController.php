<?php

namespace App\Http\Controllers;

use App\Models\Authen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerData(Request $request)
    {
        $dupli = Authen::where('email', $request->email)->first();
        if ($dupli == null) {
            $auth = new Authen;
            $auth->name = $request->name;
            $auth->email = $request->email;
            $auth->password = Hash::make($request->password);
            $auth->save();
            return redirect()->route('auth.login')->withsuccess('Registered successfully....');
        } else {
            return back()->witherror('Email exist....');
        }
    }


    public function login()
    {
        return view('auth.login');
    }

    public function loginData(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $Authen = Authen::where('email', $request->email)->first();
        // dd($Authen->id);
        if (Auth::attempt($credentials)) {
            $request->session()->put('id', $Authen->id);
            return redirect()->route('user.index')->withsuccess('Login Successfully...');
        }
        return back()->witherror('Please enter valid credentials...');
    }

    public function logoutFlush()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('auth.login')->withsuccess('Logout Successfully...');
        // if (Session::has('id')) {
        //     Session::pull('id');
        // }
    }
}
