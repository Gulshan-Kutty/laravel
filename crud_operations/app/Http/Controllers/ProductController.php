<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductController extends Controller
{
    // public function index(){
    //     return view('welcome');
    // }

    public function index(){
        // DB::enableQueryLog();     
        $test = Product::get();
        // print_r($test->toArray());exit;
        // print_r(DB::getQueryLog());exit;
        return view('products.index',compact('test'));
    }

    public function create(){
        $title = 'Create';
        return view('products.create',compact('title'));
    }

    public function store(Request $request){
        // validate data
        // print_r($request->all());exit();

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // 'image'=> 'required|mimes:jpeg,jpg,png,gif|max:10000'
            
            // all above validation error messages are laravel pre defined validation error messages. To write custom defined validation error messages refer below code:

            //  Validation rules
            // $rules = [
            //     'email' => 'required|email|unique:users',
            // ];

            // Custom error messages
            // $messages = [
            //     'email.required' => 'Please provide your email.',
            //     'email.email' => 'The email must be a valid email address.',
            //     'email.unique' => 'The email has already been taken.',
            // ];

            // Validate the incoming request with the defined rules and messages
            // $request->validate($rules, $messages);

            // If validation passes, continue with other logic (e.g., saving to database)
        ]);
        switch ($request->button) {
            case 'Update':
                $prod = Product::where('id',$request->id)->first(); // This is query builder method that retrieves the first result of the query. Since it's expected that there should be only one record with a given id (as id is usually a primary key), first() is used to retrieve that single record.
                $prod->name = $request->name;
                $prod->description = $request->description;
                $prod->updated_at = date('Y-m-d h:m:s');
                $prod->save();
                break;
            default:
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('products'),$imageName);

                // Query builder method
                // $arrayName = array(
                //     'image' => $imageName,
                //     'name' => $request->name,
                //     'description' => $request->description
                // );
                // $var = DB::table('products')->insert($arrayName);

                // Eloquent ORM method
                $product = new Product; // created object(instance) of class 'Product'. use keyword 'new' only when creating new user/product.
                $product->image = $imageName;
                $product->name = $request->name;
                $product->description = $request->description;
                $product->save();
                break;
        }
        return redirect()->route('products.index');
    }

    public function edit($id){
        $id_data = base64_decode($id);
        $title = 'Update';
        // DB::enableQueryLog(); // Enable query logging
        // Perform some database queries
        $product = Product::where('id',$id_data)->first();
        // print_r(DB::getQueryLog());exit; // Print out the logged queries.When you run this code, you'll see the SQL queries executed by Laravel printed out, helping you understand the database interactions your application is making. This is particularly useful for debugging and optimizing your database queries.
        return view('products.create',compact('product','title'));
    }

    public function delete($id){
        $id_data = base64_decode($id);
        $product = Product::where('id',$id_data)->delete();
        return redirect()->route('products.index');
    }
}
