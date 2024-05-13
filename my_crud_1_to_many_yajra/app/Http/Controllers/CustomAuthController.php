<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;


class CustomAuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function registration(){
        return view('auth.registration');
    }

    public function registerUser(Request $request){

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|max:12|min:5',
        // ]);

        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|unique:users|regex:/^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|max:12|min:5',
        ], [
            'name.regex' => 'The name field must contain only alphabets and spaces.',
            // 'email.regex' => 'Please enter valid email.',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if($res){
            return redirect()->route('login')->with('success','You have registered successfully! You can login now.');
        }
        else{
            return back()->with('fail','Something went wrong');
        }
        
        return view('auth.registration');
    }

    public function loginUser(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:12|min:5',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->Session()->put('loginId',$user->id);
                return redirect()->route('products.home')->withsuccess('You logged in successfully');
            }
            else{
                return back()->with('fail','Password does not match');

            }

        }
        else{
            return back()->with('fail','This email is not registered');

        }
    }

    // public function dashboard(){
    //     if(Session::has('loginId')){
    //         $data = User::where('id', Session::get('loginId'))->first();

    //     }
    //     return view('auth.dashboard', compact('data'));
    // }

    public function logout(){
        // print_r(session()->all());exit;
        if(Session::has('loginId')){
            Session::flush();
        }
        return redirect()->route('login');
    }
}
