<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;

class ProductController extends Controller
{
    public function index(){
        
    $data= Product::get();

    foreach($data as $key => $value){
        // code for single select 
        // $country = Country::find($value->country_id);
        // $data[$key]->country_name = $country->country_name;

        // code for multiselect
        $country = Country::whereIn('id',explode(',',$value->country_id))->get();
        // $country= Country::whereIn('id',explode(',','1,2,3'))->get();
        // $country= Country::whereIn('id',[1,2,3])->get();


        // explode(',', $value->country_id): This function splits the comma-separated string stored in $value->country_id into an array of individual country IDs. For example, if $value->country_id is '1,2,3', explode(',', $value->country_id) will result in ['1', '2', '3'].
        // whereIn('id', ...): This method adds a condition to the query, specifying that the id column in the countries table should match any of the IDs in the array obtained from explode(). It effectively filters the countries based on the provided IDs.
        // The whereIn() method used in the query expects an array of values to match against the id column in the database table, hence need to explode here.

        // print_r($country->toArray());exit;
        // print_r(array_column($country->toArray(),'country_name'));exit;

        $data[$key]->country_name = implode(',',array_column($country->toArray(),'country_name'));
        // = implode(',', array_column($country->toArray(), 'country_name')): This assigns a value to the newly created 'country_name' property. The value is obtained by converting the collection of country objects ($country) into an array, extracting the country_name values from each object using array_column(), and then concatenating these country names into a single comma-separated string using implode().
        // When $data[$key]->country_name = ... is executed, it's actually dynamically adding a new property called country_name to each element of the $data array.

    }
    
        return view('products.home', compact('data'));
    }


    public function create(){
        $data1 = Country::get();
        $title = 'Create';
        return view('products.create', compact('title','data1'));
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
                            // $prod->country_id = $request->multi; //  code for single select
                            $prod->country_id = implode(',',$request->multi); // code for multiple select
                            $prod->description = $request->description;
                            $prod->from_date = date('Y-m-d', strtotime($request->from_date));
                            $prod->to_date = date('Y-m-d', strtotime($request->to_date));
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
                // $product->country_id = $request->multi; //  code for single select
                $product->country_id = implode(',',$request->multi); // code for multiselect. It is a common approach when storing multiple selected values into a single string separated by commas in a single database column. 
                $product->description = $request->description;
                $product->from_date = date('Y-m-d', strtotime($request->from_date));
                $product->to_date = date('Y-m-d', strtotime($request->to_date));
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
        return view('products.create', compact('info', 'title', 'data1')); // here I just viewed thw html page of create file but route will be of edit only.
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
        // to fetch single country
        $info = Product::where('id',$d_id)->first();
        // print_r($info->toArray());exit;

        // foreach($info as $key => $value){
        //     $country = Country::whereIn('id',explode(',',$value->country_id))->get();
        //     $info[$key]->country_name = implode(',',array_column($country->toArray(),'country_name'));
        // }
        return view('products.view', compact('info'));
    }
}
