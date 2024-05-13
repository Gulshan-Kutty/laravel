<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database3 extends Model
{
    use HasFactory;

    
    protected $connection = 'mysql_third';

    protected $table = 'emp';
}
