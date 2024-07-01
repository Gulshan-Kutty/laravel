<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;

    protected $fillable = [

        'uuid',
        'bot_name',
        'is_active',
        'is_deleted',
        'created_at',
        'updated_at',
        
    ];
}
