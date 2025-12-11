@extends('layout.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<form action="/" method="get" >
    <button type="submit">おすすめ</button>

    <button type="submit" name="tab" value="mylist">マイリスト</button>
</form>

@if ($items->isEmpty())
    <p>データがありません。</p>
@else
    @foreach($items as $item)
    
       <a href="/item/{{$item->id}}" class="card">
         <img src="{{asset('storage/items/' . $item->image)}}" alt="img">
           <p>{{$item->name}}</p>
       </a>
    @endforeach
@endif
@endsection