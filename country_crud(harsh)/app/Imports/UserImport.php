<?php

namespace App\Imports;

use App\Models\User;
use App\Models\City;
use App\Models\country;
use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UserImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {  
        foreach($row as $key => $value){
        if(!empty($row[$key])){
          $data[$key] = $row[$key];
        }else{
          $count=$key+1;
          dd($count.' column no. found empty'); //your code here
        // return redirect()->route('user.index')->withsuccess('Empty column found....');
        }
      }
      
        $country_id = 0;
        if(isset($row[4]) && $row[4] !=''){
            $country = country::where('country_name',$row[4])->first();
            if($country==null){
              dd('Please check country spelling ='.$row[4]);
            }
            $country_id = $country->id;
        }
        $state_id = 0;
        if(isset($row[5]) && $row[5] !=''){
            $state = State::where('state_name',$row[5])->first();
            if($state==null){
              dd('Please check state spelling ='.$row[5]);
            }
            $state_id = $state->id;
        }
        $city_id = 0;
        if(isset($row[6]) && $row[6] !=''){
            $city = City::where('city_name',$row[6])->first();
            if($city==null){
              dd('Please check city spelling ='.$row[6]);
            }
            $city_id = $city->id;
        }
        return new User([
           'name'=>$row[0],
           'email'=>$row[1],
           'mobile'=>$row[2],
           'gender'=>$row[3],
           'country_id'=>$country_id,
           'state_id'=>$state_id,
           'city_id'=>$city_id,
        ]);
    }
}
