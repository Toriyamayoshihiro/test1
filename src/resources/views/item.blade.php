@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<form action="/" method="get" >
    <button type="submit" name="tab" value="">おすすめ</button>

    <button type="submit" name="tab" value="mylist">マイリスト</button>
</form>

@if ($products->isEmpty())
    <p>データがありません。</p>
@else
    @foreach($products as $product)
       <a href="/item/{{$product->id}}" class="card">
         <img src="{{asset('storage/items/' . $product->image)}}" alt="img">
         @if($product->sold_item)
           <span>SOLD</span>
         @endif
           <p>{{$product->name}}</p>
       </a>
    @endforeach
@endif
@endsection