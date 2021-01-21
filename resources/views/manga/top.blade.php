@extends('layouts.bootstrap')

@section('title','トップページ')


@section('content')
@include('layouts.header_top')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
  <div class="col-md-5 p-lg-5 mx-auto my-5">
    <h1 class="display-4 font-weight-normal">マンガトーカー</h1>
  </div>
  <div class="product-device shadow-sm d-none d-md-block"></div>
  <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<footer class="container py-5 text-center">
  <p class="lead font-weight-normal">本WEBサービスはポートフォリオとして作成したマンガに特化した記事投稿サイトです。</p>
    <p class="lead font-weight-norma">下記はゲストアカウントですので自由に閲覧してください。</p>
    <a class="btn btn-outline-secondary mx-auto" href="/manga/index">ゲストでログインする</a>
</footer>



@endsection
