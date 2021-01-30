<header>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="{{config('const.HOME_URL')}}">マンガトーカー</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav col-auto ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{config('const.LOGIN_URL')}}">ログイン</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{config('const.SIGNUP_URL')}}">新規登録</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
