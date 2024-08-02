<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'index_number', 'year', 'clearance_form',
    ];
}
