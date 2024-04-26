<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;

class ProductController_relation_1_to_1 extends Controller
{
    public function index(){
    // query without relation   
    // $data= Product::get();

    // query using the relation
    $data = Product::with('country')->get(); // for one to one relation
    // print_r($data->toArray());exit;
 
        return view('products.home_relation_1_to_1', compact('data'));
    }

 public function create(){
        $data1 = Country::get();
        $title = 'Create';
        return view('products.create_relation_1_to_1', compact('title','data1'));
    }

    public function store(Request $request){
        // dd($request->all());exit();

                switch ($request->button) {
                    case 'Update':
                        // $request->validate([
                        //     'name' => 'required',
                        //     'description' => 'required',
                        //     'image' => 'sometimes|required|mimes:jpeg,jpg,png,gif|max:10000'
                        // ]);
                                
                        // form '$request' we get form data, from '$prod' we get database data.
                        $prod = Product::find($request->id); // OR // $prod = Product::where('id',$request->id)->first();
                        // print_r($prod->toArray());
                        // print_r($request->all());exit;
                        if ($prod) {
                            // print_r($prod->image);exit;
                            $prod->name = $request->name;
                            $prod->country_id = $request->multi;
                            $prod->description = $request->description;
                            $prod->from_date = $request->from_date;
                            $prod->to_date = $request->to_date;
                            if ($request->hasFile('image')) {
                                $imageName = time().'.'.$request->image->extension();
                                $request->image->move(public_path('products'),$imageName);
                                if ($prod->image) {
                                    unlink(public_path('products/'.$prod->image));
                                }
                                $prod->image = $imageName;
                            }
                            $prod->updated_at = now();
                            $prod->save();
                            toastr()->success('Product Updated Successfully!', 'Hurray...');

                        } else {
                            // Handle case where product with given ID is not found
                        }
                        break;
                

            default:
            // $request->validate([
            //     'name' => 'required',
            //     'description' => 'required',
            //     'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
            // ]);
                // print_r($request->image->extension());exit;

                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('products'),$imageName);

                $product = new Product; // use keyword 'new' only when creating new user/product.
                $product->name = $request->name;
                $product->country_id = $request->multi;
                $product->description = $request->description;
                $product->from_date = $request->from_date;
                $product->to_date = $request->to_date;
                $product->image = $imageName;
                $product->save();

                // toastr()->success('Success Title', 'Success Message');
                toastr()->success('Product Created Successfully!', 'Hurray...');
                
                // toastr()->error('Error: Something went wrong');
                // toastr()->warning('Warning: Proceed with caution');
                // toastr()->info('Info: Here is some information');

                // print_r($product->toArray());exit;
                break;
        }
        return redirect()->route('products.home');
    }
    
    public function edit($id){
        $d_id = base64_decode($id);
        // print_r($d_id);exit;
        $title = 'Update';
        $data1 = Country::get();
        $info = Product::where('id',$d_id)->first();
        // $info = Product::find($d_id);
        // print_r($info->toArray());exit;
        return view('products.create_relation_1_to_1', compact('info', 'title', 'data1')); // here I just viewed thw html page of create file but route will be of edit only.
    }

    public function delete($id){
        $decoded_id = base64_decode($id);
        // $info = Product::where('id',$d_id)->delete();

        // Fetch the product information
        $info = Product::where('id',$decoded_id)->first();

        // print_r($info->toArray());exit;

        // code to delete photo from the folder
        $img = public_path('products/'.$info->image);
        if(file_exists($img)){
            unlink($img);
        }

        // Delete the record from the database
        $info->delete();

        return redirect()->route('products.home');
    }

    public function view($id){
        $d_id = base64_decode($id);
        // $info = Product::where('id',$d_id)->first(); // use this when we dont have any relation
        $info = Product::with('country')->where('id',$d_id)->first(); // use this when we have relation
        return view('products.view', compact('info'));
    }
}
