@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection
<script src="{{ asset('js/like.js') }}"></script>
@section('content')
<img src="{{asset('storage/items/' . $item->image)}}" name="image" alt="img">
<p class="item-name">{{$item->name}}</p>
<p clsass="item-brand">{{$item->brand_name}}</p>
<p class="item-price">￥{{$item->price}}</p>
<form action="/item/{{$item->id}}/like" method="post">
  @csrf
<button 
id="like-btn"
data-item-id="{{$item->id}}"
class="heart{{$isLiked ? 'liked' : '' }}">
♡
</button>
</form>
<p>{{$item->likedUsers->count()}}</p>
<p>💬</p>
<p>{{$item->comments->count()}}</p>
@if($item->user_id !== $user->id)
 <a href="/purchase/{{$item->id}}" class="add-button">
  <span>購入手続きへ</span>
</a>
@endif
 <span class="form__label--item">商品説明</span>
 <p>{{$item->description}}</p>
 <span class="form__label--item">商品の情報</span>
  <p>カテゴリー</p>
  @foreach($item->categories as $category)
  {{$category->name}}
  @endforeach
  <p>商品の情報</p> 
  
  {{$item->condition->name}}
  
  <p>コメント({{$item->comments->count()}})</p>
  @foreach($comments as $comment)
  <p>{{$comment->user->name}}</p>
  @endforeach

  @foreach($item->comments as $comment)
  <p>{{$comment->content}}</p>
  @endforeach

  <form action="/item/{{$item->id}}/add" method="post">
    @csrf
     <label for="add_comment"class="form__label--item">商品へのコメント</label>
     <input type="text" name="comment" value="{{ old('content') }}" id="add_comment">
     <input type="hidden" name="id" value="{{$item->id}}">
     <button type="submit" class="button-comment">コメントを送信する</button>
  </form>
  @endsection