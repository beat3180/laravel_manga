@if(Auth::guard('admin')->check())
  <header>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
      <a class="navbar-brand mr-auto mr-lg-0" href="{{config('const.HOME_URL')}}">マンガトーカー</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav col-auto ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">管理</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="/manga/admin_contents">記事一覧・管理</a>
              <a class="dropdown-item" href="/manga/create">カテゴリー追加・管理</a>
              <a class="dropdown-item" href="/manga/admin_comment">コメント一覧・管理</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/manga/my_contents">MY記事</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/manga/post">記事投稿</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{ route('logout') }} onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              ログアウト
            </a>
            <form id='logout-form' action={{ route('logout')}} method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
      <p style="color: white;">
        ユーザー名:{{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
      </p>
    </nav>
  </header>

@elseif(Auth::check())
  <header>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
      <a class="navbar-brand mr-auto mr-lg-0" href="{{config('const.HOME_URL')}}">マンガトーカー</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav col-auto ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/manga/my_contents">MY記事</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/manga/post">記事投稿</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href={{ route('logout') }} onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              ログアウト
            </a>
            <form id='logout-form' action={{ route('logout')}} method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
      <p style="color: white;">ユーザー名:{{ Auth::user()->name }} <span class="caret"></span></p>
    </nav>
  </header>

@else
  <header>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
      <a class="navbar-brand mr-auto mr-lg-0" href="{{config('const.HOME_URL')}}">マンガトーカー</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav col-auto ml-auto">
          <li class="nav-item">
              @isset($authgroup)
              <a class="nav-link" href="{{ url("login/$authgroup") }}">{{ __('ログイン') }}</a>
              @else
              <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
              @endisset
          </li>
          @isset($authgroup)
          @if (Route::has("$authgroup-register"))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route("$authgroup-register") }}">{{ __('新規登録') }}</a>
              </li>
          @endif
          @else
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
              </li>
          @endif
          @endisset
        </ul>
      </div>
      <p style="color: white;">ユーザー名：ゲスト</p>
    </nav>
  </header>
@endif
