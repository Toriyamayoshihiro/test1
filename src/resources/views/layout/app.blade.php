<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COACHTECH</title>
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  @yield('css')
</head>

<body>
  <header class="site-header">
  <div class="header">
      <h1 class="header__heading">
        <a href="/">COACHTECH</a>
      </h1>
      <form class="header__search" action="/search" method="get">
          <input class="search-form__keyword-input" type="text" name="keyword" placeholder="何をお探しですか" value="{{old('keyword')}}">
          <button type="submit" class="search_button"></button>
      </form>
        <div class="header__actions">
          <form action="/logout" method="post">
              @csrf
              @auth
                <button class="header__link">ログアウト</button>
              @endauth
          </form>
            @guest
              <a class="header__link" href="/login">ログイン</a>
            @endguest
            <a href="/mypage" class="header__link"><span>+</span>マイページ</a>
            <a href="/sell" class="header__button"><span>+</span>出品</a>
        </div>
 </div>
</header>
 @yield('content')
</body>
</html>