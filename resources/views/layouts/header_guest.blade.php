<header>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="{{config('const.HOME_URL')}}">マンガトーカー</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>

     <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
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
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      @isset($authgroup)
                      {{ Auth::guard($authgroup)->user()->name }} <span class="caret"></span>
                      @else
                      {{ Auth::user()->name }} <span class="caret"></span>
                      @endisset
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('ログアウト') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
      </ul>
    <p style="color: white;">ユーザー名：ゲスト</p>
  </nav>
</header>
