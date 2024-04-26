<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fusers extends Model
{
    use HasFactory;

    public function hobbies()
    {
        return $this->hasMany('App\Models\HobbyMapping','user_id','id')->with('hobby');
    }

    public function country()
    {
        return $this->hasOne('App\Models\Country','id','country_id');
    }

    public function test(){
        print_r('hello');exit;
    }
}
