@extends('layouts.login')

@section('content')

<h2></h2>

<div class="content">
  <img class="user-icon post-icon" src="{{ asset('/images/icon1.png') }}" alt="ユーザーアイコン">
  {!! Form::open(['url' => '/top']) !!}
  <div class="form">
    {{ Form::text('post',null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。','method' => 'POST']) }}
    <br>
    <input type="image" class="post-button" src="/images/post.png"></input>
    {!! Form::close() !!}
  </div>
</div>

<div class="post-content">
  @foreach ($posts as $post)
  <div class="post-vertical">
    <div class="left">
      <tr>
        <img class="user-icon-post" src="{{ asset('/images/icon1.png') }}" alt="ユーザーアイコン">
        <td>@if (Auth::check())
          {{ Auth::user()->username }}
          @endif
        </td>
        <br>
        <br>
        <td>{{ $post->post }}</td>
      </tr>
    </div>
    <div class="right">
      <td class="time">{{ $post->created_at }}</td>
      <br>
      <!-- ※※※※※※※※※※※※idを名前と紐づけるかも※※※※※※※※※※※※※※ -->
      <div class="icon">
        <div class="update">
          <a class="update-icon" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img class="edit-icon" src="/images/edit.png" alt="編集ボタン"></a>
          <!-- hrefのリンクいらない？！？！ぽい -->
        </div>
        <div class="hover">
          <a class="trash-icon" href="/top/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
            <img class="trash-icon-hover" src="/images/trash-h.png" alt="削除ボタン">
            <img class="trash-icon-hover" src="/images/trash.png" alt="削除ボタン"></a>
        </div>
      </div>
    </div>
    </tr>
  </div>
  @endforeach

  <!-- モーダルの中身 -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/update" method="post">
        <textarea name="post" class="modal_post"></textarea>
        <input type="hidden" name="id" class="modal_id" value="<?php $post->id ?>">
        <button type=“submit”><img class=“edit-btn” src="/images/edit.png"></button>
        {{ csrf_field() }}
      </form>
      <!-- <a class="js-modal-close" href="">閉じる</a> -->
    </div>
  </div>

</div>


@endsection
