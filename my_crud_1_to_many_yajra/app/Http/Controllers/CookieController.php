<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function setcookie(){  // Use this link: http://localhost/laravel/my_crud_1_to_many_yajra/set-cookie
        $response= response('Cookie is set now');
        $response->withCookie('name','Gulshan RK',60);
        return $response;
    }

    public function getcookie(){
        return request()->cookie('name');
    }

    public function deletecookie(){    
        return response('cookie deleted')->withCookie('name',null,-1);      
    }
}
