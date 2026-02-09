@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/address_edit.css') }}">
@endsection

@section('content')
<h2>住所の変更</h2>
<form action="/purchase/address/{{$item->id}}" method="post">
     @csrf
     <label for="postal_code">郵便番号</label>
      <input type="text" name="postal_code" id="postal_code">
      <div class="form__error">
          @error('postal_code')
          {{ $message }}
          @enderror
        </div>
     <label for="address">住所</label>
      <input type="text" name="address" id="address">
      <div class="form__error">
          @error('address')
          {{ $message }}
          @enderror
        </div>
     <label for="building">建物名</label>
      <input type="text" name="building" id="building">
      <input type="hidden" name="id" value="{{$item->id}}">
      <button type="submit" class="button_change">更新する</button>
</form>
@endsection