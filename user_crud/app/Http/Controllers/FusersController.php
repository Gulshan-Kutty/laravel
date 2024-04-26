<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fusers;
use App\Models\Country;
use App\Models\State;
use App\Models\Hobby;
use App\Models\City;
// use Illuminate\Support\Facades\Storage;

class FusersController extends Controller
{
    public function index(){
        $data = Fusers::get();
        // print_r($data->toArray());exit;
        // $test = Hobby::get();
        // $data= Fusers::with('country:id,name','hobbies')->where('id','13')->first();
        // print_r($data->country->name);exit;
// exit;
// $test = new Fusers;
// $test = $test->test();
// print_r($data->toArray());exit;
    
    foreach($data as $key => $value){
        $country = Country::find($value->country_id); // Fetch country by its ID
        $state = State::find($value->state_id); // Fetch state by its ID
        $city = City::find($value->city_id); // Fetch city by its ID
   
        $data[$key]->country_name = $country->name;
        $data[$key]->state_name = $state->name;
        $data[$key]->city_name = $city->name;
        // print_r($data->toArray());exit;

    }

    return view('users.home', compact('data'));
    }

    public function create(){
        $countries = Country::get(['name','id']); // why to fetch all fields unnecessarily, just fetch the fields which are needed.
        // print_r($countries->toArray());        
        $title = 'Create';
        return view('users.create', compact('title','countries'));
    }

    public function fetch_state(Request $request){
        $states = State::select('name','id')->where('country_id', $request->country_id)->orderBy('name','desc')->get();

        $html = '<option value="">Select State</option>';
        foreach ($states as $row) {
            $html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        // echo $html;
        return response()->json(['html' => $html]);
        // return response()->json(['states'=> $states]);

    }

    public function fetch_city(Request $request){
        $cities = City::where('state_id', $request->state_id)->get(['name','id']);
        return response()->json(['cities'=> $cities]);
    }

    public function store(Request $request){
        print_r($request->all());exit;

        switch ($request->button) {
            case 'Update':
                $user = Fusers::find($request->id); // OR // $user = Product::where('id',$request->id)->first();
                // print_r($user->toArray());
                // print_r($request->all());exit;
                if ($user) {
                    // print_r($user->image);exit;
                    $user->name = $request->name;
                    // $user->country_id = $request->multi;
                    $user->country_id = implode(',',$request->multi);
                    $user->description = $request->description;
                    $user->from_date = $request->from_date;
                    $user->to_date = $request->to_date;
                    if ($request->hasFile('image')) {
                        $imageName = time().'.'.$request->image->extension();
                        $request->image->move(public_path('users'),$imageName);
                        if ($user->image) {
                            unlink(public_path('users/'.$user->image));
                        }
                        $user->image = $imageName;
                    }
                    $user->updated_at = now();
                    $user->save();
                    toastr()->success('Product Updated Successfully!', 'Hurray...');

                } else {
                    // Handle case where product with given ID is not found
                }
                break;

        
            default:
                // Validate incoming request data
                // $request->validate([
                // 'name' => 'required',
                // 'address' => 'required',
                // 'email' => 'required',
                // 'mob_no' => 'required',
                // 'dob' => 'required',
                // 'gender' => 'required',
                // 'country' => 'required',
                // 'state' => 'required',
                // 'city' => 'required',
                // 'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
                //     // Add validation rules for other fields here
                // ]);

                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('users'),$imageName);

                // Create a new Fuser instance
                $fuser = new Fusers;
                $fuser->name = $request->name;
                $fuser->address = $request->address;
                $fuser->email = $request->email;
                $fuser->mob = $request->mob;
                $fuser->dob = $request->dob;
                $fuser->gender = $request->gender;
                $fuser->country_id = $request->country;
                $fuser->state_id = $request->state;
                $fuser->city_id = $request->city;
                $fuser->image = $imageName;
                $fuser->save();                    
                // print_r($fuser);
                break;
                
        }
            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'User created successfully']);
    }
    
    public function edit($id){
        $d_id = base64_decode($id);
        // print_r($d_id);exit;
        $title = 'Update';
        $data1 = Country::get();
        $info = Fusers::where('id',$d_id)->first();
        // $info = Fusers::find($d_id);
        // print_r($info->toArray());exit;
        return view('users.create', compact('info', 'title', 'data1')); // here I just viewed thw html page of create file but route will be of edit only.
    }

    public function delete($id){
        $decoded_id = base64_decode($id);
        // $info = Fusers::where('id',$d_id)->delete();

        // Fetch the product information
        $info = Fusers::where('id',$decoded_id)->first();

        // print_r($info->toArray());exit;

        // code to delete photo from the folder
        $img = public_path('users/'.$info->image);
        if(file_exists($img)){
            unlink($img);
        }

        // Delete the record from the database
        $info->delete();

        return redirect()->route('users.home');
    }

    public function view($id){
        $d_id = base64_decode($id);
        $info = Fusers::where('id',$d_id)->first();
        return view('users.view', compact('info'));
    }
}
