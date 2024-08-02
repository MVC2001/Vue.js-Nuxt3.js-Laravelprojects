<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    protected $table = 'rsleeps';

    protected $fillable = [
        'name',
        'file',
        'index_number',
        'year',
        'status'
    ];
}
