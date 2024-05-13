<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Mongodb extends Model
{
    use HasFactory;
    protected $collection = 'mongodbs';

    protected $fillable = [
        'name', 'email','address','mobile','password'
    ];

}
