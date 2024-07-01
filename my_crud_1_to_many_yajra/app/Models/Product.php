<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name','description','from_date','to_date'];

    // public function hobby(){
    //     return $this->hasOne('App\Models\Hobby', 'id' ,'hobby_id');  // one to one relation
    // }

    public function hobbies(){
        return $this->hasMany('App\Models\HobbyMapping', 'product_id', 'id')->with('hobby');  // one to many relation
    }

    public function country(){
        return $this->hasOne('App\Models\Country', 'id', 'country_id');  // one to one relation
    }

    public function state(){
        return $this->hasOne('App\Models\State', 'id', 'state_id');  // one to one relation
    }

    public function city(){
        return $this->hasOne('App\Models\City', 'id', 'city_id');  // one to one relation
    }

}
