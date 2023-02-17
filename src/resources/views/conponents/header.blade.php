<header class="header">
  <nav class="nav">
    <!-- ログイン後とログイン前で遷移先を変える -->
    @guest
    <div class="nav_left">
      <a href="{{ url('/') }}" class="nav_link"><img class="logo_image" src="{{ asset('images/skelton.png') }}" alt="スケルトン"></a>
      <h1 class="nav_header">目標達成アプリ</h1>
    </div>
    <div class="nav_right">
      <a class="nes-btn nav_btn" href="{{ route('register') }}"><p class="nav_register">{{ __('Register') }}</p></a>
      <a class="nes-btn nav_btn" href="{{ route('login') }}"><p class="nav_login">{{ __('Login') }}</p></a>
    </div>
    @else
    <div class="nav_left">
      <a href="{{ route('goals.index') }}" class="nav_link"><img class="logo_image" src="{{ asset('images/skelton.png') }}" alt="スケルトン"></a>
      <h1 class="nav_header">目標達成アプリ</h1>
      <!-- スマホ用メニューボタン -->
      <img id="menu_sp" src="{{ asset('images/bars_hoso.png') }}" alt="ナビゲーションを開く" onclick="document.getElementById('nav_sp').style.display = 'block'">
      <!-- スマホ用ナビゲーション -->
      <nav id="nav_sp">
        <img id="close" src="{{ asset('images/912_x_h.png') }}" alt="ナビゲーションを閉じる" onclick="document.getElementById('nav_sp').style.display = 'none'">
        <a id="logo_sp" href="{{ route('goals.index') }}" onclick="document.getElementById('nav_sp').style.display = 'none'"><img
            src="{{ asset('images/skelton.png') }}" alt="トップページに戻る" class="logo_image"></a>
        <a class="menu" href="{{route('mypage.edit')}}" onclick="document.getElementById('nav_sp').style.display = 'none'">ユーザー情報編集</a>
        <a class="menu" href="{{route('mypage.edit_password')}}" onclick="document.getElementById('nav_sp').style.display = 'none'">パスワード変更</a>
        <a class="menu" href="{{ route('logout') }}" onclick="document.getElementById('nav_sp').style.display = 'none'; event.preventDefault(); document.getElementById('logout-form').submit()">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      </nav>
    </div>
    <div class="nav_right">
      <!-- メール認証が済んでいない場合は非表示にする -->
      @if(auth()->user()->email_verified_at)
        <!-- goalsテーブルのstatusが0:未達成なら非活性として、1:達成済みならば活性とする -->
        @if($goal_status === 1)
        <a class="nes-btn nav_btn" href="{{ route('goals.create') }}"><p class="nav_goal">目標設定</p></a>
        @else
        <a class="nes-btn nav_btn nav_btn_hidden" href="{{ route('goals.create') }}"><p class="nav_goal">目標設定</p></a>
        @endif
        <a class="nes-btn nav_btn" href="{{ route('mypage') }}"><p class="nav_mypage">マイページ</p></a>
      @endif
    </div>
    @endif
  </nav>
</header>