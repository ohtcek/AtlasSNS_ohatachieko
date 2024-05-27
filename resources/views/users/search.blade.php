@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/search']) !!}
<div class="search-form-contents">
  {{ Form::text('keyword',null, ['class' => 'search-form', 'placeholder' => 'ユーザー名','method' => 'POST']) }}
  <br>
  <input type="image" class="search-button" src="/images/search.png">
  @if (!empty($keyword))
  <p>検索ワード：{{ $keyword }}</p>
  @endif
</div>
{!! Form::close() !!}

<div class="search-contents">
  @foreach ($users as $user)
  <!-- usersという変数（コントローラーで定義してるやつ）を$userの名前で使う-->
  <!-- controllerのconmpactの$usersは左の$users  でもどっちの名前でcontrollerに使ってもいい　わかりやすい方　今回は複数だからわあ借りやすくsをつけてる-->
  <!-- resources . views > usersのusers -->
  <!-- <td><img class="user-icon-search" src="{{ asset('/images/icon1.png') }}" alt="ユーザーアイコン"></td> -->
  <div class="search-user">
    <div class="icon-name">
      <img class="user-icon" src="{{ Storage::url( $user->images) }}" alt="ユーザーアイコン">
      <p class="search-username">{{ $user->username }}</p>
    </div>
    <!-- followしてる時はこれ -->
    @if (auth()->user()->isFollowing($user->id))
    <p class="unfollow"><a class="unfollow-link" href="/top/{{$user->id}}/unfollow">フォロー解除</a></p>
    <!-- else followしてる時(followしてない時)はこれ -->
    @else
    <p class="follow"><a class="follow-link" href="/top/{{$user->id}}/follow">フォローする</a></p>
    @endif
  </div>
  <!-- userフォルダの中のカラム名 -->
  @endforeach
</div>



@endsection
