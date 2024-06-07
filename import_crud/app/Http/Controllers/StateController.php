<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\State;
use Yajra\DataTables\Facades\Datatables; 
use Excel;

class CountryController extends Controller
{
    public function list(){
        return view('masters.state.list');
    }

    // Yajra Datatables related code
    public function ajax_country(){
        // $data = Country::get();
        $data = State::with('country')->get();
        return Datatables::of($data)  
        ->addIndexColumn()
        ->addColumn('state', function($row){
 
            $test = $row->name; // for one to many relation
            return $test;
        })
        ->addColumn('countryId', function($row){

            $test = $row->country->id; // for one to many relation
            return $test;
        })

        ->rawColumns(['state','countryId'])
        ->make(true);

    }

    public function create(){
        $data1 = Country::get();
        $title = 'Create';
        return view('masters.country.create', compact('title','data1'));
    }

    public function store(Request $request){

            $product = new Product; 
            $product->name = $request->name;
            $product->save();

        return redirect()->route('countries.list')->withsuccess('Product Created Successfully!');
    }
    

    public function import(Request $request){

        $request->validate([
            'file' => 'required',
        ]);


    }

}
