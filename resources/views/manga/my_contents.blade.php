@extends('layouts.bootstrap')

@section('title','MY記事')

@section('style')
.close_contents {
  background-color: #dddddd;
}

a.link_border {
  color: black;
  text-decoration: none;
}
@endsection


@section('content')
@include('layouts.header_logined')

@include('layouts.message')
  @if(count($contents) > 0)
  <div class="album py-5 bg-light">
    <div class="container">
    <h1 class="mb-5">MY記事</h1>
      <div class="row">
      @foreach ($contents as $content)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm {{$content->approved_at}} === true ? '' : 'close_contents'); ">
            <a class="link_border" href="{{ url('content_detail', ['id' => $content->id]) }}">
              @if($content->image !== "")
                <img class="card-img-top" src="/uploads/{{$content->image}}" alt="Card image cap">
              @else
                <img class="card-img-top" src="/uploads/マンガトーカー/漫画デフォルト.png" alt="Card image">
              @endif
              <div class="card-body">
                <h4 class="card-text border-bottom text-center">{{$content->title}}</h4>
                <div class="align-items-center">
                    <p>カテゴリー:{{$content->category->category}}</p>
                </div>
                <div><small class="text-muted">{{$content->created_at}}</small></div>
              </div>
            </a>

            <div class="d-flex justify-content-between align-items-center mb-4 col-md-4">
              <div class="btn-group">
                <form method="post" action="{{ url('my_contents', ['id' => $content->id]) }}" class="operation">
                @csrf
                {{ method_field('patch')}}
                  @if ($content->is_approved)
                    <input type="submit" value="公開 → 非公開" class="btn btn-sm btn-secondary">
                    <input type="hidden" name="approved_at" value="{{config('const.CONTENT_CLOSE')}}">
                  @else
                    <input type="submit" value="非公開 → 公開" class="btn btn-sm btn-secondary">
                    <input type="hidden" name="approved_at" value="{{config('const.CONTENT_OPEN')}}">
                  @endif
                </form>

                <form method="post" action="{{ url('my_contents', ['id' => $content->id]) }}">
                @csrf
                {{ method_field('delete') }}
                  <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
                </form>
              </div>
            </div>

          </div>
        </div>
      @endforeach
      </div>

    </div>
  </div>
  @else
    <p>コンテンツはありません。</p>
  @endif

  <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
 @endsection
