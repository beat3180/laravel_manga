@extends('layouts.bootstrap')

@section('title','コメント一覧・管理')

@section('content')
@include('layouts.header_logined')

@include('layouts.message')

  <div class="container">
    <h1 class="my-4">コメント一覧・管理</h1>



      <!--$contentsに一つ以上値が入っていた場合は表示される-->
    @if(count($comments) > 0)
      <table class="table table-bordered text-center p-md-3 m-md-3">
        <thead class="thead-light">
          <tr>
            <th>操作</th>
            <th>コメントID</th>
            <th>コメント</th>
            <th>ユーザー名</th>
            <th>コンテンツID</th>
            <th>投稿日時</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($comments as $comment)
          <tr>
            <td>
              <form method="post" action="{{ url('admincomment', ['id' => $comment->id]) }}">
              @csrf
              {{ method_field('delete') }}
                <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
              </form>

              <form action="{{ url('content_detail', ['id' => $comment->content_id]) }}">
               <input type="submit" value="記事詳細へ" class="btn btn-sm btn-primary">
              </form>

            </td>
            <td>{{$comment->id}}</td>
            <td>{{$comment->comment}}</td>
            @if($comment->user_id === null)
              <td>{{$comment->admin->name}}</td>
            @elseif($comment->admin_id === null)
              <td>{{$comment->user->name}}</td>
            @endif
            <td>{{$comment->content_id}}</td>
            <td>{{$comment->created_at}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!--$categoryに何も値が入っていない場合-->
    @else
      <p>コメントはありません。</p>
    @endif
  </div>
   <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
@endsection
