@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail">
  <div class="detail__image">
    <img src="{{asset('storage/items/' . $item->image)}}" name="image" alt="img">
    @if($item->sold_item)
    <span class="sold">SOLD</span>
    @endif
  </div>
  <h2 class="detail__name">{{$item->name}}</h2>
  <p clsass="detail__brand">{{$item->brand_name}}</p>
  <p class="detail__price">￥{{$item->price}}<span class="detail__tax">(税込)</span></p>
<div class="detail__icons">
  <button 
  id="like-btn"
  data-item-id="{{$item->id}}"
  class="detail__icon-btn {{$isLiked ? 'liked' : '' }}">
  <span class="detail__icon">
    ♡
  </span>
  </button>
  <p id="like-count" class="detail__icon-count">{{$item->likedUsers->count()}}</p>

  <p class="detail__comment-icon">💬</p>
  <p class="detail__icon-count">{{$item->comments->count()}}</p>
</div>
  @auth
    @if($item->user_id !== $user->id && !$item->sold_item)
    <a href="/purchase/{{$item->id}}" class="detail__byu-btn">
      購入手続きへ
    </a>
    @endif
  @endauth
  @guest
    <a href="/purchase/{{$item->id}}" class="detail__byu-btn">
      購入手続きへ
    </a>
  @endguest
  <section class="detail__section">
    <h3 class="detail_item_title">商品説明</h3>
    <p class="detail_desc">{{$item->description}}</p>
  </section>
  <section class="detail__section">
    <h3 class="detail_item_title">商品の情報</h3>
      <p class="detail_info-label">カテゴリー</p>
      @foreach($item->categories as $category)
      <span class="detail_pill">
        {{$category->name}}
      </span>
      @endforeach
      <p>商品の状態</p> 
      <div class="detail_info_value">
        {{$item->condition->name}}
      </div>
  </section>
  <section class="detail__section">
    <h3 class="detail_item_titile">コメント({{$item->comments->count()}})</h3>
    <div class="detail__comments">
      @foreach($comments as $comment)
      <div class="detail__comment">
        <div class="detail__user">
          <div class="detail__username">
            <p>{{$comment->user->name}}</p>
          </div>
        </div>
      </div>
      @endforeach
      @foreach($item->comments as $comment)
      <div class="detail__comment-body">
        <p>{{$comment->content}}</p>
      </div>
      @endforeach
   </div>
    <form class="detail__comment-form" action="/item/{{$item->id}}/add" method="post">
      @csrf
      <label for="add_comment"class="detail__form-label">商品へのコメント</label>
      <input class="detail__text" type="text" name="content" value="{{ old('content') }}" id="add_comment">
      <div class="detail__error">
            @error('content')
            {{ $message }}
            @enderror
      </div>
      <input type="hidden" name="id" value="{{$item->id}}">
      <button type="submit" class="detail__comment-btn">コメントを送信する</button>
    </form>
  </section>
  </div>
  <script src="{{ asset('js/likes.js') }}"></script>
  @endsection