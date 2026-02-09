@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="site__content">
        <form class="tab" action="/" method="get" >
            <button class="tab__item" type="submit" name="tab" value="">おすすめ</button>

            <button class="tab__item" type="submit" name="tab" value="mylist">マイリスト</button>
        </form>
    <div class="items">
        @if ($products->isEmpty())
            <p class="no_data">データがありません。</p>
        @else
            @foreach($products as $product)
            <a href="/item/{{$product->id}}" class="card">
                <div class="card__image">
                    <img src="{{asset('storage/items/' . $product->image)}}" alt="img">
                    @if($product->sold_item)
                        <span class="sold" >SOLD</span>
                    @endif
                </div>
                <p class="items_name">{{$product->name}}</p>
            </a>
            @endforeach
        @endif
    </div>    
</div>
@endsection