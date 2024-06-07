<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;
use Yajra\DataTables\Facades\Datatables; // DataTables is a jQuery plugin used for enhancing HTML tables by adding features like pagination, sorting, and searching.
use App\Models\CountryMapping;
use Excel;
use App\Exports\ProductsExport;
// use App\Imports\use App\Imports\ProductsImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use App\Models\Database2;
use App\Models\Database3;



class ProductController extends Controller
{
    public function index(){
    // query without relation   
    // $data= Product::get();

    // query using the relation
    // $data = Product::with('country')->get(); // for one to one relation
    $data = Product::with('countries')->get(); // for one to many relation
    // print_r($data->toArray());exit;
    // foreach ($data as $product) {
    //     $countryNames = $product->countries->pluck('country.country_name')->implode(', ');
    //     print_r($countryNames);
    // }
    // exit;


        return view('products.home', compact('data'));
    }

    // Yajra Datatables related code
    public function ajax_product(){
        // $data= Product::get();
        // $data = Product::with('country')->get();
        $data = Product::with('countries')->get();
        // print_r($data->toArray());exit;
        return Datatables::of($data)  // This line starts building a DataTables response using the $data variable retrieved earlier.
        ->addIndexColumn()
        ->addColumn('from_date', function($row){ //  addColumn() is used to include an existing database column ('from_date') or adding custom column in the DataTable, and the callback function allows you to customize/modify how the data from this field is displayed.
            $test = date('d F Y',strtotime($row->from_date));
            return $test;
        })
        ->addColumn('to_date', function($row){ //  addColumn() is used to include an existing database column ('from_date') or adding custom column in the DataTable, and the callback function allows you to customize/modify how the data from this field is displayed.
            $test = date('d F Y',strtotime($row->to_date));
            return $test;
        })
        ->addColumn('country', function($row){
            // $country = Country::whereIn('id',explode(',',$row->country_id))->get();
            // $test = implode(',',array_column($country->toArray(),'country_name'));
            // $test = $row->country->country_name; // for one to one relation
            $test = $row->countries->pluck('country.country_name')->implode(', '); // for one to many relation
            return $test;
            // In short, the $test variable is used to store the processed data retrieved from the row's 'country' relationship before returning it as the result of the addColumn() callback function. While it may not be explicitly used elsewhere in the code snippet, its presence ensures clarity and organization of the data processing logic, making the code more understandable and maintainable.The return statement then returns this processed data, which is eventually displayed in the 'country' column of the DataTable.
        })
        ->addColumn('image', function($row){
            $image = '<img src="'.url('public/products/'.$row->image).'" class="rounded-circle" width="50" height="50">';
            // $image = $row->image;
            return $image;
        })
        ->addColumn('action', function($row){
            $edit = '<a href="'.route('products.edit', base64_encode($row->id)) .'" class="btn btn-info btn-sm">Edit</a>';
            $delete = '<a href="'.route('products.delete', base64_encode($row->id)) .'" class="btn btn-danger btn-sm" onclick="return confirm(\'Do you really want to remove this record?\')">Delete</a>';
            $view = '<a href="'.route('products.view', base64_encode($row->id)) .'" class="btn btn-secondary btn-sm mt-1">View</a>';
            return $edit . ' ' . $delete . ' ' . $view;
        })
        ->rawColumns(['from_date', 'to_date', 'country', 'action', 'image'])
        ->make(true);

        // If it's a one-to-one relationship (hasOne), the country name might be directly accessed from the related country model using $row->country->country_name.

        // If it's a one-to-many relationship (hasMany), you might use methods like pluck() and implode() to extract and concatenate country names from multiple related country models.
    }

    public function create(){
        $data1 = Country::get();
        $title = 'Create';
        return view('products.create', compact('title','data1'));
    }

    public function store(Request $request){
        switch ($request->button) {
            case 'Update':
                // // different method
                // $validator = Validator::make($request->all(), [
                    //     'name' => 'required|max:255',
                    //     // Add more validation rules as needed
                    // ]);
                    
                    // // Check if validation fails
                    // if ($validator->fails()) {
                        //     // Redirect back with validation errors
                        //     return redirect()->back()->withErrors($validator)->withInput();
                        // }
                        
                        $request->validate([
                            'name' => 'required',
                            'description' => 'required',
                            'from_date' => 'required|date',
                            'to_date' => 'required|date|after:from_date',
                            'gender' => 'required',
                            'status' => 'required',
                            'multi' => 'required',
                            'image' => 'sometimes|required|mimes:jpeg,jpg,png,gif|max:10000'
                        ]);
                        
                        // from '$request' we get form data and from '$prod' we get database data.
                        $product = Product::find($request->id); // OR // $prod = Product::where('id',$request->id)->first();
                        // print_r($product->toArray());exit;
                        // print_r($request->all());exit;
                        if ($product) {
                            // print_r($product->image);exit;
                            $product->name = $request->name;
                            // $product->country_id = $request->multi;
                            $product->description = $request->description;
                            $product->from_date = date('Y-m-d', strtotime($request->from_date));
                            $product->to_date = date('Y-m-d', strtotime($request->to_date));
                            $product->gender = $request->gender;
                            $product->status = $request->status;
                            if ($request->hasFile('image')) {
                                $imageName = time().'.'.$request->image->extension();
                                $request->image->move(public_path('products'),$imageName);
                                if ($product->image) {
                                    unlink(public_path('products/'.$product->image));
                                }
                                $product->image = $imageName;
                            }
                            $product->updated_at = now();
                            $product->save();
                            // print_r($prod->id);exit;
                            
                            $mapping = CountryMapping::where('product_id', $request->id)->delete();
                            // print_r($mapping->toArray());exit;
                            if($mapping){
                                foreach ($request->multi as $value) {
                                    $main = new CountryMapping;
                                    $main->product_id = $request->id; 
                                    $main->country_id = $value;
                                    // $main->created_at = now();
                                    // print_r($main);exit;
                                    $main->save();
                                }
                            }
                            toastr()->success('Product Updated Successfully!', 'Hurray...');

                        } else {
                            // Handle case where product with given ID is not found
                        }
                        break;
                
                        
                        default:
                        // different method
                        // $validator = Validator::make($request->all(), [
                            //     'name' => 'required|max:255',
                            //     // Add more validation rules as needed
                            // ]);
                            
                            // // Check if validation fails
                            // if ($validator->fails()) {
                                //     // Redirect back with validation errors
                                //     return redirect()->back()->withErrors($validator)->withInput();
                                // }
                                
                            $request->validate([
                                    'name' => 'required',
                                    'description' => 'required',
                                    'from_date' => 'required|date',
                                    'to_date' => 'required|date|after:from_date',
                                    'gender' => 'required',
                                    'status' => 'required',
                                    'multi' => 'required',
                                    'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
                                ]);
                                
                                $imageName = time().'.'.$request->image->extension();
                                $request->image->move(public_path('products'),$imageName);
                                // print_r($request->all());exit;
                                $product = new Product; // use keyword 'new' only when creating new user/product.
                                $product->name = $request->name;
                                $product->description = $request->description;
                                $product->from_date = date('Y-m-d', strtotime($request->from_date));
                                $product->to_date = date('Y-m-d', strtotime($request->to_date));
                                $product->gender = $request->gender;
                                $product->status = $request->status;
                                $product->image = $imageName;
                                // $product->updated_at = now();
                                
                                $product->save();
                                
                                $product_id = $product->id; //get latest inserted product id
                                
                                // dd(print_r($request->multi));exit;
                                foreach ($request->multi as $key => $value) {
                                    // print_r($product_id);
                                    // print_r($value);
                                    $mapping = new CountryMapping;
                                    $mapping->product_id = $product_id;
                                    $mapping->country_id = $value;
                                    // $mapping->updated_at = now();
                                    $mapping->save();
                            }

                // toastr()->success('Success Title', 'Success Message');
                // toastr()->success('Product Created Successfully!', 'Hurray...');

                // toastr()->error('Error: Something went wrong');
                // toastr()->warning('Warning: Proceed with caution');
                // toastr()->info('Info: Here is some information');

                // print_r($product->toArray());exit;
                break;
        }
        return redirect()->route('products.home')->withsuccess('Product Created Successfully!');
        // return response()->json(['success' => true, 'message' => 'Product created successfully']);

    }
    
    public function edit($id){
        $d_id = base64_decode($id);
        // print_r($d_id);exit;
        $title = 'Update';
        $data1 = Country::get();
        // $info = Product::where('id',$d_id)->first();
        $info = Product::with('countries')->where('id',$d_id)->first();
        // $info = Product::find($d_id);
        // print_r($info->toArray());exit;
        return view('products.create', compact('info', 'title', 'data1')); // here I just viewed the html page of create file but route will be of edit only.
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

        // Delete the record from the products table.
        $info->delete();

        // Delete the records from product_countries_mapping table.
        $info1 = CountryMapping::where('product_id', $info->id)->delete();


        return redirect()->route('products.home');
    }

    public function view($id){
        $d_id = base64_decode($id);
        $info = Product::where('id',$d_id)->first();
        return view('products.view', compact('info'));
    }

    public function export(Request $request){
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        // return Excel::download(new ProductsExport,'products.xlsx');
        return Excel::download(new ProductsExport($request->from,$request->to),'products.xlsx');

        // return back()->withsuccess('File exported successfully');


    }

    // public function import(Request $request){

    //     $request->validate([
    //         'file' => 'required',
    //     ]);

    //     Excel::import(new ProductsImport,$request->file('file'));
    //     return back()->withsuccess('Data inserted successfully');
    // }

    public function import(Request $request){

        $filePath = $request->file('file')->getRealPath();
        $data = Excel::toArray(null, $filePath)[0];
       
        
        if(empty($data)){
            return redirect()->route('products.home')->with('success', 'The file is empty');
            }

        // Transpose the data array
        $data = array_map(null, ...$data);
        print_r($data);exit;
        // Filter out empty columns
        $data = array_filter($data, function($column){
            if(is_array($column)){
                return !empty(array_filter($column));
            }
        });

        if(!empty($data)){
            // Transpose the data array back
            $data = array_map(null, ...$data);
        }else{
            return redirect()->route('products.home')->with('success', 'The file is empty');
        }
        print_r(count($data[0]));exit;


        if(strtolower($data[0][1]) == 'country'){
            array_shift($data);
        }else{
            return redirect()->route('products.home')->with('success', 'header data not formatted correctly');
        }

        $data = array_filter($data, function($row){
            if(is_array($row)){
                return !empty(array_filter($row));
            }
        });

        if(empty($data)){
            return redirect()->route('products.home')->with('success', 'No data found after the header');
        }else{
            
            $user = Auth::user();
            $skipData = 0;
            $successCount = 0;

            foreach($data as $key => $value){
                if(isset($value[1]) && $value[1] != ''){
                    if(preg_match('/^[a-zA-Z]+$/', $value[1])){
                        $city = City::where('country_name', $value[1])->first();

                        if(empty($city)){
                            $create = new City;
                            $create->city_name = ucwords($value[1]);
                            $create->created_at = date('Y-m-d H:i:s');
                            $create->updated_at = date('Y-m-d H:i:s');
                            if($create->save()){
                                $successCount++;
                            }else{
                                $skipData++;
                            }

                        }else{
                            $skipData++;
                        }

                    }else{
                        $skipData++;
                    }

                }else{
                    $skipData++;
                }
            }
        }

        if($successCount > 0){
            return redirect()->route('products.home')->withsuccess('Data imported successfully');
        }else{
            return redirect()->route('products.home')->withsuccess('No data imported');
        }

    }

    public function pdf(){
        $products=[
            'title'=>'Products data pdf',
            'date'=>date('m/d/Y'),
            'products'=>Product::get(),
        ];
        // dd($users);
        $pdf = Pdf::loadView('products.pdf', $products);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('products_data.pdf');
        // return back()->withsuccess('PDf downloaded successfully');
    }

//     public function updateStatus(Request $request){
//     $productId = $request->input('productId');
//     $status = $request->input('status');

//     $product = Product::find($productId);
//     if (!$product) {
//         return response()->json(['success' => false, 'message' => 'Product not found']);
//     }

//     $product->status = $status;
//     $product->save();

//     return response()->json(['success' => true]);
// }


public function updateStatus(Request $request)
{
    // Validate the request
    $request->validate([
        'productId' => 'required|exists:products,id',
        'newStatus' => 'required|in:active,inactive',
    ]);

    // Find the product by ID
    $product = Product::findOrFail($request->productId);

    // Update the status
    $product->status = $request->newStatus;
    $product->save();

    // Return a success response
    return response()->json(['success' => true]);
}


// functions for 2nd & 3rd database connections
public function database2(){  // direct use this link in the browser: http://localhost/laravel/my_crud_1_to_many_yajra/database2
    $info = Database2::get();
    print_r($info->toArray());
}

public function database3(){  // direct use this link in the browser: http://localhost/laravel/my_crud_1_to_many_yajra/database3
    $info = Database3::get();
    print_r($info->toArray());
}
}
