<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class DropdownController extends Controller
{
    public function index(){
        $countries = Country::get(['name','id']); // why to fetch all fields unnecessarily, just fetch the fields which are needed.
        // print_r($countries->toArray());
        return view('welcome', compact('countries'));
}
 
    public function fetch_state(Request $request){
        $states = State::select('name','id')->where('country_id', $request->country_id)->orderBy('name','desc')->get();

        $html = '<option value="">Select State</option>';
        foreach ($states as $row) {
            $html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        // echo $html;
        return response()->json(['html' => $html,'status'=>'success']);
        // return response()->json(['states'=> $states]);

        // Following the MVC architecture, the HTML code for rendering the user interface (such as dropdown options) belongs to the View layer. The Controller's responsibility is to retrieve the necessary data from the Model and pass it to the View. By separating concerns in this way:

        // Modularity and Reusability: Views can be reused across different controllers or even different applications, promoting modularity.
        // Maintainability: Separating concerns makes it easier to locate and update specific parts of the application without affecting other areas.
        // Clearer Code Structure: Each component has a well-defined role, leading to a clearer and more understandable codebase.
        // Parallel Development: Developers working on the front end (View) and back end (Controller and Model) can work concurrently without interfering with each other's work.
        // Therefore, placing the HTML code for dropdown options in the View file adheres to the MVC principle and helps maintain a clean separation of concerns within your application.

    }

    public function fetch_city(Request $request){
        $cities = City::where('state_id', $request->state_id)->get(['name','id']);
        return response()->json(['cities'=> $cities]);
    }

}
