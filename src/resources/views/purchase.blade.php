@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
  <form action="/purchase/{{$item->id}}/stripe" method="post" class="purchase__form">
  @csrf
  <div class="purchase__left">
    <div class="purchase__item">
      <img src="{{asset('storage/items/' . $item->image)}}" alt="img" class="purchase_image">
      <p class="purchase_item_name">{{$item->name}}</p>
      <p class="purchase_item_price">￥{{$item->price}}</p>
    </div>

    <div class="purchase__section">
      <p class="purchase__label">支払方法</p>
        <select id="pay-select" name="pay" class="purchase__select">
          <option value="" disabled selected style="display:none;">選択してください</option>
          <option value="konbini">コンビニ払い</option>
          <option value="card">カード支払い</option>
        </select>
        <div class="form__error">
          @error('pay')
            {{ $message }}
          @enderror
        </div>
    </div>

    <div class="purchase__address">
      <div class="purchase__address-head">
        <p class="purchase__label">配送先</p>
        <a href="/purchase/address/{{$item->id}}" class="address_change">変更する</a>
      </div>

      <input type="text" name="postal_code"
        value="{{ session()->has('purchase_address') ? session('purchase_address.postal_code') : $profile->postal_code }}"
        readonly class="purchase__input">

      <input type="text" name="address"
        value="{{ session()->has('purchase_address') ? session('purchase_address.address') : $profile->address }}"
        readonly class="purchase__input">

      <input type="text" name="building"
        value="{{ session()->has('purchase_address') ? session('purchase_address.building') : $profile->building }}"
        readonly class="purchase__input">
    </div>
  </div>

  <div class="purchase__right">
    <div class="summary">
      <table>
        <tr>
          <th>商品代金 ¥<span id="summary-price">{{ number_format($item->price) }}</span></th>
        </tr>
        <tr>
          <th>支払い方法：<span id="summary-pay">未選択</span></th>
        </tr>
      </table>
    </div>

    <button type="submit" class="button-purchase">購入する</button>
  </div>
  </form>
</div>
<script src="{{asset('js/pay-select.js')}}"></script>
@endsection