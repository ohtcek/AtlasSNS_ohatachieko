@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
<div class="login">
  {!! Form::open(['url' => '/login','method' => 'POST','class'=>'login-content']) !!}

  <p class="login-section">AtlasSNSへようこそ</p>

  {{ Form::label('mail','mail address',['class'=>'login-label']) }}
  <br>
  {{ Form::text('mail',null,['class' => 'input','class'=>'login-form']) }}
  <br>
  {{ Form::label('password','password',['class'=>'login-label']) }}
  <br>
  {{ Form::password('password',['class' => 'input','class'=>'login-form']) }}
  <br>
  {{ Form::submit('LOGIN',['class'=>'login-button']) }}

  <p class="section"><a href="/register">新規ユーザーの方はこちら</a></p>
  {!! Form::close() !!}

</div>
@endsection
