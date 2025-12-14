<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sold_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'postal_code' ,
        'address',
        'building',
        'item_id',
        'user_id'
    ];
}
