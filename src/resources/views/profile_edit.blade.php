@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.edit.css') }}">
@endsection

@section('content')
<div class="profile_edit_content">
  <div class="profile_edit__heading">
    <h1>プロフィール設定</h1>
  </div>
  <div class="profile_image">
    
         <form action="/mypage/profile/edit" method="post" enctype="multipart/form-data">
          @csrf
          
          <img src="{{asset(($user->profile->image ?? asset('storage/profiles/noimage.png/'))) }}" name="image" alt="img">
         <label class="profile_image" for="image">画像を選択する</label>
         <input type="file" name="image" id="image">
    
         <span class="form__label--rofile">ユーザー名</span>
         <input type="text" name="name" value="{{$user->name}}">
         @error('name')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--profile">郵便番号</span>
         <input type="text" name="postal_code" value="{{($profile->postal_code ?? '')}}">
         @error('postal_code')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--profile">住所</span>
         <input type="text" name="address" value="{{($profile->address ?? '')}}">
         @error('address')
           <p class="error-message">{{ $message }}</p>
         @enderror

         <span class="form__label--profile">建物名</span>
         <input type="text" name="building" value="{{($profile->building ?? '')}}">
         @error('building')
           <p class="error-message">{{ $message }}</p>
         @enderror

         
         <div class="form__button">
             <button type="submit">更新する</button>
         </div>
    </form>
  </div>
  
  @endsection