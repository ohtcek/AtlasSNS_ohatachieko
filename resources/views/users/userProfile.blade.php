@extends('layouts.login')

@section('content')

<div class="profile-form-contents">
  <div class="profile-page">
    <img class="profile-user-icon" src="{{ Storage::url( $user->images) }}" alt="ユーザーアイコン">
    <div class="profile-name-bio">
      <div class="profile-user-content">
        <p class="profile-username-left">name</p>
        <p class="profile-username">{{ $user->username }}</p>
      </div>
      <div class="profile-about">
        <p class="profile-bio-left">bio</p>
        <p class="profile-bio">{{ $user->bio }}</p>
      </div>
    </div>
  </div>

  @if (auth()->user()->isFollowing($user->id))
  <p class=" unfollow"><a class="unfollow-link" href="/top/{{$user->id}}/unfollow">フォロー解除</a></p>
  <!-- else followしてる時(followしてない時)はこれ -->
  @else
  <p class="follow"><a class="follow-link" href="/top/{{$user->id}}/follow">フォローする</a></p>
  @endif
</div>

<div class="post-content">
  @foreach ($posts as $post)
  <div class="post-vertical">
    <div class="left">
      <tr>
        <img class="user-icon-post" src="{{ Storage::url( $user->images) }}" alt="ユーザーアイコン">
        {{ $post->user->username }}
        <!-- foreachのpost->リレーション Postモデルのuserメソッド->カラム名 -->
        <br>
        <br>
        <td>{{ $post->post }}</td>
      </tr>
    </div>
    <div class="right">
      <td class="time">{{ $post->created_at->format('Y-m-d h:i') }}</td>
      <br>
      <!-- ※※※※※※※※※※※※idを名前と紐づけるかも※※※※※※※※※※※※※※ -->
    </div>
    </tr>
  </div>
  @endforeach
</div>

@endsection
