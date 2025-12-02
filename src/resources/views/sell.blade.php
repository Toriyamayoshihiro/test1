@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
 <div class="sell__heading">
    <h2>商品の出品</h2>
  </div>
  <form method="POST" action="/item/upload" enctype="multipart/form-data">
    @csrf
    <label>商品画像</label>
     <input type="file" class="image" name="item_image">
     @error('image')
        <p class="error-message">{{ $message }}</p>
     @enderror


    <div>
        <p>商品の詳細</p>
    </div>
    <label>カテゴリー</label>
    @foreach($categories as $category)
     <input type="checkbox" name="item_category[]" value="{{$season->id}}" id="category" >
     <label for="category">{{$category->name}}</label>
    @endforeach
    @error('category')
        <p class="error-message">{{ $message }}</p>
    @enderror

<label class="select-label">商品の状態</label>
<select name="condition">
    <option value="">選択してください</option>
    @foreach($conditons as $conditon)
    <option value="{{$condiron->id}}">{{$conditon->name}}</option>
</select>
    @error('condition')
        <p class="error-message">{{ $message }}</p>
    @enderror

<div>
        <p>商品名と説明</p>
    </div>
<label>商品名</label>
<input type="text" class="text name="name">
@error('name')
   <p class="error-message">{{ $message }}</p>
@enderror
<label>ブランド名</label>
<input type="text" class="text name="name">
@error('brand_name')
   <p class="error-message">{{ $message }}</p>
@enderror
<label>商品の説明</label>
<textarea name="description" cols="51" rows="5"></textarea>
@error('description')
  <p class="error-message">{{$message}}</p>
@enderror
<label>販売価格</label>
   <span>￥</span>
   <input type="text" class="text" name="price">
@error('price')
  <p class="error-message">{{$message}}</p>
@enderror

<div class="button-content">
   <button type="submit" class="button-register">出品する</button>
</div>
</form>