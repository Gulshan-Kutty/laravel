<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index(){
        // echo "hello";
        return view('nextpage');
    }

    public function compact(){
        $name = 'John';
        $age = 30;
        $city = 'New York';

        return view('compact', compact('name', 'age', 'city'));
        }
}
