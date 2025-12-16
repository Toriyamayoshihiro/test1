<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Item;
use App\Models\SoldItem;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
     public function profile(Request $request)
    {
        $user = Auth::user();
        $type = $request->page ?? 'sell';

        if($type==='buy'){
            $products = SoldItem::with('item')->where('user_id',$user->id)->get();
        }else{
            $products = Item::where('user_id',$user->id)->get();
        }
        return view('mypage',compact('products','user','type'));
    }
    public function edit(){
         $user = Auth::user();
         $profile = $user->profile;
         if($profile){
                 return view('profile_edit',compact('profile','user')); 
         }return view('profile_edit',compact('user'));
        
    }
    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $dir = 'profiles';
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/' . $dir, $file_name);
        }
            $user = Auth::user();
            $user->name = $request->name;
            $user->save();
            $profile = $user->profile;
            $postal_code = $request->postal_code;
            $address = $request->address;
            $building = $request->building;
            $image = null;
            if(isset($file_name)){
                $image = 'storage/profiles/' . $file_name;
            }
            if($profile){
                $profile->postal_code = $postal_code;
                $profile->address = $address;
                $profile->building = $building;
                $profile->user_id =$user->id;
                $profile->image = $image;
                $profile->save();
                }
                
            else{
                
                   Profile::create([
                    'image' => $image,
                    'user_id' =>$user->id,
                    'postal_code' =>$postal_code,
                    'address' =>$address,
                    'building' =>$building,
                   ]);
            }
            return redirect('/mypage');
        }
    
}
