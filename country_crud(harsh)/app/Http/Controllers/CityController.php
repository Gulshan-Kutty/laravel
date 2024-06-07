<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\Models\Currency;
use App\Models\country;

class CityController extends Controller
{
   public function index(){

    
    $data = City::get();
    // dd($data->toArray());
    foreach ($data as $key => $value) {
       $state=State::whereIn('id',explode(',',$value->state_id))->get();
       $country=country::whereIn('id',explode(',',$value->country_id))->get();
       $country=country::whereIn('id',explode(',',$value->country_id))->get();
       $data[$key]->country_name = implode(',', array_column($country->toArray(), 'country_name'));
       $data[$key]->state_name = implode(',', array_column($state->toArray(), 'state_name'));
    }
    // dd($country->toArray());
    // $country=DB::table('currencies')->rightjoin('countries','countries.curr_id','=','currencies.id')->get();
    // return view('country.index', compact('country'));


    // $data= City::get();
    return view('city.index',compact('data'));
   }

   public function create(){
    $title='create';
    $state=State::get();
    // $data=Currency::get();
    $country=country::get();
    return view('city.create',compact('title','state','country'));
   }

   public function show($id){

    $id_data=base64_decode($id);
   $data=City::where('id',$id_data)->first();

//    dd($data->toArray());
    return view('city.show',compact('data'));
   }



   public function store(Request $request){
// dd($request->all());
    $request->validate([
        'name' => 'required',
        'status' => 'required',
        'country' => 'required',
        'state' => 'required',
    ]);

         switch ($request->submit) {
            case 'update':
                $city= City::where('id',$request->id)->first();
                $city->city_name=$request->name;
                $city->country_id=implode(',', $request->country);
                $city->state_id=implode(',', $request->state);
                $city->status=$request->status;
                $city->updated_at = date('Y-m-d H:i:s');
                
                $city->save();
                return back()->withsuccess('city updated..!!');

                break;
            
            default:
            $city= new City;
            $city->city_name=$request->name;
            $city->country_id=implode(',', $request->country);
            $city->state_id=implode(',', $request->state);
            $city->status=$request->status;
            $city->save();
            return back()->withsuccess('city created..!!');
                break;
         }

   }

    public function fetchcity(Request $request){

        $sid=$request->post('state_id');

        $city=DB::table('cities')->where('state_id',$sid)->get();
    
        $html='<option value="">Select state </option> ';
    
        foreach($city as $list){
            $html.='<option value="'.$list->id.'"> '.$list->city_name.' </option>';
        }
    echo $html;
    

    }



   public function update($id){
    $id_data=base64_decode($id);
    $title='update';
    $state=State::get();
    $country=country::get();
    $data= city::where('id',$id_data)->first();

    // dd($data->toArray());
    return view('city.create',compact('title','country','data','state'));

   }

   public function distroy($id){
    $id_data=base64_decode($id);
    $data=City::where('id',$id_data)->delete();
    return back()->withsuccess('city deleted..!!');
   }
}
