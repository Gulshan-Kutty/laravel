<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'mysql';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'country_id',
        'state_id',
        'city_id',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hobbies(){
        return $this->hasMany('App\Models\Hobby_mapping','user_id','id')->with('hobby');
    }

    
    public function state(){
        return $this->hasOne('App\Models\State','id','state_id');
    }
    public function country(){
        return $this->hasOne('App\Models\country','id','country_id');
    }
    public function city(){
        return $this->hasOne('App\Models\City','id','city_id');
    }
    
}
