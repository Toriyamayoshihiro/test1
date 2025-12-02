@extends('layouts.app')
@include('layouts.footer')
@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.edit.css') }}">
@endsection

@section('content')
<div class="profile_edit_content">
  <div class="profile_edit__heading">
    <h1>プロフィール設定</h1>
  </div>
  <div class="profile_image">
    @if(!empty($profile))
    <form action="/profile/edit" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
         <img src="{{asset('storage/' . $profile->image)}}">
         <label class="profile_image" for="image">画像を選択する</label>
         <input type="file" name="image" id="image">
    
         <span class="form__label--rofile">ユーザー名</span>
         <input type="text" name="name" value="{{$profile->user->name}}" >
         @error('name')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--rofile">郵便番号</span>
         <input type="text" name="name" value="{{$profile->postal_code}}" >
         @error('postal_code')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--rofile">住所</span>
         <input type="text" name="address" value="{{$profile->address}}">
         @error('address')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--profile">建物名</span>
         <input type="text" name="building" value=""{{$profile->building}}>
         @error('building')
           <p class="error-message">{{ $message }}</p>
         @enderror

         @else
         <form action="/profile/edit" method="post" enctype="multipart/form-data">
          @csrf
          <img src="{{asset('storage/')}}">
         <label class="profile_image" for="image">画像を選択する</label>
         <input type="file" name="image" id="image">
    
         <span class="form__label--rofile">ユーザー名</span>
         <input type="text" name="name" >
         @error('name')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--rofile">郵便番号</span>
         <input type="text" name="name" >
         @error('postal_code')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--rofile">住所</span>
         <input type="text" name="address">
         @error('address')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--profile">建物名</span>
         <input type="text" name="building">
         @error('building')
           <p class="error-message">{{ $message }}</p>
         @enderror

         @endif
         <div class="form__button">
             <button type="submit">更新する</button>
         </div>
    </form>
  </div>