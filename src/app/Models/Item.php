<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' ,
        'brand_name',
        'description',
        'image',
        'price',
        'condition_id',
        'user_id',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likedUsers(){
        return $this->belongsToMany(User::class,'likes','item_id','user_id');
    }
     public function condition()
    {
        return $this->belongsTo(Condition::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sold_item()
    {
        return $this->hasOne(SoldItem::class);
    }
}
