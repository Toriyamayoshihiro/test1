<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' ,
        'brad_namer',
        'description',
        'image',
        'price',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
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
        return $this->hasOne(Sold_item::class);
    }
}
