<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\State;

class StateController extends Controller
{
   public function index(){
    $data= State::get();
    return view('state.index',compact('data'));
   }

   public function create(){
    $title='create';
    return view('state.create',compact('title'));
   }

   public function show($id){

    $id_data=base64_decode($id);
   $data=State::where('id',$id_data)->first();

//    dd($data->toArray());
    return view('state.show',compact('data'));
   }



   public function store(Request $request){
// dd($request->all());
    $request->validate([
        'name' => 'required',
        'status' => 'required',
    ]);

         switch ($request->submit) {
            case 'update':
                $state= State::where('id',$request->id)->first();
                $state->state_name=$request->name;
                $state->status=$request->status;
                $state->updated_at = date('Y-m-d H:i:s');
                
                $state->save();
                return back()->withsuccess('State updated..!!');

                break;
            
            default:
            $state= new State;
            $state->state_name=$request->name;
            $state->country_id=$request->name;
            $state->status=$request->status;
            $state->save();
            return back()->withsuccess('State created..!!');
                break;
         }

   }



   public function fetchstate(Request $request){

    $cid=$request->post('country_id');

    $state=DB::table('states')->where('country_id',$cid)->get();

    $html='<option value="">Select state </option> ';

    foreach($state as $list){
        $html.='<option value="'.$list->id.'"> '.$list->state_name.' </option>';
    }
        echo $html;
   }


   public function update($id){
    $id_data=base64_decode($id);
    $title='update';
    $data= State::where('id',$id_data)->first();
    // dd($id_data);
    return view('state.create',compact('title','data'));

   }

   public function distroy($id){
    $id_data=base64_decode($id);
    $data=State::where('id',$id_data)->delete();
    return back()->withsuccess('State deleted..!!');
   }
}
