<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow():int{
        return 3;
    }
    public function model(array $row)
    { 
        //   dd($row);
        return new Product([
            'name'=>$row[0],
            'description'=>$row[1],
            'from_date'=>$row[2],
            'to_date'=>$row[3],
        ]);
    }
}
