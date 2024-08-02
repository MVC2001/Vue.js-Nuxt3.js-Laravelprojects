<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smans extends Model
{
    use HasFactory;
     protected $fillable = [
        'fullname',
        'address',
        'contact',
        'gender',
        'role',
        'image',
    ];
}
