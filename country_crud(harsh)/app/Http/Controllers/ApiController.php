<?php

namespace App\Http\Controllers;
use App\Models\User2;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function postmancheck(){
        print_r('hello');exit;
    }
    public function postmancheckdata(Request $request){
        // print_r($request->all());
        $request->validate([
            'name' => 'required|regex:/^([a-zA-Z\s]+)$/',
            'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
            'password'=>'required'
        ]);
        try{
            $user=new User2;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=$request->password;
            $user->save();
            if($user->id){
                $res= array('status'=>true,'message'=>'connection successfull..','data'=>$user);
                $responseCode=200;
            }
            else{
                $res= array('status'=>false,'message'=>'connection fail..','data'=>$user);
                $responseCode=400;
            }
        }
        catch(Exception $e){
            $res= array('status'=>true,'message'=>'Api failed..','error'=>$e->getMessage());
            $responseCode=404;

        }
       
     
        
        return response()->json([$res,$responseCode]);
    }
}
