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
use Stripe\StripeClient;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->tab ?? '';
        $keyword = session('keyword');
       if (Auth::check()) {
        if($type==='mylist'){
            
            $query = Auth::user()->likedItems()
                                    ->with('sold_item');
            if($keyword){
                $query->where('name' ,'like', '%' . $keyword . '%');
            }
            $products =  $query->get();
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
         session(['keyword' => $request->keyword]);
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
    public function redirectToStripe(PurchaseRequest $request, $item_id)
    {
    $item = Item::findOrFail($item_id);
    $pay_type = $request->pay;
    session()->put('purchase_address', $request->only(
        'postal_code', 'address', 'building'
    ));

    $stripe = new StripeClient(config('services.stripe.secret'));

    $session = $stripe->checkout->sessions->create([
        'payment_method_types' => [$pay_type],
        'line_items' => [[
            'price_data' => [
                'currency' => 'jpy',
                'unit_amount' => $item->price,
                'product_data' => [
                    'name' => $item->name,
                ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('purchase.success', ['item_id' => $item->id]),
        'cancel_url' => route('purchase.cancel'),
    ]);

    return redirect($session->url);
    }
    
    public function success($item_id)
    {
    $item = Item::find($item_id);
    $user = Auth::user();
    $address = session('purchase_address');
    if (!$address) {
        abort(404);
    }

    SoldItem::create([
        'postal_code' => $address['postal_code'],
        'address'     => $address['address'],
        'building'    => $address['building'],
        'user_id'     => $user->id,
        'item_id'     => $item->id,
    ]);

    session()->forget('purchase_address');

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
    //public function postPurchase(PurchaseRequest $request ,$item_id)
    //{
    //    $item = Item::find($item_id);
    //    $user = Auth::user();
    //    $sold_item = $request->only('postal_code','address','building');
    //    $sold_item['user_id'] = $user->id;
    //    $sold_item['item_id'] = $item->id;
    //    SoldItem::create($sold_item);
    //    return redirect('/');
    //}
}