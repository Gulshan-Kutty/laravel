<?php

namespace App\Http\Controllers;

use App\Models\{User, City, country, State};
// use App\Models\City;
// use App\Models\country;
// use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Excel;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
    {


        $data = User::with('country', 'state', 'city')->get();

        // $abc=$data->pluck('country.country_name');
        // print_r($abc);exit;

        //->pluck('state.state_name')->pluck('city.city_name')

        // $data = User::with('hobbies')->get();

        foreach ($data as $key) {
            // print_r($key->hobbies->pluck('hobby.name')->implode(','));exit;
        }
        // print_r(($data->pluck('hobbies'))->pluck('hobby'));exit;
        // print_r($data->pluck('hobbies')->toArray());exit;
        // foreach ($data as $key => $value) {
        //    $state=State::whereIn('id',explode(',',$value->state_id))->get();
        //    $city=City::whereIn('id',explode(',',$value->city_id))->get();
        //    $country=country::whereIn('id',explode(',',$value->country_id))->get();
        //    $data[$key]->country_name = implode(',', array_column($country->toArray(), 'country_name'));
        //    $data[$key]->state_name = implode(',', array_column($state->toArray(), 'state_name'));
        //    $data[$key]->city_name = implode(',', array_column($city->toArray(), 'city_name'));
        // }

        // $data=User::get();
        return view('user.index', compact('data'));
    }

    public function create()
    {
        $city = City::get();
        $state = State::get();
        $country = country::get();
        $title = 'create';
        return view('user.create', compact('city', 'title', 'state', 'country'));
    }

    public function update($id)
    {


        $id_data = base64_decode($id);

        // $data = User::get();
        $data = User::where('id', $id_data)->first();
        //     // dd($data->toArray());
        // foreach ($data as $key => $value) {
        //    $state=State::whereIn('id',explode(',',$value->state_id))->first();
        //    $city=City::whereIn('id',explode(',',$value->city_id))->first();
        //    $country=country::whereIn('id',explode(',',$value->country_id))->first();
        //    $data[$key]->country_name = implode(',', array_column($country->toArray(), 'country_name'));
        //    $data[$key]->state_name = implode(',', array_column($state->toArray(), 'state_name'));
        //    $data[$key]->city_name = implode(',', array_column($city->toArray(), 'city_name'));
        // }





        $title = 'update';
        $city = City::get();
        $state = State::get();
        $country = country::get();

        // dd($data->toArray());
        return view('user.create', compact('title', 'data', 'city', 'country', 'state'));
    }




    public function store(Request $request)
    {


        // return response()->json(['res'=>'geted']);
        // print_r($request->all());exit;


        switch ($request->submit) {
            case 'update':
                $request->validate([
                    'name' => 'required|regex:/^([a-zA-Z\s]+)$/',
                    'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                    'mobile' => 'required|regex:/^[7-9][0-9]{9}$/',
                    'status' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'gender' => 'required',
                    'city' => 'required',
                    'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
                ]);
                $user = User::where('id', $request->id)->first();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->city_id = implode(',', $request->city);
                $user->country_id = implode(',', $request->country);
                $user->state_id = implode(',', $request->state);
                $user->status = $request->status;
                $user->gender = $request->gender;
                $user->updated_at = date('Y-m-d H:i:s');

                if ($request->hasFile('image')) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('users'), $imageName);

                    $user->image = $imageName;
                }
                // if($user->image){
                //     unlink(public_path('users/'.$user->image));
                // }
                $user->updated_at = date('Y-m-d H:i:s');

                $user->save();
                return back()->withsuccess('user updated..!!');

                break;

            default:
                $request->validate([
                    'name' => 'required|regex:/^([a-zA-Z\s]+)$/',
                    'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                    'mobile' => 'required|regex:/^[7-9][0-9]{9}$/',
                    'status' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'gender' => 'required',
                    'city' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
                ]);
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile = $request->mobile;
                $user->city_id = implode(',', $request->city);
                $user->country_id = implode(',', $request->country);
                $user->state_id = implode(',', $request->state);
                $user->status = $request->status;
                $user->gender = $request->gender;

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('users'), $imageName);
                $user->image = $imageName;

                $user->save();
                return back()->withsuccess('user created..!!');
                break;
        }
    }

    public function show($id)
    {

        $id_data = base64_decode($id);


        //  $data = User::get();
        $cdata = User::where('id', $id_data)->get();
        foreach ($cdata as $key => $value) {
            $state = State::whereIn('id', explode(',', $value->state_id))->get();
            $city = City::whereIn('id', explode(',', $value->city_id))->get();
            $country = country::whereIn('id', explode(',', $value->country_id))->get();
            $cdata[$key]->country_name = implode(',', array_column($country->toArray(), 'country_name'));
            $cdata[$key]->state_name = implode(',', array_column($state->toArray(), 'state_name'));
            $cdata[$key]->city_name = implode(',', array_column($city->toArray(), 'city_name'));
        }

        // dd($cdata->toArray());




        //    $cdata=User::where('id',$id_data)->get();

        return view('user.show', compact('cdata'));
    }

    public function distroy($id)
    {
        $id_data = base64_decode($id);

        $data = User::where('id', $id_data)->first();

        $delete = public_path('users/' . $data->image);
        // dd($delete);
        if (file_exists($delete)) {
            unlink($delete);
        }
        $data = User::where('id', $id_data)->delete();
        return back()->withsuccess('user deleted..!!');
    }

    public function yajra()
    {

        $data = User::get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $test = '<a href="' . route('user.show', base64_encode($row->id)) . '" class="btn btn-primary btn-sm mb-1"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;<a href="' . route('user.update', base64_encode($row->id)) . '" class="btn btn-success btn-sm mb-1" ><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp<a href="' . route('user.delete', base64_encode($row->id)) . '" class="btn btn-danger btn-sm mb-1" onclick=return confirm("Want to delete this country??") ><i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp';
                return $test;
            })
            ->addColumn('country', function ($row) {
                // $country=country::whereIn('id',explode(',',$row->country_id))->get();
                // $test = implode(',', array_column($country->toArray(), 'country_name'));

                $test = $row->country->country_name;
                return $test;
            })
            ->addColumn('state', function ($row) {
                // $country=State::whereIn('id',explode(',',$row->state_id))->get();
                // $test = implode(',', array_column($country->toArray(), 'state_name'));

                $test = $row->state->state_name;
                return $test;
            })
            ->addColumn('city', function ($row) {
                // $country=City::whereIn('id',explode(',',$row->city_id))->get();
                // $test = implode(',', array_column($country->toArray(), 'city_name'));

                $test = $row->city->city_name;
                return $test;
            })
            ->addColumn('image', function ($row) {
                $test = '<img src=' . url("public/users/" . $row->image) . ' class="rounded-circle" width="50" height="50" />';
                return $test;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }




    //    public function ajax(){



    //     $data = User::get();
    //     // dd($data->toArray());
    //     foreach ($data as $key => $value) {
    //        $state=State::whereIn('id',explode(',',$value->state_id))->get();
    //        $city=City::whereIn('id',explode(',',$value->city_id))->get();
    //        $country=country::whereIn('id',explode(',',$value->country_id))->get();
    //        $data[$key]->country_name = implode(',', array_column($country->toArray(), 'country_name'));
    //        $data[$key]->state_name = implode(',', array_column($state->toArray(), 'state_name'));
    //        $data[$key]->city_name = implode(',', array_column($city->toArray(), 'city_name'));
    //     }

    //     return view('user.ajax_create',compact('data'));
    //    }







        // public function export(){
        // //   dd($date);exit;
        //     return Excel::download(new UserExport,'user.xlsx');
        // }
        
        public function export_d(Request $request){
                return Excel::download(new UserExport($request->from,$request->to),'user.xlsx');
            }

        public function import(Request $request){

            // validation
            Excel::import(new UserImport,$request->file('file'));
            return back()->withsuccess('Data inserted....');
        }

        public function pdf(){
            $users=[
                'title'=>'User Data pdf',
                'date'=>date('m/d/Y'),
                'users'=>User::get(),
            ];
            // dd($users);
            $pdf = Pdf::loadView('user.pdf', $users);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('user_data.pdf');
            // return back()->withsuccess('PDf Downloaded....');

        }
        

}
