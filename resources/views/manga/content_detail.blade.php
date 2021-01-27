@extends('layouts.bootstrap')

@section('title','記事詳細')

@section('style')
img{
  height: 250px;
}

.close_contents {
  background-color: #dddddd;
}
@endsection


@section('content')
@include('layouts.header_logined')

@include('layouts.message')
<div class="<?php print (is_open($contents) ? '' : 'close_contents'); ?>">
  <div class="container">
    <div class="position-relative overflow-hidden p-3 p-md-1 m-md-1 text-center bg-light">
        @if($content->image !== "")
          <img src="/uploads/{{$content->image}}" alt="Card image cap">
        @else
          <img src="/uploads/漫画デフォルト.png" alt="Card image">
        @endif
    </div>

      <div class="row d-flex">
        <div class="col-sm-5 ml-4">
          <div class="d-flex">
            <p class="my-auto"><?php print h($contents['name']); ?></p>

            <?php if(is_person_user_contents($user,$contents['user_id']) || is_admin($user)){ ?>
            <div class="d-flex justify-content-between align-items-center col-md-4">
              <div class="btn-group">
                <form method="post" action="contents_change_status.php" class="operation">
                  <?php if(is_open($contents) === true){ ?>
                    <input type="submit" value="公開 → 非公開" class="btn btn-sm btn-secondary">
                    <input type="hidden" name="changes_to" value="close">
                  <?php } else { ?>
                    <input type="submit" value="非公開 → 公開" class="btn btn-sm btn-secondary">
                    <input type="hidden" name="changes_to" value="open">
                  <?php } ?>
                  <input type="hidden" name="contents_id" value="<?php print($contents['contents_id']); ?>">
                  <input type="hidden" name="contents_detail_change_status" value="contents_detail_change_status">
                  <!--CSRF対策のセッションに登録されたトークンを送信する-->
                  <input type="hidden" name="csrf" value="<?php print($token); ?>">
                </form>

                <form method="post" action="contents_delete.php">
                  <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
                  <input type="hidden" name="contents_id" value="<?php print($contents['contents_id']); ?>">
                  <!--CSRF対策のセッションに登録されたトークンを送信する-->
                  <input type="hidden" name="csrf" value="<?php print($token); ?>">
                </form>
              </div>
            </div>
            <?php } ?>
          </div>

          <div class="border py-2 rounded-pill text-center bg-warning">
            <h5><?php print h($contents['category']); ?></h5>
          </div>
        </div>

        <small class="ml-auto">投稿日時:<?php print h($contents['created_datetime']); ?></small>

      </div>
  </div>



  <div class=" container py-4">
    <div class="text-center">
      <h1 class="font-weight-normal py-4" style="border-bottom: 5px solid;"><?php print h($contents['title']); ?></h1>
      <h4 class="text-left py-3 pb-5 mb-5" style="border-bottom: 3px solid; white-space:pre-wrap;"><?php print h($contents['contents']); ?></h4>
    </div>
    <h5 class="">コメント</h5>
    <div class="list-group">
      <?php foreach($comments as $comment){ ?>
      <div class="list-group-item" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
          <p class="mb-1"><?php print h(($comment['name'])); ?></p>
          <small><?php print h(($comment['create_datetime'])); ?></small>
        </div>
        <h6 class="my-4 ml-4" style="white-space:pre-wrap;"><?php print h(($comment['comment'])); ?></h6>
        <?php if(is_person_user_comment($user,$comment['user_id']) || is_admin($user)){ ?>
        <form method="post" action="comment_delete.php">
          <input type="submit" value="削除" class="btn btn-sm btn-danger delete">
          <input type="hidden" name="comment_id" value="<?php print($comment['comment_id']); ?>">
          <input type="hidden" name="contents_id" value="<?php print($contents['contents_id']); ?>">
          <!--CSRF対策のセッションに登録されたトークンを送信する-->
          <input type="hidden" name="csrf" value="<?php print($token); ?>">
        </form>
        <?php } ?>
      </div>
      <?php } ?>

      <form method="post" action="comment_insert.php">
        <div class="mt-5">
          <label for="comment" class="form-label">コメント投稿</label>
          <textarea name="comment" rows="5" id="comment" class="form-control"></textarea>
        </div>
        <input type="hidden" name="contents_id" value="<?php print($contents['contents_id']); ?>">
        <!--CSRF対策のセッションに登録されたトークンを送信する-->
        <input type="hidden" name="csrf" value="<?php print($token); ?>">
        <button type="submit" class="btn btn-primary my-3">コメントを投稿する</button>
      </form>
    </div>

  </div>


  <!--jQuery、$('.delete')で要素を特定、confirmでダイアログを開く-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>

</div>

@endsection
