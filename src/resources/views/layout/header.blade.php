
<header>
  
 <div class="header">
    <form class="header__heading" action="/search" method="get">
        <input class="search-form__keyword-input" type="text" name="keyword" placeholder="何をお探しですか" value="{{old('keyword')}}">
        <button type="submit" class="search=button"></button>
    </form>
    
    <form action="/logout" method="post">
      @csrf
      @auth
      <button class="header__heading">ログアウト</button>
      @endauth
    </form>
      @guest
        <a class="login__button-submit" href="/login">ログイン</a>
      @endguest
    <a href="/mypage" class="add-button"><span>+</span>マイページ</a>
    <a href="/sell" class="add-button"><span>+</span>出品</a>
 </div>
</header>
  
    
    
      
    