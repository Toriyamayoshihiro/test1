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
    <p>商品画像</p>
    <label for="item_image">画像を選択する</label>
     <input type="file" class="image" name="image" id="item_image">
     @error('image')
        <p class="error-message">{{ $message }}</p>
     @enderror

    <p>商品の詳細</p>
     <p>カテゴリー</p>
     @foreach($categories as $category)
      <input type="checkbox" name="item_category[]" value="{{$category->id}}" id="{{$category->id}}" >
      <label for="{{$category->id}}">{{$category->name}}</label>
     @endforeach
     @error('item_category')
        <p class="error-message">{{ $message }}</p>
     @enderror

    <p class="select-label">商品の状態</p>
     <select name="condition_id">
      <option value="">選択してください</option>
      @foreach($conditions as $condition)
      <option value="{{$condition->id}}">{{$condition->name}}</option>
      @endforeach
    </select>
    @error('condition_id')
        <p class="error-message">{{ $message }}</p>
    @enderror

    <p>商品名と説明</p>
    <label for="item_name">商品名</label>
     <input type="text" class="text" name="name" id="item_name">
    @error('name')
      <p class="error-message">{{ $message }}</p>
    @enderror
    <label for="brand_name">ブランド名</label>
      <input type="text" class="text" name="brand_name" id="brand_name">
    @error('brand_name')
       <p class="error-message">{{ $message }}</p>
    @enderror
    <label for="description">商品の説明</label>
    <textarea name="description" cols="51" rows="5" id="description"></textarea>
    @error('description')
       <p class="error-message">{{$message}}</p>
    @enderror
    <label for="price">販売価格</label>
       <span>￥</span>
    <input type="text" class="text" name="price" id="price">
    @error('price')
       <p class="error-message">{{$message}}</p>
    @enderror

<div class="button-content">
   <button type="submit" class="button-register">出品する</button>
</div>
</form>
@endsection