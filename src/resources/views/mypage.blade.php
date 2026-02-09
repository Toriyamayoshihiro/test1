@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage__content">
    <div class="mypage__profile">
        <img src="{{asset(($user->profile->image ?? asset('storage/profiles/noimage.png/'))) }}" name="image" alt="img">
        <p class="user-name">{{$user->name}}</p>
        <a href="/mypage/profile" class="profile-button">
        プロフィールを編集
        </a>
    </div>

<form class="tab" action="/mypage" method="get" >
    <button class="tab__page" type="submit" name="page" value="sell">出品した商品</button>

    <button class="tab__page" type="submit" name="page" value="buy">購入した商品</button>
</form>
<div class="items">
@if ($products->isEmpty())
    <p class="no__data">データがありません。</p>
@else
    @if($type==='sell')
        @foreach($products as $product)
            
              <a href="/item/{{$product->id}}" class="card">
                <div class="card__image">
                    <img src="{{asset('storage/items/' . $product->image)}}" alt="img">
                    <p class="items__name">{{$product->name}}</p>
                </div>
              </a>
        @endforeach
    @else
        @foreach($products as $product)
            
              <a href="/item/{{$product->item->id}}" class="card">
                <div class="card__image">
                    <img src="{{asset('storage/items/' . $product->item->image)}}" alt="img">
                    <p>{{$product->item->name}}</p>
                </div>
              </a>
        @endforeach
    @endif
@endif
</div>
</div>

@endsection