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
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ExhibitionRequest;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->tab ?? '';
       if (Auth::check()) {
        if($type==='mylist'){
            
            $products = Auth::user()->likedItems()
                                    ->with('sold_item')->get();
        }else{
            $products = Item::where('user_id','!=',Auth::id())
                              ->with('sold_item')->get();
            
        }
       }elseif($type==='mylist'){
        return redirect()->route('login');
       }else{
         $products = Item::all();
       }
       return view('item',compact('products','type'));
    }
    public function detail($item_id)   
    {
        $item = Item::with('categories','condition','likedUsers','comments')->find($item_id);
        $comments = Comment::with('user')->where('item_id',$item_id)->get();
        $user = Auth::user();
        $isLiked = false;
        if ($user) {
            $isLiked = $user->likedItems()
                            ->whereKey($item_id)
                            ->exists();
        }
        return view('detail',compact('item','comments','user','isLiked'));
    }
    public function search(Request $request)
    {
         $query = Item::query();
         if(!empty($request->keyword)) {
            $query->where('name' ,'like', '%' . $request->keyword . '%');
            }
         $products = $query->get();   
         return view('item',compact('products'));
    }
    public function commentAdd(CommentRequest $request)
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
    public function postPurchase(PurchaseRequest $request ,$item_id)
    {
        $item = Item::find($item_id);
        $user = Auth::user();
        $sold_item = $request->only('postal_code','address','building');
        $sold_item['user_id'] = $user->id;
        $sold_item['item_id'] = $item->id;
        SoldItem::create($sold_item);
        return redirect('/');
    }
    public function sell(){
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell',compact('categories','conditions'));
    }
    public function store(ExhibitionRequest $request)
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
    public function address_store(AddressRequest $request)
    {
        session()->put('purchase_address',[
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $item_id = $request->id;
        return redirect()->route('purchase.item',['item_id' =>$item_id]);
    }
    public function like($item_id)
    {
        $user = Auth::user();
        $isLiked = $user->likedItems()->whereKey($item_id)->exists();
        
        if($isLiked){
            $isLiked = $user->likedItems()->detach($item_id);
        }else {
            $user->likedItems()->attach($item_id);
        }
        return response()->json([
        'liked' => true
        ]);

    }
}