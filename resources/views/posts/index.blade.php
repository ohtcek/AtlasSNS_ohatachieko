@extends('layouts.login')

@section('content')

<h2></h2>

@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="content">
  <img class="user-icon2" src=" {{ Storage::url( Auth::user()->images) }}" alt="ユーザーアイコン">
  {!! Form::open(['url' => '/top']) !!}
  <div class="form">
    {{ Form::textarea('post',null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。','method' => 'POST']) }}
    <br>
    <input type="image" class="post-button" src="/images/post.png"></input>
    {!! Form::close() !!}
  </div>
</div>

<div class="post-content">
  @foreach ($posts as $post)
  @if (auth()->user()->isFollowing($post->user_id) or Auth::user()->id == $post->user_id)
  <!-- orで複数のif文を挟める -->
  <div class="post-vertical">
    <div class="left">
      <img class="user-icon-post" src="{{ Storage::url( $post->user->images) }}" alt="ユーザーアイコン">
      <div class="left-name">
        {{ $post->user->username }}
      </div>
    </div>
    <!-- foreachのpost->リレーション Postモデルのuserメソッド->カラム名 -->
    <div class="left-post">
      <td>{!!nl2br ($post->post) !!}</td>
    </div>
    <div class="right">
      <td class="time">{{ $post->created_at->format('Y-m-d h:i') }}</td>
      <br>
      <!-- ※※※※※※※※※※※※idを名前と紐づけるかも※※※※※※※※※※※※※※ -->
      @if (Auth::user()->id == $post->user_id)
      <!-- userテーブルのidとpostテーブルのuser_idが一致すれば、の文 -->
      <div class="icon">
        <div class="update">
          <a class="update-icon" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img class="edit-icon" src="/images/edit.png" alt="編集ボタン"></a>
          <!-- hrefのリンクいらない？！？！ぽい -->
        </div>
        <div class="hover">
          <a class="trash-icon" href="/top/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
            <img class="trash-icon-hover" src="/images/trash.png" alt="削除ボタン">
            <img class="trash-icon-hover" src="/images/trash-h.png" alt="削除ボタン">
          </a>
        </div>
      </div>
      @endif
    </div>
    </tr>
  </div>
  @endif
  @endforeach

  <!-- モーダルの中身 -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/update" method="post">
        <textarea name="post" class="modal_post"></textarea>
        <input type="hidden" name="id" class="modal_id" value="<?php $post->id ?>">
        <br>
        <input class="update-icon-modal" type="image" value="更新" src="/images/edit.png">
        <!-- <button type=“submit”><img class=“edit-btn” src="/images/edit.png"></button> -->
        {{ csrf_field() }}
      </form>
      <!-- <a class="js-modal-close" href="">閉じる</a> -->
    </div>
  </div>

</div>


@endsection
