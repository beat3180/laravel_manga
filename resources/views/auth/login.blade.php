@extends('layouts.bootstrap')

@section('title','ログイン')

@section('content')
@include('layouts.header_guest')
<div class="container">
    <div class="row justify-content-center p-3 p-md-5 m-md-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($authgroup) ? ucwords($authgroup) : ""}} {{ __('ログイン') }}</div>

                <div class="card-body">
                    @isset($authgroup)
                    <form method="POST" action="{{ url("login/$authgroup") }}">
                    @else
                    <form method="POST" action="{{ route('login') }}">
                    @endisset
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('パスワードとメールアドレスを記憶する') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ログイン') }}
                                </button>

                                @if (Route::has(isset($authgroup) ? $authgroup.'.password.request' : 'password.request'))
                                    <a class="btn btn-link" href="{{ route(isset($authgroup) ? $authgroup.'.password.request' : 'password.request') }}">
                                        {{ __('パスワードを忘れた方') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @isset($authgroup)
        <div class="mt-5 text-center"><a class="link_border" href="/login">userログインへ</a></div>
        <p class="text-center">※メールアドレス:admin@admin　パスワード:adminadmin</p>
    @else
        <div class="mt-5 text-center"><a class="link_border" href="/login/admin">adminログインへ</a></div>
        <p class="text-center">※メールアドレス:user@user　パスワード:useruser</p>
    @endisset
</div>
@endsection
