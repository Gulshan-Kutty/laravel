<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Database2 extends Model
{
    use HasFactory;

    protected $connection = 'mysql_second';

    protected $table = 'products';
}
