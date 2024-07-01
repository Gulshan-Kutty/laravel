<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\{Hobby,Country,State,City};
use Yajra\DataTables\Facades\Datatables; // DataTables is a jQuery plugin used for enhancing HTML tables by adding features like pagination, sorting, and searching.
use App\Models\HobbyMapping;
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
    // $data = Product::with('hobby')->get(); // for one to one relation
    $data = Product::with('hobbies')->get(); // for one to many relation
    // print_r($data->toArray());exit;
    // foreach ($data as $product) {
    //     $hobbyNames = $product->hobbies->pluck('hobby.hobby_name')->implode(', ');
    //     print_r($hobbyNames);
    // }
    // exit;

        return view('products.home', compact('data'));
    }

    // Yajra Datatables related code
    public function ajax_product(){
        // $data= Product::get();
        // $data = Product::with('hobbies','country','state','city')->get();
        $data = Product::with('hobbies', 'country', 'state', 'city')->orderBy('id', 'desc')->get();
        // By ensuring that the server-side query orders the records as required and not specifying the order property in the DataTables initialization, you can avoid redundant ordering configuration in jQuery(in blade file-home.blade.php). 

        return Datatables::of($data)  // This line starts building a DataTables response using the $data variable retrieved earlier.
        ->addIndexColumn()
        ->addColumn('from_date', function($row){ //  addColumn() is a method used to enhance the DataTables' output by adding custom columns or modifying existing ones before displaying them in the DataTable.
            $test = date('d F Y',strtotime($row->from_date));
            return $test;
        })
        ->addColumn('to_date', function($row){ 
            $test = date('d F Y',strtotime($row->to_date));
            return $test;
        })
        ->addColumn('hobby', function($row){
            // $hobby = Hobby::whereIn('id',explode(',',$row->hobby_id))->get();
            // $test = implode(',',array_column($hobby->toArray(),'hobby_name'));
            // $test = $row->hobby->hobby_name; // for one to one relation
            $test = $row->hobbies->pluck('hobby.hobby_name')->implode(', '); // for one to many relation
            return $test;
            // In short, the $test variable is used to store the processed data retrieved from the row's 'hobby' relationship before returning it as the result of the addColumn() callback function. While it may not be explicitly used elsewhere in the code snippet, its presence ensures clarity and organization of the data processing logic, making the code more understandable and maintainable.The return statement then returns this processed data, which is eventually displayed in the 'hobby' column of the DataTable.
        })
        ->addColumn('country', function($row){ 
            $test = $row->country->country_name;
            return $test;
        })
        ->addColumn('state', function($row){ 
            $test = $row->state->state_name;
            return $test;
        })
        ->addColumn('city', function($row){ 
            $test = $row->city->city_name;
            return $test;
        })
        ->addColumn('gender', function($row){ 
            $test = ucfirst($row->gender);
            return $test;
        })
        ->addColumn('image', function($row){
            $image = '<img src="'.url('public/products/'.$row->image).'" class="rounded-circle" width="50" height="50">';
            // $image = $row->image;
            return $image;
        })
        ->addColumn('action', function($row){
            $edit = '<a href="'.route('products.edit', base64_encode($row->id)) .'" class="btn btn-info btn-sm">Edit</a>';
            $delete = '<a href="'.route('products.delete', base64_encode($row->id)) .'" class="btn btn-danger btn-sm mt-1" onclick="return confirm(\'Do you really want to remove this record?\')">Delete</a>';
            $view = '<a href="'.route('products.view', base64_encode($row->id)) .'" class="btn btn-secondary btn-sm mt-1">View</a>';
            return $edit . ' ' . $delete . ' ' . $view;
        })
        ->addColumn('status', function($row){
            if($row->status == 'active'){
                $test = '<button class="btn btn-success status" name="status" onclick="statusChange(`'.$row->status.'`, `'.$row->id.'`)" id="status" value='.$row->status.' >'.ucfirst($row->status).'</button>';
            }else{
                $test = '<button class="btn btn-danger status" name="status" onclick="statusChange(`'.$row->status.'`, `'.$row->id.'`)" id="status" value='.$row->status.' >'.ucfirst($row->status).'</button>';
            }
            return $test;
        })
        ->rawColumns(['image', 'action','status'])
        // rawColumns in Laravel DataTables is used to specify columns that contain HTML content. Including a column in rawColumns ensures that DataTables renders its content as raw HTML, allowing for buttons, images, links, or other HTML elements to be displayed and interacted with correctly in the table cells. This method helps maintain security by escaping non-HTML content by default, while enabling specific columns to display their content as intended without modification.

        ->make(true);

        // If it's a one-to-one relationship (hasOne), the hobby name might be directly accessed from the related hobby model using $row->hobby->hobby_name.

        // If it's a one-to-many relationship (hasMany), you might use methods like pluck() and implode() to extract and concatenate hobby names from multiple related hobby models.
    }

    public function create(){
        $hobbies = Hobby::get();
        $countries = Country::get();
        // $title = 'Create';
        return view('products.create_main', compact('hobbies','countries'));
        // return view('products.create', compact('data1','countries','state','city','title')); // use this line when we have only one page for both create and update.
    }

    public function store(Request $request){
            $request->validate([
                    'name' => 'required',
                    'email' => 'required|unique:products',
                    'description' => 'required',
                    'from_date' => 'required|date',
                    'to_date' => 'required|date|after:from_date',
                    'gender' => 'required',
                    'status' => 'required',
                    'hobby' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
                    // 'image' => $request->image_base64 ? 'nullable' : 'required|image|max:2048',
                ]);
                
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('products'),$imageName);
                // print_r($request->all());exit;
                $product = new Product; // use keyword 'new' only when creating new user/product.
                $product->name = $request->name;
                $product->email = $request->email;
                $product->description = $request->description;
                $product->from_date = date('Y-m-d', strtotime($request->from_date));
                $product->to_date = date('Y-m-d', strtotime($request->to_date));
                $product->gender = $request->gender;
                $product->country_id = $request->country;
                $product->state_id = $request->state;
                $product->city_id = $request->city;
                $product->status = $request->status;
                $product->image = $imageName;
                // $product->updated_at = now();
                
                $product->save();
                
                $product_id = $product->id; //get latest inserted product id
                
                // dd(print_r($request->hobby));exit;
                foreach ($request->hobby as $key => $value) {
                    // print_r($product_id);
                    // print_r($value);
                    $mapping = new HobbyMapping;
                    $mapping->product_id = $product_id;
                    $mapping->hobby_id = $value;
                    // $mapping->updated_at = now();
                    $mapping->save();
            }

                // toastr()->success('Success Title', 'Success Message');
                // toastr()->success('Product Created Successfully!', 'Hurray...');

                // toastr()->error('Error: Something went wrong');
                // toastr()->warning('Warning: Proceed with caution');
                // toastr()->info('Info: Here is some information');

                // print_r($product->toArray());exit;
            return redirect()->route('products.home')->withsuccess('Product Created Successfully!');
        // return response()->json(['success' => true, 'message' => 'Product created successfully']);

    }

    
    public function edit($id){
        $d_id = base64_decode($id);
        $countries = Country::get();
        $info = Product::with('hobbies')->where('id',$d_id)->first();
        // dd($info->toArray());
        $states = State::where('country_id',$info->country_id)->get();
        $cities = City::where('state_id',$info->state_id)->get();
        $hobbies = Hobby::get();
        $hobby_id = $info->hobbies->pluck('hobby_id')->toArray();  // this $hobby_id call in create page using hold the multiple hobbies in dropdown list

        // $info = Product::where('id',$d_id)->first();
        // $title = 'Update';
        return view('products.update', compact('info', 'hobbies','countries','states','cities','hobby_id')); 
        // return view('products.create', compact('info', 'data1','title')); // use this line when we have only one page for both create and update.

    }

    public function update(Request $request){
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
            'email' => 'required|unique:products,email,' . $request->id,
            // syntax:- 'required|unique:table_name,column_name,except_id',
            'description' => 'required',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after:from_date',
            'gender' => 'required',
            'status' => 'required',
            'hobby' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'image' => 'sometimes|required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
                
        // from '$request' we get form data and from '$prod' we get database data.
        $product = Product::find($request->id); // OR // $prod = Product::where('id',$request->id)->first();
        if ($product) {
            // print_r($product->image);exit;
            $product->name = $request->name;
            $product->email = $request->email;
            $product->description = $request->description;
            $product->from_date = date('Y-m-d', strtotime($request->from_date));
            $product->to_date = date('Y-m-d', strtotime($request->to_date));
            $product->gender = $request->gender;
            $product->country_id = $request->country;
            $product->state_id = $request->state;
            $product->city_id = $request->city;
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
            
            $mapping = HobbyMapping::where('product_id', $request->id)->delete();
            // print_r($mapping->toArray());exit;
            if($mapping){
                foreach ($request->hobby as $value) {
                    $main = new HobbyMapping;
                    $main->product_id = $request->id; 
                    $main->hobby_id = $value;
                    // $main->created_at = now();
                    // print_r($main);exit;
                    $main->save();
                }
            }
            return redirect()->route('products.home')->withsuccess('Product Updated Successfully!');

        } else {
            // Handle case where product with given ID is not found
        }

        // return response()->json(['success' => true, 'message' => 'Product created successfully']);

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

        // Delete the records from product_hobbies_mapping table.
        $info1 = HobbyMapping::where('product_id', $info->id)->delete();


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


        if(strtolower($data[0][1]) == 'hobby'){
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
                        $city = City::where('hobby_name', $value[1])->first();

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


// public function updateStatus(Request $request)
// {
//     // Validate the request
//     $request->validate([
//         'productId' => 'required|exists:products,id',
//         'newStatus' => 'required|in:active,inactive',
//     ]);

//     // Find the product by ID
//     $product = Product::findOrFail($request->productId);

//     // Update the status
//     $product->status = $request->newStatus;
//     $product->save();

//     // Return a success response
//     return response()->json(['success' => true]);
// }

public function updateStatus(Request $request)
{

    if(isset($request->id)){
        if($request->status == 'active'){
            $status = 'inactive';
        }else{
            $status = 'active';
        }
        $model = Product::where('id',$request->id)->first();
        $model->status = $status;
        $model->update();
    }

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

public function fetchState(Request $request){
    $states = State::select('state_name','id')->where('country_id', $request->country_id)->orderBy('state_name','desc')->get();
    return response()->json(['states' => $states]);
}

public function fetchCity(Request $request){
    $cities = City::where('state_id', $request->state_id)->get(['city_name','id']);
    return response()->json(['cities'=> $cities]);
}

}
