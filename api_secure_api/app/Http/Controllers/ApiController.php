<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Auth;


class ApiController extends Controller
{
    // fucntion to register user
    public function registerUser(Request $request){

        // validation 
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|min:6',
        ]);

        if($validator->fails()){
            $result = array('status'=> false, 'message'=>'Validation error occured', 'error_message'=> $validator->errors()); 
            return response()->json($result, 400); // 400->Bad request

        }

        // save data in database
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> bcrypt($request->password),
        ]);

        // OR
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->phone = $request->phone;
        // $user->password = bcrypt($request->password);
        // $user->save();

        if($user->id){
            $result = array('status'=> true, 'message'=>'User Created', 'data'=> $user); 
            $responseCode = 200;   // 200-> Success  
        }else{
            return response()->json(['status'=> false, 'message'=>'Something went wrong']);
            $responseCode = 400;  // 400-> Bad request

        }
        return response()->json($result,$responseCode);
    }

    // function to return all users with error handling
    public function getUser(){
        try{
            $user = User::all();
            $result = array('status'=> true, 'message'=>count($user)." user(s) fetched", 'data'=> $user); 
            $responseCode=200; // to check exception error, comment this line and run get-user API.
            return response()->json($result,$responseCode);
        }
        catch(Exception $e){
            $result = array('status'=> false, 'message'=>"API failed due to an error" ,"error"=> $e->getMessage()); 
            return response()->json($result,500);

        }
        
    }

    public function getSingleUserDetail($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['status'=>false, 'message'=> 'user not found'], 404);

        }
        $result = array('status'=> true, 'message'=>"user found", 'data'=> $user); 
        $responseCode=200;
        return response()->json($result,$responseCode);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['status'=>false, 'message'=> 'user not found'], 404);
        }

        // validation 
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email,'.$id,
            'phone' => 'required|numeric|digits:10',
        ]);

        if($validator->fails()){
            $result = array('status'=> false, 'message'=>'Validation error occured', 'error_message'=> $validator->errors()); 
            return response()->json($result, 400); // 400->Bad request

        }

        // update
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $result = array('status'=> true, 'message'=>'User has been updated successfully', 'data'=>$user); 
        return response()->json($result, 200);

    }
    
    public function deleteUser($id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['status'=>false, 'message'=> 'user not found'], 404);
        }

        $user->delete();

        $result = array('status'=> true, 'message'=>'User deleted successfully'); 
        return response()->json($result, 200);

    }

    // login function
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['status'=> false, 'message'=>'Validation error occured', 'error_message'=> $validator->errors()], 400); // 400->Bad request
        }


        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            // creating a token
            $token = $user->createToken('authtoken')->plainTextToken;
            return response()->json(['status'=>true, 'message'=>'Login Successful', 'token'=>$token], 200);

        }

        return response()->json(['status'=>false, 'message'=>'Invalid login credentials'], 401);

    }

    public function unauthenticate(Request $request){
 
        return response()->json(['status'=>false, 'message'=>'Unauthenticated user'], 401);

    }

    public function logout(Request $request){
        $user = Auth::User();
        // OR
        // $user = Auth::guard('api')->User();

        // $user->tokens->each(function ($token, $key){
        //     $token->delete();
        // });

        return response()->json(['status'=>true, 'message'=>'Logged out successfully'], 200);

    }
}
