<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ApiController extends Controller
{
    public function products(Request $request){
        print_r($request->name);
    }

    // public function products(){
    //     $data = Product::get();
    //     return($data);
    // }
}
