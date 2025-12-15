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
@if ($products->isEmpty())
    <p>データがありません。</p>
@else
    @if($type==='sell')
        @foreach($products as $product)
            
              <a href="/item/{{$product->id}}" class="card">
                <img src="{{asset('storage/items/' . $product->image)}}" alt="img">
                  <p>{{$product->name}}</p>
              </a>
        @endforeach
    @else
        @foreach($products as $product)
            
              <a href="/item/{{$product->item->id}}" class="card">
                <img src="{{asset('storage/items/' . $product->item->image)}}" alt="img">
                  <p>{{$product->item->name}}</p>
              </a>
        @endforeach
    @endif
@endif


@endsection