@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}
<div class="register">
  <h2 class="register-section">新規ユーザー登録</h2>

  <div class="register-content">
    {{ Form::label('ユーザー名','username',['class'=>'register-label']) }}

    {{ Form::text('username',null,['class' => 'input','class'=>'register-form'] ) }}
    <br>
    {{ Form::label('メールアドレス','mail address',['class'=>'register-label']) }}
    {{ Form::text('mail',null,['class' => 'input','class'=>'register-form']) }}
    {{ Form::label('パスワード','password',['class'=>'register-label']) }}

    {{ Form::password('password',['class' => 'input','class'=>'register-form']) }}
    <!-- nullはいらない -->

    {{ Form::label('パスワード確認','password confirm',['class'=>'register-label']) }}

    {{ Form::password('password_confirmation',['class' => 'input','class'=>'register-form']) }}
    <!-- nullはいらない -->
    {{ Form::submit('REGISTER',['class'=>'register-button']) }}
  </div>

  <p class="back-link"><a href="/login">ログイン画面へ戻る</a></p>

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
