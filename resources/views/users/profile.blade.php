@extends('layouts.login')

@section('content')

<div class="profile-contents">
  {!! Form::open(['url' => '/profile','files' => true]) !!}

  {!! Form::hidden('id', $users->id) !!}

  <div class="profile m-40">
    <p>user name</p>
    <div class="profile-form">
      {{Form::text('username', $users->username, ['class' => 'username-form','placeholder' => '名前' ])}}
    </div>
  </div>

  <div class="profile m-40">
    <p>mail address</p>
    <div class="profile-form">
      {{ Form::text('mail',$users->mail, ['class' => 'username-form', 'placeholder' => 'メールアドレス','method' => 'POST']) }}
    </div>
  </div>

  <div class="profile m-40">
    <p>password</p>
    <div class="profile-form">
      {{ Form::password('password', ['class' => 'username-form', 'placeholder' => 'パスワード','method' => 'POST']) }}
    </div>
  </div>

  <div class="profile m-40">
    <p>password confirm</p>
    <div class="profile-form">
      {{ Form::password('password_confirmation', ['class' => 'username-form', 'placeholder' => 'パスワード再入力','method' => 'POST']) }}
      <!-- form::passwordで文字が非表示になる　この形の時はnullはいらない -->
    </div>
  </div>

  <div class="profile m-40">
    <p>bio</p>
    <div class="profile-form">
      {{ Form::text('bio',$users->bio, ['class' => 'username-form', 'placeholder' => 'プロフィール','method' => 'POST']) }}
    </div>
  </div>

  <div class="profile">
    <p>icon image</p>
    <div class="profile-form">
      {{ Form::file('img_path',null, ['class' => 'username-form', 'placeholder' => 'ファイルを選択','method' => 'POST']) }}
      <!-- ファサードだったらenctypeいらない　調べる -->
    </div>
  </div>
  {{ Form::submit('更新') }}
  {!! Form::close() !!}

</div>

@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

@endsection
