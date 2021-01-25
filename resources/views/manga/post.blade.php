@extends('layouts.bootstrap')

@section('title','記事投稿')


@section('content')
@include('layouts.header_logined')
@include('layouts.message')
  <div class="container">
    <div class="panel panel-default">
    @if(count($errors) > 0)
      <div>
        <ul>
          @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
      <h2 class="panel-heading">記事投稿</h2>
      <div class="panel-body">
        <form  method="post" action="{{ url('/post')}}" enctype="multipart/form-data">
        <!--CSRF対策のセッションに登録されたトークンを送信する-->
          @csrf
          <div class="form-group">
            <label class="control-label">タイトル</label>
            <input class="form-control" type="text" name="title">
          </div>
          <div class="form-group">
            <label class="control-label">カテゴリー</label>
            <select name="category_id" class="form-control">
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->category}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">本文</label>
            <textarea name="content" rows="20" id="textarea1" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">記事画像</label>
            <input type="file" name="image" id="image">
          </div>
          <div class="form-group">
            <label for="approved_at">ステータス: </label>
            <select class="form-control" name="approved_at" id="approved_at">
              <option value="{{config('const.CONTENT_OPEN')}}">公開</option>
              <option value="{{config('const.CONTENT_CLOSE')}}">非公開</option>
            </select>
          </div>
          <button class="btn btn-lg btn-primary">記事投稿</button>
        </form>
      </div>
    </div>
  </div>

@endsection
