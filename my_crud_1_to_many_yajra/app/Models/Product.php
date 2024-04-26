<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','description','from_date','to_date'];

    // public function country(){
    //     return $this->hasOne('App\Models\Country', 'id' ,'country_id');  // one to one relation
    // }

    public function countries(){
        return $this->hasMany('App\Models\CountryMapping', 'product_id', 'id')->with('country');  // one to one relation
    }

}
