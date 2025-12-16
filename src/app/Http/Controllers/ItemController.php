<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Condition;
use App\Models\Category;
use App\Models\SoldItem;
use App\Models\Profile;
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
        $comments = Comment::where('item_id',$item_id)->get();
        $user = Auth::user();
        return view('detail',compact('item','comments','user'));
    }
    public function search(Request $request)
    {
         $query = Item::query();
         if(!empty($request->keyword)) {
            $query->where('name' ,'like', '%' . $request->keyword . '%');
            }
         $items = $query->get();   
         return view('item',compact('items'));
    }
    public function commentAdd(Request $request)
    {
        $user = Auth::user();
        $comment['content'] = $request->comment;
        $comment['user_id'] = $user->id;
        $comment['item_id'] = $request->id;
        Comment::create($comment);
        return redirect()->route('detail.item',['item_id' =>$request->id]);
    }
    public function purchase($item_id)
    {
        $item = Item::find($item_id);
        $user = User::find(Auth::id());
        $profile = $user->profile;
        return view('purchase',compact('item','profile'));
    }
    public function postPurchase(Request $request ,$item_id)
    {
        $item = Item::find($item_id);
        $user = Auth::user();
        $sold_item = $request->only('postal_code','address','building');
        $sold_item['user_id'] = $user->id;
        $sold_item['item_id'] = $item->id;
        Sold_item::create($sold_item);
        return redirect('/mypage');
    }
    public function sell(){
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell',compact('categories','conditions'));
    }
    public function store(Request $request)
    {
        $dir = 'items';
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        $item_data = $request->only('name','brand_name','description','price','condition_id');
        $item_data['image'] = $file_name;
        $item_data['user_id'] = Auth::user()->id;
        $item=Item::create($item_data);

        $item_categories = $request->input('category_id',[]);
        $item->categories()->attach($item_categories);
        return redirect('/mypage');
    }
    public function address_edit($item_id)
    {
        $item = Item::find($item_id);
        return view('address_edit',compact('item'));
    }   
    public function address_store(Request $request)
    {
        session()->put('purchase_address',[
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $item_id = $request->id;
        return redirect()->route('purchase.item',['item_id' =>$item_id]);
    }

}