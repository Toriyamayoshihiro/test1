<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'postal_code' ,
        'address',
        'building',
        'item_id',
        'user_id'
    ];
    public function item(){ 
        return $this->belongsTo(Item::class);
    }
    public function user(){ 
        return $this->belongsTo(User::class);
    }
    
}
