<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby_mapping extends Model
{
    use HasFactory;
    protected $table='user_hobbies_mapping';
    public function hobby(){
        return $this->hasOne('App\Models\Hobby','id','hobby_id');
    }
}
