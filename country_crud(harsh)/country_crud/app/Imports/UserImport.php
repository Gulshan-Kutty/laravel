<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
           'id'=>$row[0],
           'name'=>$row[1],
           'email'=>$row[2],
           'mobile'=>$row[3],
           'gender'=>$row[4],
           'country_id'=>$row[5],
           'state_id'=>$row[6],
           'city_id'=>$row[7],
           'image'=>$row[8],
           'status'=>$row[9],
           'created_at'=>$row[10],
           'updated_at'=>$row[11],

        ]);
    }
}
