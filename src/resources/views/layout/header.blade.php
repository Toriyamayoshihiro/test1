
<header>
  <h1 class="header__heading">COACHTECH</h1>
 <div class="header">
    <form class="header__heading" action="/search" method="get">
        <input class="search-form__keyword-input" type="text" name="keyword" placeholder="何をお探しですか" value="{{request('keyword')}}">
        <button type="submit" class="search=button"></button>
    </form>
    <form action="/logout" method="post">
      @csrf
      <button class="header__heading">ログアウト</button>
    </form>
    <a href="/mypage" class="add-button"><span>+</span>マイページ</a>
    <a href="/sell" class="add-button"><span>+</span>出品</a>
 </div>
</header>
  
    
    
      
    