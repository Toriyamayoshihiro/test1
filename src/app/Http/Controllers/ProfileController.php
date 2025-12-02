<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Item;
use App\Models\Sold_item;



class ProfileController extends Controller
{
     public function profile(Request $request)
    {
        if($request->page==='buy'){
            $items = Sold_item::where('user_id',Auth::user()->id)->get();
        }else{
            $items = Item::where('user_id',Auth::user()->id)->get();
        }
    }
}
