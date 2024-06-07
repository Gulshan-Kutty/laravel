<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Foundation\Auth\authen as Authenticatable;
class Authen extends Authenticatable
{
    use HasFactory;
    protected $table='auths';
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
