@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<img src="{{asset('storage/items/' . $item->image)}}" alt="img" class="purchase_image">
<p class="purchase_item_name">{{$item->name}}</p>
<p class="purchase_item_price">{{$item->price}}</p>

<p>支払方法</p>
<form action="/purchase/{{$item->id}}" method="post">
    @csrf
    <select name="pay">
        <option value="" disabled selected style="display:none;">選択してください</option>
        <option value="pay">コンビニ払い</option>
        <option value="credit">カード支払い</option>
    </select>
<p>配送先</p>
<a href="/purchase/address/{{$item->id}}" class="address_change">変更する</a>
@if(session()->has('purchase_address'))
<input type="text" name="postal_code" value="{{session('purchase_address.postal_code')}}" readonly>
@else
<input type="text " name="postal_code" value="{{$profile->postal_code}}" readonly>
@endif
@if(session()->has('purchase_address'))
<input type="text" name="address" value="{{session('purchase_address.address')}}" readonly>
@else
<input type="text" name="address" value="{{$profile->address}}" readonly>
@endif
@if(session()->has('purchase_address'))
<input type="text" name="building" value="{{session('purchase_address.building')}}" readonly>
@else
<input type="text" name="building" value="{{$profile->building}}" readonly>
@endif
<button type="submit" class="button-purchase">購入する</button>
</form>
@endsection