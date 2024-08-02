<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllCarts extends Model
{
    use HasFactory;

 protected $fillable = ['item', 'category', 'price', 'description', 'accountno', 'paymethod', 'amount', 'total'];
}
