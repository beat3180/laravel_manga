@extends('layouts.bootstrap')

@section('title','カテゴリー・タグ追加')


@section('content')
@include('layouts.header_logined')

@include('layouts.message')


  <div class="container">
    <h1>カテゴリー・タグ追加</h1>
    @if(count($errors) > 0)
      <div>
        <ul>
          @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ url('/category')}}" class="add_item_form col-md-6">
      <div class="form-group">
        @csrf
        <label for="category">カテゴリー: </label>
        <input class="form-control" type="text" name="category" id="category" value="{{old('category')}}">
      </div>

      <input type="submit" value="カテゴリー追加" class="btn btn-primary">
    </form>

      <table class="table table-bordered text-center p-md-3 m-md-3">
        <thead class="thead-light">
          <tr>
            <th>カテゴリー</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td>{{$category->category}}</td>
              <td>
                <form action="{{url('/category', $category->id)}}" method="post">
                  @csrf
                  {{ method_field('delete') }}
                  <input type="submit" value="削除" class="btn btn-danger delete">
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
  </div>
   <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>

  @endsection
