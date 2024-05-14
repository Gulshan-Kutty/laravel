<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\StudentCountryMapping;

class StudentController extends Controller
{
    public function index(){
        return view('students.index');

    }

    public function create(){
        $countries = Country::all();
        return view('students.create',compact('countries'));
    }


    public function store(Request $request){
        print_r($request->all());exit;
        $countries = Country::all();
        return view('students.index',compact('countries'));
    }
}
