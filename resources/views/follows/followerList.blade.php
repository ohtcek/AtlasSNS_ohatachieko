@extends('layouts.login')

@section('content')

<div class="search-form-contents">
  @foreach($icons as $icon)
  <a href="/follow-list/{{$icon->id}}/profile">
    <img class="user-icon" src="{{ Storage::url( $icon->images) }}" alt="ユーザーアイコン">
  </a>
  @endforeach
</div>

<div class="post-content">
  @foreach ($posts as $post)
  <div class="post-vertical">
    <div class="left">
      <a href="/follow-list/{{$post->user_id}}}/profile">
        <img class="user-icon-post" src="{{ Storage::url( $post->user->images) }}" alt="ユーザーアイコン">
      </a>
      {{ $post->user->username }}
      <br>
      <br>
      {{ $post->post }}
    </div>
    <div class="right">
      <td class="time">{{ $post->created_at }}</td>
      <br>
      <!-- ※※※※※※※※※※※※idを名前と紐づけるかも※※※※※※※※※※※※※※ -->
    </div>
  </div>
  @endforeach
</div>


@endsection
