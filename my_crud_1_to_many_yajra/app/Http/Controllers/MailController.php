<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    public function mailForm(){
        return view('email.mailForm');

    }

    public function sendMail(Request $request){
        // $mailData = [
        //     'title'=> 'Mail from gulshan',
        //     'body' => 'Hello how are you brother'

        // ];

        // Mail::to('gkutty74@gmail.com')->send(new DemoMail($mailData));
        
        // dd('Email Sent successfully');


            // $cc=$request->cc;
            if(!empty($request->cc)){
                $emails = $request->cc;
                $emailArray = explode(",", $emails);
                // print_r($emailArray);exit;
            }
            if($request->hasFile('file')){
                $filepath = time() . '.' . $request->file->extension();
                $file=$request->file->move(public_path('uploads'), $filepath);
            }
    
    
            if(empty($emailArray)&&empty($request->hasFile('file'))){
                $mailData=[
                    'title'=>$request->title,
                    'body'=>$request->body,
                ];
                Mail::to($request->email)->send(new DemoMail($mailData));
                return back()->withsuccess('Mail sent');
    
            }
            elseif(!empty($emailArray)&&!empty($request->hasFile('file'))){
                $mailData=[
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'file'=>$file,
                    'emailArray'=>$emailArray
                ];
                Mail::to($request->email)->send(new DemoMail($mailData));
                return back()->withsuccess('Mail sent');
            }
            elseif(empty(!empty($emailArray)&&$request->hasFile('file'))){
                $mailData=[
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'emailArray'=>$emailArray
                ];
                Mail::to($request->email)->send(new DemoMail($mailData));
                return back()->withsuccess('Mail sent');
            }
            else{
                $mailData=[
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'file'=>$file,
                ];
                Mail::to($request->email)->send(new DemoMail($mailData));
                return back()->withsuccess('Mail sent');
            }
    }
}
