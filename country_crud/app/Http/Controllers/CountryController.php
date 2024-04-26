<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(){
        
        // $data = Country::get();
        // print_r($data->toArray());exit;
        $data = Country::first()->paginate(3);

        return view('countries.home', compact('data'));
    }

    public function create(){
        $title = 'Create';
        return view('countries.create', compact('title'));
    }

    public function store(Request $request){
        // print_r($request->all());exit();
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'code' => 'required|numeric|',
        ], [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name field must contain only alphabets and spaces.',
            'code.required' => 'The code field is required.',
        ]); // if found some validations errors here it don't execute further code below(i.e it won't create or update the data)
    
// Here are some common predefined error messages related to Laravel's built-in validation rules:

// required: ":attribute field is required."
// required_if: ":attribute field is required when :other is :value."
// required_unless: ":attribute field is required unless :other is in :values."
// required_with: ":attribute field is required when :values is present."
// required_with_all: ":attribute field is required when :values are present."
// required_without: ":attribute field is required when :values is not present."
// required_without_all: ":attribute field is required when none of :values are present."
// numeric: ":attribute field must be a number."
// integer: ":attribute field must be an integer."
// boolean: ":attribute field must be true or false."
// string: ":attribute field must be a string."
// email: ":attribute field must be a valid email address."
// url: ":attribute field must be a valid URL."
// date: ":attribute field must be a valid date."
// date_format: ":attribute field does not match the format :format."
// date_equals: ":attribute field must be a date equal to :date."
// date_after: ":attribute field must be a date after :date."
// date_before: ":attribute field must be a date before :date."
// confirmed: ":attribute confirmation does not match."
// unique: ":attribute field has already been taken."
// exists: "The selected :attribute is invalid."
// max: ":attribute may not be greater than :max characters."
// min: ":attribute must be at least :min characters."
// size: ":attribute must be :size characters."
// file: ":attribute must be a file."

// These error messages include placeholders like :attribute, :other, :value, etc., which will be replaced with the actual attribute name, other field name, value, etc., during validation.

        switch ($request->button) {
            case 'Update':
                $prod = Country::where('id',$request->id)->first();
                $prod->country_name = $request->name;
                $prod->country_code = $request->code;
                // print_r($request->image);exit;
                $prod->updated_at = date('Y-m-d h:m:s');
                $prod->save();
                break;

            default:
                $product = new Country; // use keyword 'new' only when creating new user/product.
                $product->country_name = $request->name;
                $product->country_code = $request->code;
                $product->save();
                // print_r($product->toArray());exit;
                break;
        }
        return redirect()->route('countries.home');
    }
    
    public function edit($id){
        $d_id = base64_decode($id);
        // print_r($d_id);exit;
        $title = 'Update';
        $info = Country::where('id',$d_id)->first();
        // print_r($info->toArray());exit;
        return view('countries.create', compact('info', 'title')); // here I just viewed thw html page of create file but route will be of edit only.
    }

    public function delete($id){
        $decoded_id = base64_decode($id);
        // $info = Product::where('id',$decoded_id)->delete();

        // Fetch the product information
        $info = Country::where('id',$decoded_id)->first();

        // Delete the record from the database
        $info->delete();

        return redirect()->route('countries.home');
    }

    public function view($id){
        $d_id = base64_decode($id);
        $info = Country::where('id',$d_id)->first();
        return view('countries.view', compact('info'));
    }
}

