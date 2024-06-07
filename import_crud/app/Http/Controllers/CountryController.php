<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;
use Yajra\DataTables\Facades\Datatables; 
use Excel;

class CountryController extends Controller
{
    public function list(){
        return view('masters.country.list');
    }

    // Yajra Datatables related code
    public function ajax_country(){
        $data = Country::get();
        return Datatables::of($data)  
        ->addIndexColumn()
        ->addColumn('country', function($row){
 
            $test = $row->name; // for one to many relation
            return $test;
        })

        ->rawColumns(['country'])
        ->make(true);

    }

    public function create(){
        $data1 = Country::get();
        return view('masters.country.create', compact('data1'));
    }

    public function store(Request $request){

            $country = new Country; 
            $country->name = ucfirst($request->name);
            $country->save();

        return redirect()->route('countries.list')->withsuccess('Country Created Successfully!');
    }
    

    // public function import(Request $request){

    //     // Get the uploaded file
    //     $file = $request->file('file');

    //     // Get the real path of the uploaded file
    //     // $realPath = $file->getRealPath();
    //     // In this code, we directly pass the uploaded file $file to Excel::toArray() method instead of getting its real path. The Maatwebsite/Excel package handles the file processing internally without needing the real path explicitly.

    //     // Convert Excel data to array
    //     $dataArray = Excel::toArray([], $file)[0]; // [0]: After converting the Excel data to an array, [0] is used to access the first element of the array. In this context, the first element represents the array of data from the first sheet of the Excel file.
      
    //     // array_splice($dataArray, 0, 2); // Remove the first two rows

    //     // dd(count($dataArray[0]));
    //     if(count($dataArray[0]) <= 1 ){
    //         return redirect()->route('countries.list')->withsuccess('The file is empty');

    //     }
    //     else{
    //         array_shift($dataArray); // Remove the first row
    //         if (empty($dataArray[0])) {
    //             // Second row is empty
    //             return redirect()->route('countries.list')->withsuccess('No data found');
    //         } else {
    //             // Second row has data, continue processing
    //             $skipdata = 0;
    //             foreach ($dataArray as $key => $value) {
    //                 if(isset($value[1]) && $value[1] != ''){
    //                     if(preg_match('/^[a-zA-Z]+&/', $value[1])){
    //                         $country = Country::where('name', $value[1])->first();
    //                         if(empty($country) && $country == ''){
    //                             $create = new Country;
    //                             $create->name = ucfirst($value[1]);
    //                             $create->created_at = date('Y-m-d H:i:s');
    //                             $create->updated_at = date('Y-m-d H:i:s');
    //                             if($create->save()){
    //                                 return redirect()->route('countries.list')->withsuccess('Data imported successfully!');
    //                             }
    //                             else{
    //                                 return redirect()->route('countries.list')->withsuccess('No data imported');
    //                             }
    //                         }else{
    //                             $skipdata++;
    //                         }
    //                     }else{
    //                         $skipdata++;
    //                     }

    //                 }else{
    //                     $skipdata++;
    //                 }
    
    //             }
    //             dd($skipdata);
    //         }
    //     }

  
    // }


    //////////
    public function import(Request $request)
{
    // Get the uploaded file
    $file = $request->file('file');

    // Check if file is uploaded
    if (!$file) {
        return redirect()->route('countries.list')->witherror('No file uploaded');
    }

    // Convert Excel data to array
    $dataArray = Excel::toArray([], $file)[0];
    //print_r($dataArray);exit;

    // Check if the array is empty or has insufficient data
    if (empty($dataArray) || count($dataArray[0]) <= 1) {
        return redirect()->route('countries.list')->withinfo('The file is empty or not formatted correctly');
    }

    // Remove the first row (header)
    array_shift($dataArray);

    // Check if the second row is empty
    if (empty($dataArray) || empty($dataArray[0])) {
        return redirect()->route('countries.list')->withinfo('No data found after the header');
    }

    $skipdata = 0;
    $successCount = 0;

    foreach ($dataArray as $key => $value) {
        // Validate that $value[1] exists and is not empty
        if (isset($value[1]) && !empty($value[1])) {
            // Check if the name is alphabetic
            if (preg_match('/^[a-zA-Z]+$/', $value[1])) {
                $country = Country::where('name', $value[1])->first();

                // If country doesn't exist, create a new one
                if (empty($country)) {
                    $create = new Country;
                    $create->name = ucfirst($value[1]);
                    $create->created_at = now();
                    $create->updated_at = now();
                    if ($create->save()) {
                        $successCount++;
                    } else {
                        $skipdata++; // will execute if there might be a problem with the database connection or configuration, preventing the record from being saved.
                    }
                } else {
                    $skipdata++;
                }
            } else {
                $skipdata++;
            }
        } else {
            $skipdata++;
        }
    }

    // Return success message with the count of imported records
    if ($successCount > 0) {
        return redirect()->route('countries.list')->withSuccess("Data imported successfully! Imported: $successCount, Skipped: $skipdata");
    } else {
        return redirect()->route('countries.list')->withinfo("No data imported. Skipped: $skipdata");
    }
}


}
