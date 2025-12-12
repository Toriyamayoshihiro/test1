@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<img src="{{asset('storage/items/' . $item->image)}}" name="image" alt="img">
<p class="item-name">{{$item->name}}</p>
<p clsass="item-brand">{{$item->brand_name}}</p>
<p class="item-price">￥{{$item->price}}</p>
<p>{{$item->likes->count()}}</p>
<p>{{$item->comments->count()}}</p>
 <a href="/purchase/{{$item->id}}" class="add-button">
  <span>購入手続きへ</span>
</a>
 <span class="form__label--item">商品説明</span>
 <p>{{$item->description}}</p>
 <span class="form__label--item">商品の情報</span>
  <p>カテゴリー</p>
  @foreach($item->categories as $category)
  {{$category->name}}
  @endforeach
  <p>商品の情報</p> 
  
  {{$item->condition->name}}
  
  <p>コメント({{$item->comments_count}})</p>
  @foreach($item->comments as $comment)
  <p>{{$comment->content}}</p>
  @endforeach

  <form action="/item/{{$item->id}}/add" method="post">
    @csrf
     <label for="add_comment"class="form__label--item">商品へのコメント</label>
     <input type="text" name="comment" value="{{ old('content') }}" id="add_comment">
  </form>
  @endsection