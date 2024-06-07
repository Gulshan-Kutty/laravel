<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable=['name','country_id','state_id'];

    public function country(){
        return $this->hasOne('App\Models\Country', 'id' ,'country_id');  // one to one relation
    }

    public function state(){
        return $this->hasOne('App\Models\Country', 'id' ,'state_id');  // one to one relation
    }
}
