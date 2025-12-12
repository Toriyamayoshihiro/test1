@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<img src="{{asset(($user->profile->image ?? asset('storage/profiles/noimage.png/'))) }}" name="image" alt="img">
<p class="user-name">{{$user->name}}</p>

<a href="/mypage/profile" class="profile-button">
  <span>プロフィールを編集</span>
</a>

<form action="/mypage" method="get" >
    <button type="submit" name="page" value="sell">出品した商品</button>

    <button type="submit" name="page" value="buy">購入した商品</button>
</form>
@if ($items->isEmpty())
    <p>データがありません。</p>
@else
@foreach($items as $item)
    
       <a href="/item/{{$item->id}}" class="card">
         <img src="{{asset('storage/items/' . $item->image)}}" alt="img">
           <p>{{$item->name}}</p>
       </a>
@endforeach
@endif
@endsection