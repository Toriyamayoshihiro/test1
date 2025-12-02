<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Sold_item;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function index(Request $request)
    {
       if (Auth::check()) {
        if($request->tab==='mylist'){
            $items = Item::where('user_id',Auth::user()->id)->get();
        }else{
            $items = Item::where('user_id','!=',Auth::user()->id)->get();
        }
       }elseif($request->tab==='mylist'){
        return redirect()->route('login');
       }else{
         $items = Item::all();
       }
       return view('item',compact('items'));
    }
    public function detail($item_id)   
    {
        $item = Item::with('categories','condition','likes','comments')->find($item_id);
        return view('detail',compact('item'));
    }
    public function search(Request $request)
    {
         $query = Item::query();
         if(!empty($request->keyword)) {
            $query->where('name' ,'like', '%' . $request->keyword . '%');
            }
         $items = $query->all();   
         return view('item',compact('items'));
    }
    public function addComment(Request $request ,$item_id)
    {
        $commtent = $request->comment;
    }
   
}