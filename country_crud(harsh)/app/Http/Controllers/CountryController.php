<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Currency;
use App\Models\State;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
   public function index()
   {
      $country = country::get();
      // dd($country->toArray());
      foreach ($country as $key => $value) {
         $currency = Currency::whereIn('id', explode(',', $value->curr_id))->get();
         $state=State::whereIn('id',explode(',',$value->state_id))->get();
         $country[$key]->currency = implode(',', array_column($currency->toArray(), 'currency'));
         $country[$key]->state_name = implode(',', array_column($state->toArray(), 'state_name'));
      }
      // dd($country->toArray());
      // $country=DB::table('currencies')->rightjoin('countries','countries.curr_id','=','currencies.id')->get();
      return view('country.index', compact('country'));
   }

   public function create()
   {  
      $state=State::get();
      // dd($state->toArray());
      $data = Currency::get();
      $title = 'create';
      return view('country.create', compact('title', 'data','state'));
   }
   public function show($id)
   {

      $id_data = base64_decode($id);
      // dd($id_data);
      $cdata = DB::table('countries')->join('currencies', 'countries.curr_id', '=', 'currencies.id')->where('countries.id', $id_data)->first();

      // $cdata= country::where('c_id',$id_data)->first();
      return view('country.show', compact('cdata'));
   }
   public function store(Request $request)
   {
      // dd($request->all());
      $request->validate([
         'name' => 'required|regex:/^[a-zA-Z\s]+$/',
         'code' => 'required|numeric',
         'status' => 'required',
         'curr' => 'required',
         'state' => 'required'
      ], [
         // we can specify what msg to print on error
         // 'name.regex'=>'the name field should contain only alpha and spaces'
      ]);
      switch ($request->input('submit')) {

         case 'update':
            $country = country::where('id', $request->id)->first();
            $country->country_name = $request->name;
            $country->country_code = $request->code;
            $country->state_id = implode(',', $request->state);
            $country->updated_at = date('Y-m-d H:i:s');
            $country->status = $request->status;
            $country->curr_id = implode(',', $request->curr);
            $country->save();
            return back()->withsuccess('Country updated..!!');
            break;

         default:
            $country = new country;
            $country->country_name = $request->name;
            $country->country_code = $request->code;
            $country->state_id = implode(',', $request->state);
            $country->status = $request->status;
            $country->curr_id = implode(',', $request->curr);
            $country->save();
            return back()->withsuccess('Country created..!!');
            break;
      }
   }
   public function edit($id)
   {
      $title = 'update';
      $id_data = base64_decode($id);
      // $country_data= country::where('id',$id_data)->first();
      $data = Currency::get();
      $state = State::get();
      $country_data = DB::table('currencies')->join('countries', 'countries.curr_id', '=', 'currencies.id')->where('countries.id', $id_data)->first();


      return view('country.create')->with(compact('country_data', 'title', 'data','state'));
   }
   public function distroy($id)
   {
      $id_data = base64_decode($id);
      // dd($id_data);
      $country_data = country::where('id', $id_data)->delete();

      return back()->withsuccess('Country deleted..!!');
   }
}
